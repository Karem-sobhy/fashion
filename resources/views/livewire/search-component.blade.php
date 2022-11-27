<section class="section latest-section">
    @php
        $wishitems = Cart::instance('wish')
            ->content()
            ->pluck('id');
    @endphp
    <div class="container">
        <div class="big-title">
            <div class="hr-border"></div>
            <h2 class="title">Search For : "{{ $q }}"</h2>
            <div class="hr-border"></div>
        </div>
    </div>
    <div class="products-cards">
        <div class="container mt-4">
            <div class="row">

                <div class="row  justify-content-center">
                    {{-- @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="product-card">
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                    <div class="card-img">
                                        <img src="{{ asset('assets/img/Products') }}/{{ $product->image }}"
                                            alt="{{ $product->name }}" />

                                        @if (!is_null($product->sale_price) && $product->price > $product->sale_price)
                                            @php
                                                $percentage = (($product->price - $product->sale_price) / $product->price) * 100;
                                            @endphp
                                            <span class="price">${{ $product->sale_price }}</span>
                                            <span class="percentage">
                                                {{ number_format($percentage, 0) }}% <br />
                                                OFF
                                            </span>
                                        @else
                                            <span class="price">${{ $product->price }}</span>
                                        @endif
                                        <span class="eye">
                                            <i class="fa-regular fa-eye"></i>
                                        </span>
                                    </div>
                                </a>
                                <span class="product-name"
                                    title="{{ $product->name }}">{{ Str::limit($product->name, 15, '...') }}</span>

                                <div class="ratings">
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star rating-color"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="icons">
                                    <button href="#">
                                        <i class="fa-solid fa-heart icon"></i>
                                    </button>
                                    <button href="#">
                                        <i class="fa-solid fa-cart-plus icon"></i>
                                    </button>
                                    <button class="icon-copy" data-clipboard-text="http://google.com"
                                        data-bs-toggle="tooltip" data-bs-title="Link Coppied!" data-bs-trigger="focus"
                                        data-bs-delay='{"hide":600}' data-bs-placement="right">
                                        <i class="fa-solid fa-share-nodes icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                    @foreach ($products as $product)
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="product-card">
                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                    <div class="card-img">
                                        <img src="{{ asset('assets/img/Products') }}/{{ $product->image }}"
                                            alt="{{ $product->name }}" />

                                        @if (!is_null($product->sale_price) && $product->price > $product->sale_price)
                                            @php($percentage = (($product->price - $product->sale_price) / $product->price) * 100)
                                            <span class="price">${{ $product->sale_price }}</span>
                                            <span class="percentage">
                                                {{ number_format($percentage, 0) }}% <br />
                                                OFF
                                            </span>
                                        @else
                                            <span class="price">${{ $product->price }}</span>
                                        @endif
                                        <span class="eye">
                                            <i class="fa-regular fa-eye"></i>
                                        </span>
                                    </div>
                                </a>
                                <span class="product-name">{{ Str::limit($product->name, 15, '...') }}</span>
                                <div class="ratings">
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 1])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 2])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 3])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 4])></i>
                                    <i @class(['fa', 'fa-star', 'rating-color' => $product->rating() >= 5])></i>
                                </div>

                                <div class="icons">

                                    @if ($wishitems->contains($product->id))
                                        <button wire:click.prevent="removewish('{{ $product->slug }}')">
                                            <i class="fa-solid fa-heart icon active"></i></button>
                                    @else
                                        <button wire:click.prevent="addwish('{{ $product->slug }}')">
                                            <i class="fa-solid fa-heart icon"></i></button>
                                    @endif

                                    <button wire:click.prevent="store('{{ $product->slug }}')"
                                        wire:loading.attr="disabled">
                                        <i class="fa-solid fa-cart-plus icon"></i>
                                    </button>
                                    <button class="icon-copy" data-clipboard-text="http://google.com"
                                        data-bs-toggle="tooltip" data-bs-title="Link Coppied!" data-bs-trigger="focus"
                                        data-bs-delay='{"hide":600}' data-bs-placement="right" onclick="this.focus()">
                                        <i class="fa-solid fa-share-nodes icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex align-items-center justify-content-center mt-5"
                        onclick="document.documentElement.scrollTop = 0;">
                        {{ $products->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
