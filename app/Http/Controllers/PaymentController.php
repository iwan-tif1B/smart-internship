<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set API credentials
        Config::$serverKey = "SB-Mid-server-jnRmbWNVMHyvPE9p4kWsRU-0"; // Gunakan Server Key dari Midtrans
        Config::$clientKey = "SB-Mid-client-W8J9wdfZwoeNFElb"; // Gunakan Client Key dari Midtrans
        Config::$isProduction = false; // Gunakan false untuk mode sandbox, true untuk production
    }

    public function createTransaction(Request $request)
    {
        $total = $request->input('total'); // Mengambil total dari request

        $transaction_details = [
            'order_id' => 'ORDER-' . time(),
            'gross_amount' => $total, // Jumlah total transaksi
        ];

        $item_details = [
            [
                'id' => 'item1',
                'price' => $total,
                'quantity' => 1,
                'name' => 'Pembayaran Booking',
            ],
        ];

        $customer_details = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone' => '+628123456789',
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];
        // return response()->json(['data' => $transaction_data]);
        try {
            // Membuat transaksi di Midtrans
            $snap_token = Snap::getSnapToken($transaction_data);
            return response()->json(['snap_token' => $snap_token]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
