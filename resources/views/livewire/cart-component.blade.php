<section class="h-100">
    <div class="container py-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <span class="breadcrumb-item active" aria-current="page">Cart</span>
        </nav>
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Cart - {{ Cart::instance('cart')->count() }} items</h5>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success</strong> {{ Session::get('success_message') }}
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger">
                                <strong>Error</strong> {{ Session::get('error_message') }}
                            </div>
                        @endif

                        @php($i = 1)
                        @foreach (Cart::instance('cart')->content() as $key => $item)
                            <!-- Single item -->
                            @php(Cart::instance('cart')->update($item->rowId, $item->model))
                            @unless($loop->first)
                                <hr class="my-4" />
                            @endunless
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="rounded">
                                        <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}">
                                            <img src="{{ asset('assets/img/Products') }}/{{ $item->model->image }}"
                                                class="w-100" alt="{{ $item->model->name }} image" />
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0 d-flex flex-column">
                                    <!-- Data -->
                                    <p class=""><strong>{{ $item->model->name }}</strong></p>
                                    <div class="my-auto">

                                        @if ($item->model->stock_status == 'instock')
                                            <p class="text-success">In Stock</p>
                                            <p>Remaining: {{ $item->model->quantity }} Item.</p>
                                        @else
                                            @php($outofstock = true)
                                            <p class="text-danger">Out Of Stock!</p>
                                        @endif
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary btn-sm me-1 mb-2"
                                            title="Remove item" wire:click.prevent="remove('{{ $item->rowId }}')"
                                            wire:loading.attr="disabled">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-danger btn-sm mb-2"
                                            title="Move to the wish list">
                                            <i class="fas fa-heart"></i>
                                        </button> --}}
                                    </div>
                                    <!-- Data -->
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <!-- Quantity -->

                                    <div class="d-flex mb-4" style="max-width: 300px">
                                        <button wire:loading.attr="disabled" class="btn btn-primary px-3 me-2"
                                            wire:click.prevent="minus('{{ $item->rowId }}')">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        @if ($item->qty > $item->model->quantity)
                                            @php($morethanstock = 1)
                                        @endif
                                        <div class="form-floating">
                                            <input type="number" id="floatingqty" placeholder="Quantity"
                                                value="{{ $item->qty }}" min="1"
                                                wire:keyup.debounce.1000ms="changenum($event.target.value,'{{ $item->rowId }}')"
                                                @class([
                                                    'form-control',
                                                    'is-invalid' => $item->qty > $item->model->quantity,
                                                ]) />
                                            <label for="floatingqty">Quantity</label>
                                        </div>

                                        <button class="btn btn-primary px-3 ms-2" wire:loading.attr="disabled"
                                            wire:click.prevent="add('{{ $item->rowId }}')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <!-- Quantity -->

                                    <!-- Price -->
                                    <p class="text-start text-md-center">
                                        <strong>Price: ${{ $item->price }}</strong>
                                    </p>
                                    @if ($item->model->onSale())
                                        <p class="text-start text-md-center">
                                            <span class="text-danger">-{{ $item->model->sale() }}%</span>
                                            <del>${{ $item->model->price }}</del>
                                        </p>
                                    @endif
                                    <p class="text-start text-md-center"><strong>Total : {{ $item->subtotal }}</strong>
                                    </p>
                                    <!-- Price -->
                                </div>
                            </div>
                            <!-- Single item -->
                        @endforeach

                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Expected shipping delivery</strong></p>
                        <p class="mb-0">{{ \Carbon\Carbon::today()->addDays(3)->format('d M Y') }} -
                            {{ \Carbon\Carbon::today()->addDays(7)->format('d M Y') }}</p>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body">
                        <p><strong>We accept</strong></p>
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                            alt="Visa" />
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                            alt="American Express" />
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                            alt="Mastercard" />
                        <img class="me-2" width="45px"
                            src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png"
                            alt="PayPal acceptance mark" />
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="mb-0">Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Products
                                <span>${{ Cart::instance('cart')->subTotal() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Tax
                                <span>${{ Cart::instance('cart')->tax() }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                    <strong>
                                        <p class="mb-0">(including VAT)</p>
                                    </strong>
                                </div>
                                <span><strong>${{ Cart::instance('cart')->total() }}</strong></span>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-primary btn-lg btn-block"
                            onclick="window.location='checkout';" @disabled($outofstock == 1 || Cart::instance('cart')->count() == 0 || $morethanstock == 1)>
                            Go to checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
