@extends('layouts.admin.master', ['title' => 'Sliders - Bookstore'])

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-gradient mb-1" style="font-weight: 800;">Sliders</h2>
                <p class="text-muted mb-0">Manage your homepage sliders</p>
            </div>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus-circle me-2"></i>Add New Slider
            </a>
        </div>

        <!-- Sliders Table Card -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">NO</th>
                                <th>IMAGE</th>
                                <th style="width: 180px;">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                            <tr>
                                <td><strong>{{ $loop->iteration }}</strong></td>
                                <td>
                                    <img src="{{ $slider->image }}" alt="Slider Image" 
                                         style="width: 200px; height: 100px; object-fit: cover; border-radius: 8px;">
                                </td>
                                <td>
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" 
                                       class="btn btn-sm btn-warning me-1">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" 
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
                                <td colspan="3" class="text-center py-5">
                                    <i class="mdi mdi-image-off" style="font-size: 3rem; color: #cbd5e0;"></i>
                                    <p class="text-muted mt-2 mb-0">No sliders available.</p>
                                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm mt-3">
                                        <i class="mdi mdi-plus-circle me-1"></i>Create Your First Slider
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                @if($sliders->hasPages())
                <div class="mt-4">
                    {{ $sliders->withQueryString()->links('pagination::bootstrap-5') }}
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
