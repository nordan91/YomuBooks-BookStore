@extends('layouts.admin.master', ['title' => 'Transactions - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-gradient mb-1" style="font-weight: 800;">Transactions</h2>
                <p class="text-muted mb-0">Manage your bookstore transactions</p>
            </div>
        </div>

        <!-- Search Form -->
        <form action="{{ route('admin.transactions.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search transactions by invoice or user..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-magnify me-1"></i>Search
                </button>
            </div>
        </form>

        <!-- Transactions Table Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">NO</th>
                                <th>INVOICE</th>
                                <th>USER NAME</th>
                                <th>TOTAL</th>
                                <th style="width: 180px;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <td><strong>{{ $loop->iteration + ($transactions->currentPage() - 1) * $transactions->perPage() }}</strong></td>
                                <td>
                                    <span style="font-weight: 600;">{{ $transaction->invoice }}</span>
                                </td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>
                                    <span style="font-weight: 600; color: #10b981;">Rp {{ number_format($transaction->grand_total) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="mdi mdi-receipt" style="font-size: 3rem; color: #cbd5e0;"></i>
                                    <p class="text-muted mt-2 mb-0">No transactions available.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                @if($transactions->hasPages())
                <div class="mt-4">
                    {{ $transactions->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
