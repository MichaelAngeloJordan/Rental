<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice;

class BookingController extends Controller
{
    public function index()
    {
        $query = Booking::query();
        if (auth()->user()->role->slug == 'costumer') {
            $query->where('user_id', auth()->user()->id);
        }
        return view('bookings.index', [
            'bookings' => $query->get(),
        ]);
    }

    public function show(Booking $booking)
    {
        return view('bookings.detail', [
            'booking' => $booking,
            'payments' => Payment::where('booking_id', $booking->id)->get(),
        ]);
    }

    public function downloadInvoice(Booking $booking)
    {
        $invoice = Invoice::make()
            ->series($booking->payment->payment_number)
            ->buyer(new Buyer([
                'name' => $booking->user->name,
                'custom_fields' => [
                    'email' => $booking->user->email,
                    'phone' => $booking->user->phone,
                    'address' => $booking->user->address . ', ' . $booking->user->city . ', ' . $booking->user->province . ', ' . $booking->user->zip . ', ' . $booking->user->country,
                ],
            ]))
            ->addItem(InvoiceItem::make('Rental ' . $booking->car->name . ' - ' . $booking->car->license_plate)
                ->pricePerUnit($booking->car->price))
            ->notes($booking->note . ' - ' . $booking->created_at->format('Y-m-d H:i:s'))
            ->filename($booking->car->name . '-' . $booking->user->name);

        return $invoice->stream();
    }

    public function update(Request $request, Booking $booking)
    {
        try {
            $request->validate([
                'status' => ['required', 'in:pending,approved,rejected,cancelled,completed'],
            ]);

            if ($request->status === 'approved') {
                $booking->car->update([
                    'available' => false,
                ]);
            } else {
                $booking->car->update([
                    'available' => true,
                ]);
            }

            $booking->update([
                'status' => $request->status,
            ]);

            return response()->json([
                'message' => 'Booking status updated',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Booking $booking)
    {
        try {
            $booking->car->update([
                'available' => true,
            ]);

            $booking->payment->delete();

            $booking->delete();

            return redirect()->route('bookings')->with('success', 'Booking deleted');
        } catch (Exception $e) {
            return redirect()->route('bookings')->with('error', $e->getMessage());
        }
    }
}
