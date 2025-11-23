@extends('layouts.admin.master', ['title' => 'Transaction Details - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-gradient mb-1" style="font-weight: 800;">Transaction Details</h2>
                <p class="text-muted mb-0">Details of transaction with Invoice #{{ $transaction->invoice }}</p>
            </div>
            <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary">
                <i class="mdi mdi-arrow-left"></i> Back to Transactions
            </a>
        </div>

        <!-- Transaction Details Card -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Invoice: {{ $transaction->invoice }}</h5>
                        <p><strong>User:</strong> {{ $transaction->user->name }}</p>
                        <p><strong>Total Amount:</strong> <span style="font-weight: 600; color: #10b981;">Rp {{ number_format($transaction->grand_total) }}</span></p>
                        <p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table Card -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Items</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>BOOK</th>
                                <th style="width: 100px;">QUANTITY</th>
                                <th style="width: 120px;">PRICE</th>
                                <th style="width: 120px;">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaction->transactionDetails as $detail)
                            <tr>
                                <td>
                                    <span style="font-weight: 600;">{{ $detail->book->title }}</span>
                                </td>
                                <td>{{ $detail->qty }}</td>
                                <td>Rp {{ number_format($detail->price) }}</td>
                                <td><span style="font-weight: 600; color: #10b981;">Rp {{ number_format($detail->price * $detail->qty) }}</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="mdi mdi-package-variant" style="font-size: 3rem; color: #cbd5e0;"></i>
                                    <p class="text-muted mt-2 mb-0">No items in this transaction.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
