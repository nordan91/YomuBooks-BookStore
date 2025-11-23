@extends('layouts.admin.master', ['title' => 'Dashboard - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="mb-4">
            <h2 class="mb-1" style="font-weight: 800; color: var(--text-primary);">Customer Dashboard</h2>
            <p class="text-muted mb-0">Welcome back, {{ $user->name }}! Here's your account overview.</p>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <!-- Total Orders Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Total Orders</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">{{ $totalOrders }}</h3>
                            </div>
                            <div class="stat-icon bg-primary-light">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Spent Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-success h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Total Spent</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">${{ number_format($totalSpent, 2) }}</h3>
                            </div>
                            <div class="stat-icon bg-success-light">
                                <i class="mdi mdi-currency-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Books Purchased Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Books Purchased</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">{{ $recentOrders->sum(fn($order) => $order->transactionDetails->count()) }}</h3>
                            </div>
                            <div class="stat-icon bg-warning-light">
                                <i class="mdi mdi-book-multiple"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-danger h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Pending Orders</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">{{ $user->transactions()->where('status', 'UNPAID')->count() }}</h3>
                            </div>
                            <div class="stat-icon bg-danger-light">
                                <i class="mdi mdi-clock-outline"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <!-- Recent Orders Table -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4" style="font-weight: 700; color: var(--text-primary);">
                            <i class="mdi mdi-clock-outline me-2"></i>Recent Orders
                        </h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ORDER ID</th>
                                        <th>STATUS</th>
                                        <th>TOTAL</th>
                                        <th>DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->invoice }}</strong></td>
                                        <td><span class="badge badge-{{ $order->status == 'PAID' ? 'success' : ($order->status == 'UNPAID' ? 'warning' : 'primary') }}">{{ ucfirst(strtolower($order->status)) }}</span></td>
                                        <td><strong>${{ number_format($order->grand_total, 2) }}</strong></td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No orders yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-4" style="font-weight: 700; color: var(--text-primary);">
                            <i class="mdi mdi-lightning-bolt me-2"></i>Quick Actions
                        </h5>
                        <div class="d-grid gap-3">
                            <a href="/" class="btn btn-primary d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-book-open me-2"></i>Browse Books</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                            <a href="#" class="btn btn-success d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-cart me-2"></i>View Cart</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                            <a href="{{ route('customers.transactions.index') }}" class="btn btn-warning d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-receipt me-2"></i>My Orders</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                            <a href="#" class="btn btn-danger d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-account me-2"></i>Edit Profile</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
