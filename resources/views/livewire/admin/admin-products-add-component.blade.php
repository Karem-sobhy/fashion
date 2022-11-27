@section('title', 'Products')

@section('content_header')
    <h1>
        Add Product</h1>
@stop

<div class="row d-flex justify-content-center my-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Product</h5>
            </div>
            <div class="card-body">
                @if (Session::has('success_message'))
                    <div class="alert alert-success">
                        <strong>Success</strong> {{ Session::get('success_message') }}
                    </div>
                @endif

                <!-- add -->
                <form wire:submit.prevent='add()'>
                    <div class="row">
                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                            <!-- Image -->
                            <div class="rounded">

                                @if ($newimage)
                                    <img src="{{ $newimage->temporaryUrl() }}" class="w-100" />
                                @elseif($image)
                                    <img src="{{ asset('assets/img/Products') }}/{{ $image }}" class="w-100" />
                                @endif
                                <input type="file" class="form-control" wire:model='newimage'>
                            </div>
                            <!-- Image -->
                        </div>
                        <div class="col-lg-9 col-md-12">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="inputName" wire:model='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Category</label>
                                    <select class="custom-select" id="inputGroupSelect01" wire:model='category_id'>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="inputAddress" class="form-label">Price</label>
                                    <input type="text" class="form-control" id="inputAddress" wire:model='price'>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="inputAddress2" class="form-label">Sale Price</label>
                                    <input type="text" class="form-control" id="inputAddress2"
                                        wire:model='sale_price'>
                                    @error('sale_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCountry" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="inputCountry" wire:model='quantity'>
                                    @error('quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mt-3 text-center">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" checked
                                            wire:model='stock_status'>
                                        <label class="form-check-label" for="exampleCheck1">Stock?</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2"
                                            wire:model='featured'>
                                        <label class="form-check-label" for="exampleCheck2">Featured</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model='desc'></textarea>
                                        @error('desc')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 d-flex">
                                    <a href="{{ route('admin.products') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary ml-auto">Save</button>
                                </div>
                            </div>
                        </div>
                        <!-- add -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
