<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $revenue = Booking::where('status', 'approved')
            ->orWhere('status', 'completed')
            ->sum('total_price');
        $overdueInvoice = Payment::where('status', 'pending')
            ->where('due_date', '<', now())
            ->orWhere('created_at', '<', now()->subDays(7))
            ->sum('total_payment');
        $expenses = Payment::where('status', 'paid')
            ->sum('total_payment');
        $totalIncome = (int) $revenue - (int) $expenses;
        $activity = Booking::latest()->take(5)->get()->groupBy(function ($item) {
            return $item->created_at->diffForHumans();
        });

        return view('dashboard', compact('revenue', 'overdueInvoice', 'expenses', 'totalIncome', 'activity'));
    }
}
