@extends('layouts.web.master', ['title' => 'Home - YomuBooks'])

@section('content')

<!-- Hero Carousel -->
<div id="carouselExampleCaptions" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner ">
        @foreach ($sliders as $key => $slider)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
            <img src="{{  $slider->image }}" class="d-block w-100 rounded-3" alt="Slider Image">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Categories Section -->
<section class="mb-5">
    <div class="text-center mb-4">
        <h2 class="section-title">Browse by Category</h2>
        <p class="text-muted">Find your next favorite book</p>
    </div>
    <div class="row g-4">
        @foreach($categories as $category)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="category-card rounded-3 p-3 h-100">
                <a href="{{ route('categories.show', $category->slug) }}">
                    <div class="mb-2">
                        @if($category->image)
                        <img src="{{ $category->image }}" class="w-100 h-100 rounded" alt="{{ $category->name }}">
                        @else
                        <img src="https://via.placeholder.com/200x150?text={{ $category->name }}" class="w-100 rounded"
                            alt="{{ $category->name }}">
                        @endif
                    </div>
                    <div class="text-center mt-3">
                        <h6 class="category-title mb-0">{{ $category->name }}</h6>
                    </div>
                </a>
            </div>
        </div>

        @endforeach
    </div>
</section>


<!-- Books Section -->
<section class="mb-5">
    <div class="text-center mb-4">
        <h2 class="section-title">Featured Books</h2>
        <p class="text-muted">Explore our collection of top books</p>
    </div>

    <div class="row g-4">
        @foreach($books as $book)
        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('books.show', $book->slug) }}" class="text-decoration-none">
                <div class="product-card p-2 rounded-3 h-100 d-flex flex-column">
                    <div class="text-center mb-2">
                        @if ($book->images->isNotEmpty() && $book->images->first()->image)
                        <img src="{{ $book->images->first()->image }}"
                            class="w-100 rounded-3 img-fluid object-fit-cover" 
                            style="height: 250px;"
                            alt="{{ $book->title }}">
                        @endif
                    </div>
                    <div class="product-card-body text-center flex-grow-1 d-flex flex-column justify-content-between p-2">
                        <div>
                            <p class="product-brand mb-1">{{ $book->author }}</p>
                            <h5 class="product-title">{{ $book->title }}</h5>
                        </div>
                        <div class="mt-2">
                            <p class="selling-price mb-2">Rp {{ number_format($book->price) }}</p>
                            <form action="{{ route('cart.add') }}" method="POST" class="d-inline" onclick="event.stopPropagation()">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>


@endsection