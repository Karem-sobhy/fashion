@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
@stop

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
                @endif
                @if (Session::has('error_message'))
                    <div class="alert alert-danger">
                        <strong>Error</strong> {{ Session::get('error_message') }}
                    </div>
                @endif --}}

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
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Products
                        <span>${{ $order->subtotal }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        Discount
                        <span>${{ $order->discount }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        Tax
                        <span>${{ $order->tax }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
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
        <div class="card">
            <div class="card-body">
                <p><strong>Order Details</strong></p>
                <p><strong>User : {{ $order->user->name }}</strong></p>
                <div class="row text-center">
                    <div class="col-12">Phone : {{ $order->phone }}</div>
                    <div class="col-6">Line1 : {{ $order->line1 }}</div>
                    <div class="col-6">Line2 : {{ $order->line2 }}</div>
                    <div class="col-6">Zip : {{ $order->zip }}</div>
                    <div class="col-6">City : {{ $order->city }}</div>
                    <div class="col-6">State : {{ $order->state }}</div>
                    <div class="col-6">Country : {{ $order->country }}</div>
                </div>

            </div>
        </div>
    </div>
</div>
