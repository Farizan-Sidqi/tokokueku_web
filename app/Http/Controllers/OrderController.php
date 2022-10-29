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

            $order_number = $order->id . '-' . time();

            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_number,
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
                'mt_order_id' => $order_number
            ]);
        } else {
            $snapToken = $order->transaction->snap_token;
        }

        return view('order.pay', compact('snapToken', 'order'));
    }

    public function callback(Request $request, Order $order)
    {
        $response = json_decode($request->callback, true);

        $order->transaction()->update([
            'mt_transaction_id' => $response['transaction_id'] ?? null,
            'transaction_status' => $response['transaction_status'],
            'status_message' => $response['status_message'] ?? null,
            'payment_type' => $response['payment_type'] ?? null,
            'payment_code' => $response['payment_code'] ?? null,
            'store' => $response['store'] ?? null,
            'settlement_time' => $response['settlement_time'] ?? null,
            'response' => $request->callback
        ]);

        return redirect()->route('order.success');
    }

    public function notification()
    {
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;

        $transactions = Transaction::where('mt_order_id', $order_id)->get()->first();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $message = "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    $message = "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            $message = "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
        } else if ($transaction == 'pending') {
            $message = "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }

        $transactions->transaction_status = $transaction;
        $transactions->status_message = $message;
        $transactions->payment_type = $type;
        $transactions->payment_code = '';
        $transactions->store = $notif->store ?? '';
        $transactions->settlement_time = $notif->settlement_time;
        $transactions->save();

        return response()->json(['status' => 'success']);
    }
}
