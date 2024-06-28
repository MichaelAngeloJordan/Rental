<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payments.index', [
            'payments' => Payment::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function update(Request $request, Payment $payment)
    {
        try {
            $request->validate([
                'status' => ['required', 'in:pending,paid,canceled'],
            ]);

            $payment->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Payment status updated',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
