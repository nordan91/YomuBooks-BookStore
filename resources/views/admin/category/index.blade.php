@extends('layouts.admin.master', ['title' => 'Categories - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-gradient mb-1" style="font-weight: 800;">Categories</h2>
                <p class="text-muted mb-0">Manage your bookstore categories</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus-circle me-2"></i>Create Category
            </a>
        </div>

        <!-- Search Form -->
        <form action="{{ route('admin.categories.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search categories by name or slug..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="mdi mdi-magnify me-1"></i>Search
                </button>
            </div>
        </form>

        <!-- Category Table Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">NO</th>
                                <th>NAME</th>
                                <th>SLUG</th>
                                <th style="width: 100px;">IMAGE</th>
                                <th style="width: 180px;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <span style="font-weight: 600;">{{ $category->name }}</span>
                                </td>
                                <td>
                                    <code style="background: #f7fafc; padding: 0.25rem 0.5rem; border-radius: 6px; color: #667eea;">
                                        {{ $category->slug }}
                                    </code>
                                </td>
                                <td>
                                    <img src="{{ $category->image }}" alt="{{ $category->name }}" 
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                       class="btn btn-sm btn-warning me-1">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" 
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
                                <td colspan="5" class="text-center py-5">
                                    <i class="mdi mdi-folder-open" style="font-size: 3rem; color: #cbd5e0;"></i>
                                    <p class="text-muted mt-2 mb-0">No categories available.</p>
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm mt-3">
                                        <i class="mdi mdi-plus-circle me-1"></i>Create Your First Category
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                @if($categories->hasPages())
                <div class="mt-4">
                    {{ $categories->withQueryString()->links('pagination::bootstrap-5') }}
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
