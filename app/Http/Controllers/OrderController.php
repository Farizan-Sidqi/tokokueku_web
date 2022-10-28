<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use DataTables;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Order::with('orderDetail','user')->orderBy('tgl_order', 'desc')->get();

        $data = Order::with(['user' => function ($query) {
            $query->select('id', 'nama', 'no_wa', 'email');
        }])->with('orderDetail')
            ->where(function ($query) {
                if (Gate::allows('isPengguna')) {
                    $query->where('user_id', '=', auth()->user()->id);
                }
            })
            ->orderBy('tgl_order', 'desc')->get();
        // return $data;
        return view('order.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // if(Gate::allows('isPengguna')) {
        //     $order = Order::with(['orderDetail', 'user'])->where('user_id', auth()->user()->id)->findOrFail($id);
        // }

        if (Gate::allows('isPengguna')) {
            $order = Order::query()->with(['user' => function ($query) {
                $query->select('id', 'nama', 'no_wa', 'email');
            }])->with('orderDetail')->where('user_id', auth()->user()->id)->findOrFail($id);
        }

        $order = Order::with(['orderDetail', 'user'])->orderBy('created_at', 'DESC')->findOrFail($id);


        //return $order;
        return view('order.detailOrder', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('order.index')->with('success', 'Data berhasil disimpan');
    }

    public function print($order)
    {
        if (Gate::allows('isPengguna')) {
            $order = Order::with(['orderDetail', 'user'])->where('user_id', auth()->user()->id)->findOrFail($order);
        } else {
            $order = Order::with(['orderDetail', 'user'])->orderBy('created_at', 'DESC')->findOrFail($order);
        }

        return view('order.print', compact('order'));
    }

    public function pay(Order $order)
    {
        if (!$order->transaction) {
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order->id . '-' . time(),
                    'gross_amount' => $order->total_harga,
                ),
                'customer_details' => array(
                    'first_name' => $order->user->nama,
                    'last_name' => '',
                    'email' => $order->user->email,
                    'phone' => $order->user->no_wa,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $order->transaction()->create([
                'snap_token' => $snapToken,
            ]);
        } else {
            $snapToken = $order->transaction->snap_token;
        }

        return view('order.pay', compact('snapToken', 'order'));
    }

    public function callback(Request $request, Order $order)
    {
        $response = json_decode($request->callback, true);

        dd($response);
    }
}
