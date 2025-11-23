@extends('layouts.admin.master', ['title' => 'Books - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-gradient mb-1" style="font-weight: 800;">Books</h2>
                <p class="text-muted mb-0">Manage your bookstore books</p>
            </div>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus-circle me-2"></i>Create Book
            </a>
        </div>

        <!-- Search Form -->
        <form action="{{ route('admin.books.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search books by title or description..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-magnify me-1"></i>Search
                </button>
            </div>
        </form>

        <!-- Books Table Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">NO</th>
                                <th>TITLE</th>
                                <th>CATEGORY</th>
                                <th style="width: 100px;">PRICE</th>
                                <th style="width: 100px;">IMAGE</th>
                                <th style="width: 180px;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <span style="font-weight: 600;">{{ $book->title }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $book->category->name ?? 'No Category' }}</span>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #10b981;">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    @if($book->images->isNotEmpty())
                                        <img src="{{ asset('storage/books/' . $book->images->first()->image) }}" alt="{{ $book->title }}"
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                            <i class="mdi mdi-book" style="font-size: 2rem; color: #94a3b8;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>

                                <a href="{{ route('admin.books.add-images', $book->id) }}" class="btn btn-sm btn-success">Add Images</a>
                                    
                                    <a href="{{ route('admin.books.edit', $book->id) }}"
                                       class="btn btn-sm btn-warning me-1">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.books.destroy', $book->id) }}"
                                          method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-delete">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="mdi mdi-book-open-page-variant" style="font-size: 3rem; color: #cbd5e0;"></i>
                                    <p class="text-muted mt-2 mb-0">No books available.</p>
                                    <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm mt-3">
                                        <i class="mdi mdi-plus-circle me-1"></i>Create Your First Book
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                @if($books->hasPages())
                <div class="mt-4">
                    {{ $books->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle delete button clicks
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            const deleteBtn = form.querySelector('.btn-delete');

            deleteBtn.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection