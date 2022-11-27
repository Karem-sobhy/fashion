<section class="section latest-section">
    <div class="container">
        <div class="big-title">
            <div class="hr-border"></div>
            <h2 class="title">Wishlist</h2>
            <div class="hr-border"></div>
        </div>
    </div>
    @php
        $wishitems = Cart::instance('wish')
            ->content()
            ->pluck('id');
    @endphp
    <div class="products-cards">
        <div class="container mt-4">
            <div class="row">

                @if (Cart::instance('wish')->count() > 0)
                    <div class="row  justify-content-center">
                        @foreach (Cart::instance('wish')->content() as $key => $item)
                            {{-- <div class="col-12 col-sm-6 col-md-3">
                                <div class="product-card">
                                    <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}">
                                        <div class="card-img">
                                            <img src="{{ asset('assets/img/Products') }}/{{ $item->model->image }}"
                                                alt="{{ $item->model->name }}" />

                                            @if (!is_null($item->model->sale_price) && $item->model->price > $item->model->sale_price)
                                                @php
                                                    $percentage = (($item->model->price - $item->model->sale_price) / $item->model->price) * 100;
                                                @endphp
                                                <span class="price">${{ $item->model->sale_price }}</span>
                                                <span class="percentage">
                                                    {{ number_format($percentage, 0) }}% <br />
                                                    OFF
                                                </span>
                                            @else
                                                <span class="price">${{ $item->model->price }}</span>
                                            @endif
                                            <span class="eye">
                                                <i class="fa-regular fa-eye"></i>
                                            </span>
                                        </div>
                                    </a>
                                    <span class="product-name"
                                        title="{{ $item->model->name }}">{{ Str::limit($item->model->name, 15, '...') }}</span>

                                    <div class="ratings">
                                        <i class="fa fa-star rating-color"></i>
                                        <i class="fa fa-star rating-color"></i>
                                        <i class="fa fa-star rating-color"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="icons">
                                        @if ($wishitems->contains($item->model->id))
                                            <button wire:click.prevent="removewish('{{ $item->model->slug }}')">
                                                <i class="fa-solid fa-heart icon active"></i></button>
                                        @else
                                            <button wire:click.prevent="addwish('{{ $item->model->slug }}')">
                                                <i class="fa-solid fa-heart icon"></i></button>
                                        @endif

                                        <button wire:click.prevent="store('{{ $item->model->slug }}')"
                                            wire:loading.attr="disabled">
                                            <i class="fa-solid fa-cart-plus icon"></i>
                                        </button>
                                        <button class="icon-copy" data-clipboard-text="http://google.com"
                                            data-bs-toggle="tooltip" data-bs-title="Link Coppied!"
                                            data-bs-trigger="focus" data-bs-delay='{"hide":600}'
                                            data-bs-placement="right">
                                            <i class="fa-solid fa-share-nodes icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="product-card">
                                    <a href="{{ route('product.details', ['slug' => $item->model->slug]) }}">
                                        <div class="card-img">
                                            <img src="{{ asset('assets/img/Products') }}/{{ $item->model->image }}"
                                                alt="{{ $item->model->name }}" />

                                            @if (!is_null($item->model->sale_price) && $item->model->price > $item->model->sale_price)
                                                @php($percentage = (($item->model->price - $item->model->sale_price) / $item->model->price) * 100)
                                                <span class="price">${{ $item->model->sale_price }}</span>
                                                <span class="percentage">
                                                    {{ number_format($percentage, 0) }}% <br />
                                                    OFF
                                                </span>
                                            @else
                                                <span class="price">${{ $item->model->price }}</span>
                                            @endif
                                            <span class="eye">
                                                <i class="fa-regular fa-eye"></i>
                                            </span>
                                        </div>
                                    </a>
                                    <span class="product-name">{{ Str::limit($item->model->name, 15, '...') }}</span>
                                    <div class="ratings">
                                        <i @class([
                                            'fa',
                                            'fa-star',
                                            'rating-color' => $item->model->rating() >= 1,
                                        ])></i>
                                        <i @class([
                                            'fa',
                                            'fa-star',
                                            'rating-color' => $item->model->rating() >= 2,
                                        ])></i>
                                        <i @class([
                                            'fa',
                                            'fa-star',
                                            'rating-color' => $item->model->rating() >= 3,
                                        ])></i>
                                        <i @class([
                                            'fa',
                                            'fa-star',
                                            'rating-color' => $item->model->rating() >= 4,
                                        ])></i>
                                        <i @class([
                                            'fa',
                                            'fa-star',
                                            'rating-color' => $item->model->rating() >= 5,
                                        ])></i>
                                    </div>

                                    <div class="icons">

                                        @if ($wishitems->contains($item->model->id))
                                            <button wire:click.prevent="removewish('{{ $item->model->slug }}')">
                                                <i class="fa-solid fa-heart icon active"></i></button>
                                        @else
                                            <button wire:click.prevent="addwish('{{ $item->model->slug }}')">
                                                <i class="fa-solid fa-heart icon"></i></button>
                                        @endif

                                        <button wire:click.prevent="store('{{ $item->model->slug }}')"
                                            wire:loading.attr="disabled">
                                            <i class="fa-solid fa-cart-plus icon"></i>
                                        </button>
                                        <button class="icon-copy" data-clipboard-text="http://google.com"
                                            data-bs-toggle="tooltip" data-bs-title="Link Coppied!"
                                            data-bs-trigger="focus" data-bs-delay='{"hide":600}'
                                            data-bs-placement="right" onclick="this.focus()">
                                            <i class="fa-solid fa-share-nodes icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <em class="text-center">Your Wishlist is empty <span style="font-style: normal;">😢💔!</span></em>
                @endif

            </div>
        </div>
    </div>
</section>
