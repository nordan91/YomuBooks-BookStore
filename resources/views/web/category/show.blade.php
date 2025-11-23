@extends('layouts.web.master', ['title' => $category->name . ' - YomuBooks'])

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
        <li class="breadcrumb-item">Categories</li>
        <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
    </ol>
</nav>

<!-- Category Header -->
<div class="category-header mb-5">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="category-page-title">{{ $category->name }}</h1>
            <p class="category-description">
                Discover our curated collection of {{ $category->name }} books
            </p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <div class="category-stats">
                <span class="stat-badge">
                    <i class="bi bi-book me-2"></i>{{ $category->books->count() }} Books
                </span>
            </div>
        </div>
    </div>
</div>

@if($category->books->isEmpty())
<!-- Empty State -->
<div class="empty-state">
    <div class="empty-state-icon">
        <i class="bi bi-inbox"></i>
    </div>
    <h3 class="empty-state-title">No Books Available</h3>
    <p class="empty-state-text">We're currently updating this category. Check back soon for new arrivals!</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-4">
        <i class="bi bi-arrow-left me-2"></i>Back to Home
    </a>
</div>
@else
<!-- Filter & Sort Bar -->
<div class="filter-bar mb-4">
    <div class="row align-items-center">
        <div class="col-md-6">
            <p class="results-count mb-0">
                Showing <strong>{{ $category->books->count() }}</strong> results
            </p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="d-inline-flex align-items-center gap-3">
                <label class="mb-0 text-muted">Sort by:</label>
                <select class="form-select form-select-sm" style="width: auto;">
                    <option>Latest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Title: A-Z</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Books Grid -->
<div class="row g-4 mb-5">
    @foreach($category->books as $book)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="book-card-category">
            <a href="{{ route('books.show', $book->slug) }}" class="text-decoration-none">
                <div class="book-image-wrapper">
                    @if($book->images->first())
                    <img src="{{ $book->images->first()->image }}" 
                         class="book-image" 
                         alt="{{ $book->title }}">
                    @else
                    <img src="https://via.placeholder.com/300x400/f7fafc/DC6B6F?text={{ urlencode($book->title) }}" 
                         class="book-image" 
                         alt="{{ $book->title }}">
                    @endif
                    <div class="book-overlay">
                        <button class="btn btn-quick-view">
                            <i class="bi bi-eye me-2"></i>Quick View
                        </button>
                    </div>
                </div>
                
                <div class="book-content">
                    <p class="book-author">{{ $book->author }}</p>
                    <h5 class="book-title">{{ Str::limit($book->title, 40) }}</h5>
                    
                    <div class="book-rating mb-2">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <span class="rating-count">(4.5)</span>
                    </div>
                    
                    <div class="book-footer">
                        <div class="book-price">
                            <span class="price-current">Rp {{ number_format($book->price) }}</span>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" class="btn btn-add-cart">
                                <i class="bi bi-cart-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endif

<style>
/* Category Page Styles */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin-bottom: 2rem;
}

.breadcrumb-item a {
    color: var(--neutral-600);
    text-decoration: none;
    transition: color var(--transition-fast);
}

.breadcrumb-item a:hover {
    color: var(--primary-color);
}

.breadcrumb-item.active {
    color: var(--neutral-800);
    font-weight: 600;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: var(--neutral-400);
}

/* Category Header */
.category-header {
    background: linear-gradient(135deg, #ffffff 0%, var(--neutral-50) 100%);
    padding: 3rem 2rem;
    border-radius: var(--radius-xl);
    border: 1px solid var(--neutral-200);
    box-shadow: var(--shadow-sm);
}

.category-page-title {
    font-family: var(--font-display);
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 800;
    color: var(--neutral-900);
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
}

.category-description {
    font-size: 1.125rem;
    color: var(--neutral-600);
    margin: 0;
}

.category-stats {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.stat-badge {
    background: var(--primary-gradient);
    color: #ffffff;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-full);
    font-weight: 700;
    font-size: 0.9375rem;
    display: inline-flex;
    align-items: center;
    box-shadow: var(--shadow-md);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 5rem 2rem;
    background: #ffffff;
    border-radius: var(--radius-xl);
    border: 2px dashed var(--neutral-300);
}

.empty-state-icon {
    font-size: 5rem;
    color: var(--neutral-300);
    margin-bottom: 1.5rem;
}

.empty-state-title {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: var(--neutral-800);
    margin-bottom: 0.5rem;
}

.empty-state-text {
    font-size: 1.125rem;
    color: var(--neutral-600);
    max-width: 500px;
    margin: 0 auto;
}

/* Filter Bar */
.filter-bar {
    background: #ffffff;
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    border: 1px solid var(--neutral-200);
    box-shadow: var(--shadow-sm);
}

.results-count {
    font-size: 1rem;
    color: var(--neutral-700);
}

.form-select-sm {
    border-radius: var(--radius-md);
    border: 1px solid var(--neutral-300);
    padding: 0.5rem 2rem 0.5rem 1rem;
    font-weight: 500;
    color: var(--neutral-700);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.form-select-sm:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px var(--primary-light);
    outline: none;
}

/* Book Cards for Category Page */
.book-card-category {
    background: #ffffff;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--neutral-200);
    transition: all var(--transition-base);
    height: 100%;
    position: relative;
}

.book-card-category::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
    transform: scaleX(0);
    transition: transform var(--transition-base);
}

.book-card-category:hover::before {
    transform: scaleX(1);
}

.book-card-category:hover {
    box-shadow: var(--shadow-2xl);
    transform: translateY(-12px);
    border-color: var(--primary-color);
}

.book-image-wrapper {
    position: relative;
    height: 320px;
    overflow: hidden;
    background: var(--neutral-50);
}

.book-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-slow);
}

.book-card-category:hover .book-image {
    transform: scale(1.08);
}

.book-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-base);
}

.book-card-category:hover .book-overlay {
    opacity: 1;
}

.btn-quick-view {
    background: #ffffff;
    color: var(--primary-color);
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-full);
    font-weight: 600;
    border: none;
    transition: all var(--transition-base);
}

.btn-quick-view:hover {
    background: var(--primary-gradient);
    color: #ffffff;
    transform: scale(1.05);
}

.book-content {
    padding: 1.25rem;
}

.book-author {
    color: var(--neutral-500);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.book-title {
    font-weight: 700;
    color: var(--neutral-900);
    font-size: 1rem;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    min-height: 2.8rem;
    font-family: var(--font-accent);
}

.book-rating {
    color: #FFD700;
    font-size: 0.875rem;
}

.book-rating i {
    margin-right: 2px;
}

.rating-count {
    color: var(--neutral-500);
    font-size: 0.875rem;
    margin-left: 0.5rem;
}

.book-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--neutral-200);
}

.price-current {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--primary-color);
    font-family: var(--font-accent);
}

.btn-add-cart {
    background: var(--primary-gradient);
    color: #ffffff;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--transition-base);
}

.btn-add-cart:hover {
    transform: scale(1.1) rotate(10deg);
    box-shadow: var(--shadow-lg);
}

@media (max-width: 768px) {
    .category-header {
        padding: 2rem 1.5rem;
    }
    
    .category-page-title {
        font-size: 2rem;
    }
    
    .category-stats {
        justify-content: flex-start;
        margin-top: 1rem;
    }
}
</style>

@endsection