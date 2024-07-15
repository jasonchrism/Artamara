@include('includes.addressNotification')
@vite('resources/css/buyer/cart.css')
@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@vite('resources/css/app.css')
@vite('resources/css/navigation.css')

@stack('styles')
@include('includes.navigation')

<div class="cart-content">

    <div class="row">
        <p class="fw-bold cart-title">Cart</p>
        <div class="col-lg-7">
            <div class="cart-container-left d-flex">
                <div class="cart-detail">
                    @php
                        $grouped_cart = $user_cart->groupBy('product.user.name');
                    @endphp

                    @foreach ($grouped_cart as $cart => $product_id)
                        <label class="main mt-4">
                            <span class="namelabel">{{ $cart }}</span>
                            <input type="checkbox" class="artist-checkbox" id="artist_{{ $loop->index }}">
                            <span class="checkbox-container"></span>
                        </label>

                        @foreach ($product_id as $item)
                            {{-- product dri artist tsb --}}
                            <div class="cart-detail-items d-flex">
                                <div class="cart-items col-lg-6 d-flex">
                                    <label class="main">
                                        <input type="checkbox"
                                            class="product-checkbox artist-{{ $loop->parent->index }}"
                                            data-id="{{ $item->product_id }}" data-quantity="{{ $item->quantity }}"
                                            data-price="{{ $item->product->price }}">
                                        <span class="checkbox-container"></span>
                                    </label>
                                    <img src="{{ $item->product->thumbnail }}" alt="" class="object-fit-cover">
                                    <div class="cart-items-desc">
                                        <p class="text-truncate">{{ $item->product->title }}</p>
                                        <span>{{ $item->product->user->name }}</span><br>
                                        <span style="font-size: 16px">{{ $item->product->year }}</span>
                                    </div>
                                </div>
                                <div class="product-details col-lg-6 d-flex align-items-end flex-column">
                                    <div class="product-price">
                                        <p id="price" name="price">Rp
                                            {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="product-action">

                                        <div class="input-group" data-product-id="{{ $item->product_id }}">
                                            {{-- button delete --}}
                                            <a class="button-delete" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal-{{ $item->product_id }}">
                                                <svg width="23" height="25" viewBox="0 0 18 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7.375 0.25C6.95006 0.25 6.51456 0.3995 6.20662 0.707438C5.8995 1.01375 5.75 1.44925 5.75 1.875V2.6875H0.0625V4.3125H0.951375L2.5 19.0139L2.57638 19.75H15.4236L15.5 19.0139L17.0486 4.3125H17.9375V2.6875H12.25V1.875C12.25 1.45006 12.1005 1.01456 11.7926 0.706625C11.4862 0.3995 11.0499 0.25 10.625 0.25H7.375ZM7.375 1.875H10.625V2.6875H7.375V1.875ZM2.60156 4.3125H15.3984L13.9514 18.125H4.04862L2.60156 4.3125ZM5.75 6.75V15.6875H7.375V6.75H5.75ZM8.1875 6.75V15.6875H9.8125V6.75H8.1875ZM10.625 6.75V15.6875H12.25V6.75H10.625Z"
                                                        fill="#FC2D2D" />
                                                </svg>
                                            </a>
                                            <div class="quantity-input">
                                                <input type="hidden" name="productId" id="productId"
                                                    value="{{ $item->product_id }}">
                                                <button type="button" class="button-minus icon-shape icon-sm">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        style="pointer-events: none;">
                                                        <path d="M15.8332 10.8307H4.1665V9.16406H15.8332V10.8307Z"
                                                            fill="#CEFE06" />
                                                    </svg>
                                                </button>
                                                <input type="number" step="1" max="10"
                                                    value="{{ $item->quantity }}" name="quantity"
                                                    class="quantity-field border-0 text-center inputcartnumber">
                                                <button type="button" class="button-plus icon-shape icon-sm">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        style="pointer-events: none;">
                                                        <path
                                                            d="M10.8332 9.16406H15.8332V10.8307H10.8332V15.8307H9.1665V10.8307H4.1665V9.16406H9.1665V4.16406H10.8332V9.16406Z"
                                                            fill="#CEFE06" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('front.deleteCart') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal fade" id="deleteModal-{{ $item->product_id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog"
                                        style="background-color: var(--bg-overlay-2); z-index:9999">
                                        <div class="modal-content"
                                            style="background-color: var(--bg-overlay-1); border-radius: 0; z-index:99999;">
                                            <input type="text" name="delete-product-id"
                                                value="{{ $item->product_id }}" hidden>
                                            <div class="modal-header border-0">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
                                            </div>
                                            <div class="modal-body text-secondary pt-0">
                                                Remove Product from the cart?
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn text-primary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>

        @php
            $totalPrice = 0;
        @endphp

        <div class="col-lg-5">
            <div class="cart-contaniner-right d-flex">
                <p>Order Sumary</p>
                <div class="total-summary d-flex">
                    <div class="col-lg-6">
                        <p>Total</p>
                    </div>
                    <div class="col-lg-6">
                        <p style="text-align: right" id="totalPrice" name="totalPrice">Rp
                            {{ number_format($totalPrice, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <form id="selected-products-form" method="POST" action="{{ route('front.order.session', 'cart') }}">
                @csrf
                <input type="hidden" id="selected-products" name="selected_products" value="[]">
                <div class="button-checkout d-flex">
                    <button type="submit" class="btn btn-primary mt-3 fw-bold">
                        Check Out
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    let selectedProducts = [];
    const hiddenInput = document.getElementById('selected-products');

    function updateSelectedProducts(productId, quantity) {
        let productFound = false;
        selectedProducts = selectedProducts.map(product => {
            if (product.product_id === productId) {
                productFound = true;
                return { product_id: productId, quantity: quantity };
            }
            return product;
        });

        if (!productFound) {
            selectedProducts.push({
                product_id: productId,
                quantity: quantity
            });
        }

        hiddenInput.value = JSON.stringify(selectedProducts);
        console.log(hiddenInput.value);
    }

    function handleProductCheckboxChange(checkbox) {
        const productId = checkbox.getAttribute('data-id');
        const quantity = checkbox.getAttribute('data-quantity');
        console.log(quantity);
        if (checkbox.checked) {
            updateSelectedProducts(productId, quantity);
        } else {
            selectedProducts = selectedProducts.filter(product => product.product_id !== productId);
        }

        hiddenInput.value = JSON.stringify(selectedProducts);
        console.log(hiddenInput.value);
    }

    function incrementValue(e) {
        e.preventDefault();
        var parent = $(e.target).closest('.input-group');
        var input = parent.find('input[name="quantity"]');
        var currentVal = parseInt(input.val(), 10);
        var productId = parent.data('product-id');

        if (!isNaN(currentVal)) {
            var newVal = currentVal + 1;
            input.val(newVal);
            parent.attr('data-quantity', newVal); // Update data-quantity attribute
            updateQuantity(productId, newVal);
            updateQtyInput(productId, newVal);
        } else {
            input.val(0);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var parent = $(e.target).closest('.input-group');
        var input = parent.find('input[name="quantity"]');
        var currentVal = parseInt(input.val(), 10);
        var productId = parent.data('product-id');

        if (!isNaN(currentVal) && currentVal > 1) {
            var newVal = currentVal - 1;
            input.val(newVal);
            parent.attr('data-quantity', newVal); // Update data-quantity attribute
            updateQuantity(productId, newVal);
            updateQtyInput(productId, newVal);
        } else {
            input.val(1);
        }
    }

    function updateQtyInput(productId, quantity) {
        var checkbox = $('.product-checkbox[data-id="' + productId + '"]');
        checkbox.attr('data-quantity', quantity);
        console.log('Updated checkbox data-quantity attribute:', { productId, quantity });

        if (checkbox.prop('checked')) {
            updateSelectedProducts(productId, quantity);
        }
    }

    $('.button-plus').on('click', incrementValue);
    $('.button-minus').on('click', decrementValue);

    // Attach event listeners for artist-checkbox
    $('.artist-checkbox').change(function() {
        var index = $(this).attr('id').split('_')[1];
        var checkboxes = $('.product-checkbox.artist-' + index);
        checkboxes.prop('checked', $(this).prop('checked'));
        checkboxes.each(function() {
            handleProductCheckboxChange(this);
        });
    });

    // Attach event listeners for product-checkbox
    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            handleProductCheckboxChange(this);
        });
    });

    const updateQuantity = function(productId, quantity) {
        console.log('Updating quantity:', { productId, quantity });
        $.ajax({
            url: '{{ route('front.updateQuantity') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    console.log('Quantity updated:', response.quantity);
                } else {
                    console.error('Error updating quantity:', response.message);
                }
            },
            error: function(xhr) {
                console.error('AJAX error:', xhr.responseText);
            }
        });
    };
});

</script>