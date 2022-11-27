<section class="h-100">
    <div class="container py-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <a class="breadcrumb-item" href="{{ route('user.orders') }}">Orders</a>
            <span class="breadcrumb-item active" aria-current="page">Order ({{ $order->id }})</span>
        </nav>
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Order - ({{ $order->id }})</h5>
                    </div>
                    <div class="card-body">
                        {{-- @if (Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success</strong> {{ Session::get('success_message') }}
                            </div>
                        @endif --}}
                        @if (Session::has('star'))
                            <div class="alert alert-success">
                                <strong>Success</strong> {{ Session::get('star') }}
                            </div>
                        @endif

                        @foreach ($order->orderitem as $item)
                            <!-- Single item -->
                            @unless($loop->first)
                                <hr class="my-4" />
                            @endunless
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="rounded">
                                        <a href="{{ route('product.details', ['slug' => $item->product->slug]) }}">
                                            <img src="{{ asset('assets/img/Products') }}/{{ $item->product->image }}"
                                                class="w-100" alt="{{ $item->product->name }} image" />
                                        </a>
                                    </div>
                                    <!-- Image -->
                                </div>

                                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0 d-flex flex-column">
                                    <!-- Data -->
                                    <p class=""><strong>{{ $item->product->name }}</strong></p>
                                    <div class="stars">
                                        <br>
                                        <p>Please Rate This Product</p>
                                        <div class="ratings hover d-flex">
                                            <div wire:click='rate("{{ $item->id }}",1)'><i
                                                    @class([
                                                        'fa',
                                                        'fa-star',
                                                        'rating-color' => $item->review != null && $item->review >= 1,
                                                    ])></i></div>
                                            <div wire:click='rate("{{ $item->id }}",2)'><i
                                                    @class([
                                                        'fa',
                                                        'fa-star',
                                                        'rating-color' => $item->review != null && $item->review >= 2,
                                                    ])></i></div>
                                            <div wire:click='rate("{{ $item->id }}",3)'><i
                                                    @class([
                                                        'fa',
                                                        'fa-star',
                                                        'rating-color' => $item->review != null && $item->review >= 3,
                                                    ])></i></div>
                                            <div wire:click='rate("{{ $item->id }}",4)'><i
                                                    @class([
                                                        'fa',
                                                        'fa-star',
                                                        'rating-color' => $item->review != null && $item->review >= 4,
                                                    ])></i></div>
                                            <div wire:click='rate("{{ $item->id }}",5)'><i
                                                    @class([
                                                        'fa',
                                                        'fa-star',
                                                        'rating-color' => $item->review != null && $item->review >= 5,
                                                    ])></i></div>

                                        </div>
                                    </div>
                                    <!-- Data -->
                                </div>

                                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                    <!-- Quantity -->
                                    <p class="text-start text-md-center">
                                        <strong>Quantity: {{ $item->quantity }} pieces</strong>
                                    </p>
                                    <!-- Quantity -->

                                    <!-- Price -->
                                    <p class="text-start text-md-center">
                                        <strong>Price: ${{ $item->price }}</strong>
                                    </p>
                                    <!-- Price -->

                                    <!-- Price -->
                                    <p class="text-start text-md-center">
                                        <strong>Total: ${{ $item->price * $item->quantity }}</strong>
                                    </p>
                                    <!-- Price -->
                                </div>
                            </div>
                            <!-- Single item -->
                        @endforeach

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
                                <span>${{ $order->subtotal }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                Discount
                                <span>${{ $order->discount }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                Tax
                                <span>${{ $order->tax }}</span>
                            </li>
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                <div>
                                    <strong>Total amount</strong>
                                    <strong>
                                        <p class="mb-0">(including VAT)</p>
                                    </strong>
                                </div>
                                <span><strong>${{ $order->total }}</strong></span>
                            </li>
                        </ul>

                        {{-- <button type="button" class="btn btn-primary btn-lg btn-block"
                            onclick="window.location='checkout';" @disabled($outofstock == 1 || Cart::instance('cart')->count() == 0 || $morethanstock == 1)>
                            Go to checkout
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
