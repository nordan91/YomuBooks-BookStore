@extends('layouts.admin.master', ['title' => 'Dashboard - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="mb-4">
            <h2 class="mb-1" style="font-weight: 800; color: var(--text-primary);">Admin Dashboard</h2>
            <p class="text-muted mb-0">Welcome back, {{ $user->name }}! Here's what's happening with your bookstore.</p>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <!-- Total Books Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Total Books</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">150</h3>
                            </div>
                            <div class="stat-icon bg-primary-light">
                                <i class="mdi mdi-book-multiple"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-success h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Total Orders</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">25</h3>
                            </div>
                            <div class="stat-icon bg-success-light">
                                <i class="mdi mdi-cart"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">Revenue</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">$12,345</h3>
                            </div>
                            <div class="stat-icon bg-warning-light">
                                <i class="mdi mdi-currency-usd"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Users Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card card-stat card-stat-danger h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1" style="font-size: 0.75rem; text-transform: uppercase; font-weight: 600;">New Users</p>
                                <h3 class="mb-0" style="font-weight: 800; color: var(--text-primary);">8</h3>
                            </div>
                            <div class="stat-icon bg-danger-light">
                                <i class="mdi mdi-account-multiple"></i>
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
                                        <th>CUSTOMER</th>
                                        <th>STATUS</th>
                                        <th>TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>#12345</strong></td>
                                        <td>John Doe</td>
                                        <td><span class="badge badge-success">Completed</span></td>
                                        <td><strong>$45.00</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#12346</strong></td>
                                        <td>Jane Smith</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                        <td><strong>$32.50</strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong>#12347</strong></td>
                                        <td>Bob Johnson</td>
                                        <td><span class="badge badge-primary">Processing</span></td>
                                        <td><strong>$78.90</strong></td>
                                    </tr>
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
                            <a href="#" class="btn btn-primary d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-book-plus me-2"></i>Add New Book</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                            <a href="#" class="btn btn-success d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-cart me-2"></i>View Orders</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-warning d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-shape me-2"></i>Manage Categories</span>
                                <i class="mdi mdi-arrow-right"></i>
                            </a>
                            <a href="#" class="btn btn-danger d-flex align-items-center justify-content-between">
                                <span><i class="mdi mdi-chart-line me-2"></i>View Reports</span>
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
