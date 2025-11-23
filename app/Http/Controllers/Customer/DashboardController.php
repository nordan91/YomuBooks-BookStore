<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the dashboard for customer.
     */
    public function index()
    {
        // Pastikan user adalah customer
        if (Auth::user()->hasRole('customer')) {
            $user = Auth::user();
            $totalOrders = $user->transactions()->count();
            $totalSpent = $user->transactions()->sum('grand_total');
            $recentOrders = $user->transactions()->with('transactionDetails.book')->latest()->take(3)->get();

            return view('customers.dashboard.index', compact('user', 'totalOrders', 'totalSpent', 'recentOrders'));
        }
    }
}
