<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 'admin') {
            $saatini = Carbon::now()->format('W');
            $mulai = $saatini - 12;

            Carbon::setWeekStartsAt(Carbon::MONDAY);

            $startWeek = now()->startOfWeek()->format('Y-m-d');
            $endWeek = now()->endOfWeek()->format('Y-m-d');

            $produk = Produk::all()->count();
            $user = User::all()->count();
            $penjualanMingguIni = DB::table('order')
                ->select('total_harga')
                ->whereBetween('tgl_order', [$startWeek, $endWeek])
                ->where('is_paid', 1)
                ->sum('order.total_harga');

            $modalpenjualanMingguIni = Order::where("is_paid", true)
                ->whereBetween('tgl_order', [$startWeek, $endWeek])->get()->map(function ($item) {
                    return $item->orderDetail->reduce(function ($total, $orderItem) {
                        return $total += $orderItem->modal * $orderItem->qty;
                    }, 0);
                })->sum();

            $labaBersih = $penjualanMingguIni - $modalpenjualanMingguIni;

            $itemTerjualMingguIni = DB::table('order')
                ->select('total_qty')
                ->whereBetween('tgl_order', [$startWeek, $endWeek])
                ->where('is_paid', 1)
                ->sum('order.total_qty');
            $orderMingguIni = DB::table('order')
                ->select('created_at')
                ->whereBetween('tgl_order', [$startWeek, $endWeek])
                ->count('order.created_at');

            $byweek = Order::select(DB::raw('sum(total_harga) as `total_penjulan`'), DB::raw("WEEKOFYEAR(tgl_order) AS week_of_year"))
                ->where('is_paid', 1)
                ->whereBetween(DB::raw("WEEKOFYEAR(tgl_order)"), [$mulai, $saatini])
                ->groupby('week_of_year')
                //->get();
                ->pluck('total_penjulan', 'week_of_year');

            $weeklabels = $byweek->keys();
            $weekdata = $byweek->values();

            $labels = collect(now()->getDays())->filter(function ($item)
            {
                return $item != 'Sunday';
            });
            $labels->push('Sunday');
            $labels = $labels->values();

            $result = DB::table('order')
                ->select("tgl_order", "total_harga")
                ->whereBetween('tgl_order', [$startWeek, $endWeek])
                ->where('is_paid', 1)
                ->get()
                ->groupBy('tgl_order');

            $data = array_values($result->map(function ($item) {
                return $item->reduce(function ($total, $item) {
                    return $total += $item->total_harga;
                });
            })->toArray());

            return view('beranda.beranda_admin', compact('produk', 'penjualanMingguIni', 'itemTerjualMingguIni', 'orderMingguIni', 'user', 'labels', 'data', 'weekdata', 'weeklabels', 'labaBersih'));
        } else {
            $data = Order::with(['user' => function ($query) {
                $query->select('id', 'nama', 'no_wa', 'email');
            }])->with('orderDetail')
                ->where(function ($query) {
                    if (Gate::allows('isPengguna')) {
                        $query->where('user_id', '=', auth()->user()->id);
                    }
                })
                ->orderBy('tgl_order', 'desc')->get();
            return view('order.index', compact('data'));
        }



        // $byweek = Order::select(DB::raw('sum(total_harga) as `total_penjulan`'), DB::raw("WEEKOFYEAR(tgl_order) AS week_of_year"))
        // ->groupby('week_of_year')
        // ->get();


        // $byweek = Order::get(['total_qty', 'total_harga', DB::raw('WEEK(tgl_order) as no_mnth')])->groupBy(function($date) {
        //     return Carbon::parse($date->check_in)->format('W');
        // });
        // $byweek = $byweek->reverse();
        // return $byweek;


    }
}
