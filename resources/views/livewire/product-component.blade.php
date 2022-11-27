<main>
    <section class="product-info">
        <div class="container">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
                <a class="breadcrumb-item"
                    href="{{ route('product.category', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                <span class="breadcrumb-item active" aria-current="page">{{ $product->name }}</span>
            </nav>

            <div class="products-cards">
                <div class="container mt-4">
                    <div class="row gx-5">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="product-card">
                                <a>
                                    <div class="card-img">
                                        <img src="{{ asset('assets/img/Products') }}/{{ $product->image }}"
                                            alt="" />
                                        @if (!is_null($product->sale_price) && $product->price > $product->sale_price)
                                            @php
                                                $is_sale = true;
                                                $percentage = (($product->price - $product->sale_price) / $product->price) * 100;
                                            @endphp
                                            <span class="price">${{ $product->sale_price }}</span>
                                            <span class="percentage">
                                                {{ number_format($percentage, 0) }}% <br />
                                                OFF
                                            </span>
                                        @else
                                            <span class="price">${{ number_format($product->price, 2) }}</span>
                                        @endif

                                    </div>
                                </a>

                                <div class="ratings my-4">
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 1])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 2])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 3])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 4])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 5])></i>
                                </div>

                                <div class="icons">

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-9">
                            <div class="product-text">
                                <h1>{{ $product->name }}</h1>
                                <button class="icon-copy"
                                    data-clipboard-text="{{ route('product.details', ['slug' => $product->slug]) }}"
                                    data-bs-toggle="tooltip" data-bs-title="Link Coppied!" data-bs-trigger="focus"
                                    data-bs-delay='{"hide":600}' data-bs-placement="top" onclick="this.focus()">
                                    <i class="fa-solid fa-share-nodes icon"></i>
                                </button>
                                <hr />
                                @if ($is_sale)
                                    <span class="sale-per">-{{ number_format($percentage, 2) }}%</span>
                                    <span class="price-symbol">$</span>
                                    <span class="main-price">{{ number_format($product->sale_price, 0) }}</span>
                                    <span
                                        class="price-symbol">{{ substr(number_format($product->sale_price, 2), -2) }}</span>
                                    <br />
                                    <span class="list-price">List Price: </span><span
                                        class="removed-price">${{ $product->price }}</span><br />
                                @else
                                    <span class="price-symbol">$</span>
                                    <span class="main-price">{{ number_format($product->price, 0) }}</span>
                                    <span
                                        class="price-symbol">{{ substr(number_format($product->price, 2), -2) }}</span>
                                    <br />
                                @endif
                                <div class="desc mt-3">
                                    {{ $product->desc }}
                                </div>
                                <div class="stock mt-3">
                                    @if ($product->stock_status == 'instock')
                                        <div class="instock text-success">In Stock</div>
                                    @else
                                        <div class="outstock text-danger">Out of Stock!</div>
                                    @endif
                                </div>
                                <div class="qty mt-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="floatingqty"
                                            placeholder="Quantity" min="1" max="{{ $product->quantity }}"
                                            @disabled($product->stock_status != 'instock') wire:model='qty' />
                                        <label for="floatingqty">Quantity</label>
                                    </div>
                                </div>
                                <div class="buttons my-3">
                                    <button wire:click.prevent='store()' class="cart-add btn me-3"
                                        @disabled($product->stock_status != 'instock')>
                                        Add to cart <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                    {{-- <button class="wish-add">
                                        <i class="fa-solid fa-heart wish-btn"></i>
                                    </button> --}}
                                    @php
                                        $wishitems = Cart::instance('wish')
                                            ->content()
                                            ->pluck('id');
                                    @endphp
                                    @if ($wishitems->contains($product->id))
                                        <button class="wish-add"
                                            wire:click.prevent="removewish('{{ $product->slug }}')">
                                            <i class="fa-solid fa-heart wish-btn active"></i>
                                        @else
                                            <button class="wish-add"
                                                wire:click.prevent="addwish('{{ $product->slug }}')">
                                                <i class="fa-solid fa-heart wish-btn"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
