@extends('layouts.web.master', ['title' => 'Cart - Bookstore'])

@section('content')
<div class="container py-5">
    <h4 class="mb-4">Cart</h4>
    <div class="row g-3">
        <!-- Keranjang Belanja -->
        <div class="col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($cartItems as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->book_image }}" alt="{{ $item->book->title }}" class="me-2"
                                            style="width: 50px; height: 50px; object-fit: contain;">
                                        {{ $item->book->title }}
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->price) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>
                                    <form action="{{ route('cart.delete', $item->book_id) }}" method="POST"
                                        class="delete-form d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger delete-btn" onclick="confirmDelete(this)">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php $grandTotal += $item->price * $item->qty; @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <h5>Total: Rp {{ number_format($grandTotal, 2) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Alamat Pengiriman -->
        <div class="col-lg-5">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">Shipping Information</h5>
                    <form action="{{ route('checkout.index') }}" method="POST">
                        @csrf

                        <!-- Shipping Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Shipping Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <!-- Province -->
                        <div class="mb-3">
                            <label for="province" class="form-label">Select Province</label>
                            <select name="province_id" id="province" class="form-select" required>
                                <option value="">-- Select Province --</option>
                                @foreach($provinces as $province)
                                <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- City -->
                        <div class="mb-3">
                            <label for="city" class="form-label">Select City</label>
                            <select name="city_id" id="city" class="form-select" required disabled>
                                <option value="">-- Select City --</option>
                            </select>
                        </div>

                        <!-- District -->
                        <div class="mb-3">
                            <label for="district" class="form-label">Select District</label>
                            <select name="district_id" id="district" class="form-select" required disabled>
                                <option value="">-- Select District --</option>
                            </select>
                        </div>

                        <!-- Courier -->
                        <div class="mb-3">
                            <label for="courier" class="form-label">Select Courier</label>
                            <select name="courier_name" id="courier" class="form-select" required>
                                <option value="">-- Select Courier --</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS Indonesia</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <!-- Shipping Options -->
                        <div id="shipping-options" class="mt-3" style="display: none;">
                            <h6>Shipping Options:</h6>
                            <ul id="shipping-costs" class="list-unstyled">
                                <!-- Shipping options will be dynamically added here -->
                            </ul>
                        </div>

                        <!-- Hidden Inputs -->
                        <input type="hidden" name="courier_service" id="courier_service">
                        <input type="hidden" name="shipping_cost" id="shipping_cost">
                        <input type="hidden" name="weight" value="{{ $cartItems->sum('qty') * 1000 }}">

                        <!-- Submit -->
                        <button type="submit" class="btn btn-success btn-lg w-100 mt-4">Proceed to Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(button) {
        const form = button.closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
<script>
    const provinceDropdown = document.getElementById('province');
    const cityDropdown = document.getElementById('city');
    const districtDropdown = document.getElementById('district');
    const courierDropdown = document.getElementById('courier');
    const shippingOptions = document.getElementById('shipping-options');
    const shippingCosts = document.getElementById('shipping-costs');
    const courierServiceInput = document.getElementById('courier_service');
    const shippingCostInput = document.getElementById('shipping_cost');

    provinceDropdown.addEventListener('change', function () {
        const provinceId = this.value;

        cityDropdown.innerHTML = '<option value="">-- Select City --</option>';
        cityDropdown.disabled = true;
        districtDropdown.innerHTML = '<option value="">-- Select District --</option>';
        districtDropdown.disabled = true;
        courierDropdown.value = "";
        courierDropdown.disabled = true;
        shippingOptions.style.display = "none";

        if (provinceId) {
            fetch(`/cart/get-cities?province_id=${provinceId}`)
                .then(response => response.json())
                .then(cities => {
                    cityDropdown.disabled = false;
                    cities.forEach(city => {
                        const option = document.createElement('option');
                        option.value = city['id'];
                        option.textContent = city['name'];
                        cityDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                    alert('Failed to fetch cities. Please try again later.');
                });
        }
    });

    // Event listener untuk city dropdown
    cityDropdown.addEventListener('change', function () {
        const cityId = this.value;
        districtDropdown.innerHTML = '<option value="">-- Select District --</option>';
        districtDropdown.disabled = true;
        courierDropdown.disabled = true;
        courierDropdown.value = "";
        shippingOptions.style.display = "none";

        if (cityId) {
            fetch(`/cart/get-districts/${cityId}`)
                .then(response => response.json())
                .then(districts => {
                    districtDropdown.disabled = false;
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district['id'];
                        option.textContent = district['name'];
                        districtDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching districts:', error);
                    alert('Failed to fetch districts. Please try again later.');
                });
        }
    });

    // Event listener untuk district dropdown
    districtDropdown.addEventListener('change', function () {
        if (this.value) {
            courierDropdown.disabled = false;
            shippingOptions.style.display = "none";
        } else {
            courierDropdown.disabled = true;
            courierDropdown.value = "";
            shippingOptions.style.display = "none";
        }
    });

    // Event listener untuk courier dropdown
    courierDropdown.addEventListener('change', function () {
        if (this.value && districtDropdown.value) {
            updateShippingCost();
        } else {
            shippingOptions.style.display = "none";
        }
    });

    function updateShippingCost() {
        const districtId = districtDropdown.value;
        const courier = courierDropdown.value;
        const weight = {{ $cartItems->sum('qty') * 1000 }};

        if (!districtId || !courier) return;

        let data = new URLSearchParams();
        data.append('destination', districtId);
        data.append('weight', weight);
        data.append('courier', courier);
        data.append('price', 'lowest');
        data.append('_token', '{{ csrf_token() }}');

        fetch("{{ route('cart.getShippingCost') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: data
        })
        .then(response => {
            if (response.ok) {
                return response.json().then(data => {
                    shippingCosts.innerHTML = "";

                    data.forEach(item => {
                        const li = document.createElement('li');
                        li.innerHTML = `
                            <input type="radio" name="shipping_cost"
                                   value="${item.service}|${item.cost}"
                                   id="shipping-${item.code}-${item.service}" required>
                            <label for="shipping-${item.code}-${item.service}">
                                ${item.name} (${item.service}): Rp ${item.cost}, Est. ${item.etd}
                            </label>
                        `;
                        li.addEventListener('change', function () {
                            courierServiceInput.value = item.service;
                            shippingCostInput.value = item.cost;
                        });
                        shippingCosts.appendChild(li);
                    });

                    shippingOptions.style.display = "block";
                });
            } else {
                return response.text().then(text => {
                    alert('Error: ' + text);
                });
            }
        })
        .catch(error => {
            console.error("Error fetching shipping cost:", error);
            alert("Failed to fetch shipping cost. Please try again later.");
        });
    }
</script>
@endpush

@endsection
