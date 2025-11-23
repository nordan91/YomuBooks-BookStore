@extends('layouts.web.master', ['title' => $book->title . ' - YomuBooks'])

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.show', $book->category->slug) }}">{{ $book->category->name }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($book->title, 30) }}</li>
    </ol>
</nav>

<!-- Book Detail Section -->
<div class="book-detail-container">
    <div class="row g-4">
        <!-- Image Gallery Column -->
        <div class="col-lg-4">
            <div class="image-gallery-wrapper">
                <div class="main-image-container" data-bs-toggle="modal" data-bs-target="#imageModal">
                    @if($book->images->first())
                    <img src="{{ $book->images->first()->image }}" 
                         class="main-book-image" 
                         alt="{{ $book->title }}">
                    @else
                    <img src="https://via.placeholder.com/400x550/f7fafc/DC6B6F?text={{ urlencode($book->title) }}" 
                         class="main-book-image" 
                         alt="{{ $book->title }}">
                    @endif
                    @if($book->images->count() > 1)
                    <div class="image-count-badge">
                        <i class="bi bi-images"></i> {{ $book->images->count() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Book Details Column -->
        <div class="col-lg-8">
            <div class="book-detail-content">
                <span class="category-badge mb-2">{{ $book->category->name }}</span>
                <h1 class="book-detail-title mb-2">{{ $book->title }}</h1>
                <p class="book-author-name mb-3">by <strong>{{ $book->author }}</strong></p>

                <div class="rating-price-row mb-3">
                    <div class="star-rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <span class="rating-text">4.5 (128)</span>
                    </div>
                    <div class="stock-status">
                        <i class="bi bi-check-circle-fill"></i> In Stock
                    </div>
                </div>

                <h2 class="book-price mb-4">Rp {{ number_format($book->price) }}</h2>

                <div class="cart-section mb-4">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <div class="qty-input-group">
                                <button type="button" class="qty-btn qty-minus">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" name="qty" value="1" min="1" max="99" class="qty-input" readonly>
                                <button type="button" class="qty-btn qty-plus">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <button type="submit" class="btn btn-add-to-cart flex-grow-1">
                                <i class="bi bi-cart-plus me-2"></i>Add to Cart
                            </button>
                        </div>
                    </form>
                </div>

                <div class="book-features">
                    <div class="feature-item">
                        <i class="bi bi-truck"></i>
                        <span>Free Delivery</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <span>Secure Payment</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Easy Returns</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="description-section mt-4">
        <h3 class="section-title">Description</h3>
        <p class="description-text">{{ $book->description }}</p>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">{{ $book->title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="bookImageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($book->images as $key => $image)
                        <button type="button" data-bs-target="#bookImageCarousel" data-bs-slide-to="{{ $key }}" 
                                class="{{ $key == 0 ? 'active' : '' }}" 
                                aria-current="{{ $key == 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach($book->images as $key => $image)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ $image->image }}" class="d-block w-100" alt="Book Image {{ $key + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#bookImageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bookImageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Minimalist Book Detail Styles */
.breadcrumb {
    background: transparent;
    padding: 0;
    font-size: 0.875rem;
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

/* Image Gallery - Minimalist */
.main-image-container {
    position: relative;
    background: #ffffff;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 1px solid var(--neutral-200);
    cursor: pointer;
    transition: all var(--transition-base);
}

.main-image-container:hover {
    box-shadow: var(--shadow-lg);
}

.main-book-image {
    width: 100%;
    height: auto;
    display: block;
}

.image-count-badge {
    position: absolute;
    bottom: 0.75rem;
    right: 0.75rem;
    background: rgba(0, 0, 0, 0.75);
    color: #ffffff;
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 600;
}

/* Book Detail Content - Compact */
.category-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary-dark);
    padding: 0.375rem 0.875rem;
    border-radius: var(--radius-full);
    font-size: 0.8125rem;
    font-weight: 600;
}

.book-detail-title {
    font-family: var(--font-display);
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 800;
    color: var(--neutral-900);
    line-height: 1.2;
    letter-spacing: -0.01em;
}

.book-author-name {
    font-size: 1rem;
    color: var(--neutral-600);
}

.book-author-name strong {
    color: var(--neutral-800);
}

.rating-price-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--neutral-200);
}

.star-rating {
    display: flex;
    align-items: center;
    gap: 0.125rem;
}

.star-rating i {
    color: #FFD700;
    font-size: 1rem;
}

.rating-text {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--neutral-700);
    margin-left: 0.5rem;
}

.stock-status {
    background: #ECFDF5;
    color: #059669;
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    font-size: 0.875rem;
}

.stock-status i {
    font-size: 0.875rem;
}

.book-price {
    font-family: var(--font-accent);
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-color);
}

/* Compact Quantity & Cart */
.qty-input-group {
    display: inline-flex;
    align-items: center;
    border: 1.5px solid var(--neutral-300);
    border-radius: var(--radius-md);
    overflow: hidden;
}

.qty-btn {
    background: var(--neutral-100);
    border: none;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--transition-fast);
    color: var(--neutral-700);
}

.qty-btn:hover {
    background: var(--primary-color);
    color: #ffffff;
}

.qty-input {
    width: 60px;
    height: 36px;
    border: none;
    text-align: center;
    font-size: 1rem;
    font-weight: 700;
    color: var(--neutral-900);
    background: #ffffff;
}

.qty-input:focus {
    outline: none;
}

.btn-add-to-cart {
    padding: 0.625rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 700;
    font-size: 0.9375rem;
    border: none;
    cursor: pointer;
    transition: all var(--transition-base);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--font-accent);
    background: var(--primary-gradient);
    color: #ffffff;
}

.btn-add-to-cart:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Compact Features */
.book-features {
    display: flex;
    gap: 1.5rem;
    padding: 1rem 0;
    border-top: 1px solid var(--neutral-200);
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--neutral-600);
    font-size: 0.875rem;
}

.feature-item i {
    font-size: 1.125rem;
    color: var(--primary-color);
}

/* Simple Description */
.description-section {
    background: #ffffff;
    border-radius: var(--radius-lg);
    border: 1px solid var(--neutral-200);
    padding: 1.5rem;
}

.section-title {
    font-family: var(--font-accent);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--neutral-900);
    margin-bottom: 1rem;
}

.description-text {
    font-size: 0.9375rem;
    line-height: 1.7;
    color: var(--neutral-700);
}

/* Responsive */
@media (max-width: 768px) {
    .book-features {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .rating-price-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const qtyInput = document.querySelector('.qty-input');
    const qtyMinus = document.querySelector('.qty-minus');
    const qtyPlus = document.querySelector('.qty-plus');
    
    if (qtyMinus && qtyPlus && qtyInput) {
        qtyMinus.addEventListener('click', function() {
            let value = parseInt(qtyInput.value);
            if (value > 1) qtyInput.value = value - 1;
        });
        
        qtyPlus.addEventListener('click', function() {
            let value = parseInt(qtyInput.value);
            if (value < 99) qtyInput.value = value + 1;
        });
    }
});
</script>

@endsection