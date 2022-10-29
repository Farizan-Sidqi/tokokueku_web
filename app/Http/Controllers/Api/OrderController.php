<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProgramResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'catatan' => 'required|string',
            'alamat_antar' => 'required|string|max:200',
            'total_qty' => 'required|integer',
            'total_harga' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $produk_order = json_decode($request->order);
        $catatan = $request->catatan;
        $alamat_antar = $request->alamat_antar;
        $total_harga = (int)$request->total_harga;
        $total_qty = (int)$request->total_qty;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $request->user_id,
                'total_qty' => $total_qty,
                'total_harga' => $total_harga,
                'catatan' => $catatan,
                'alamat_antar' => $alamat_antar,
                'tgl_order' => now()->format('Y-m-d H:i:s')
            ]);

            foreach ($produk_order as $p) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'nama_makanan' => $p->nama,
                    'harga_makanan' => $p->harga,
                    'qty' => $p->qty,
                    'harga_total' => $p->total_harga
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'message' => 'Data gagal disimpan'
            ], 500);
        }

        return response()->json([
            'message' => 'Order berhasil dibuat'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
