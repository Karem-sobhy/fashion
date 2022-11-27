@section('title', 'Products')

@section('content_header')
    <h1>
        Products</h1>
@stop

{{-- @section('content') --}}
<div class="row">
    <div class="col-12">
        <a class="btn btn-primary my-4" href="{{ route('admin.productsAdd') }}" d>
            <i class="fas fa-plus">
            </i>
            Add New
        </a>
        <div class="card">
            <div class="card-header">
                <div class="input-group w-25">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Items Per Page</label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" wire:model='itemsPerPage'>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="all">all</option>
                        {{-- <option value="{{ $categories->count() }}">All</option> --}}
                    </select>
                </div>
            </div>
            @error('editCatName')
                <div class="alert alert-danger">
                    <strong>Error</strong>: {{ $message }}
                </div>
            @enderror
            @error('NewCatName')
                <div class="alert alert-danger">
                    <strong>Error</strong>: {{ $message }}
                </div>
            @enderror
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <strong>Success</strong> {{ Session::get('success') }}
                </div>
            @endif
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Sale Price</th>
                            <th>Featured</th>
                            <th>QTY</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th>{{ $product->id }}</th>
                                <td><img src="{{ asset('assets/img/Products') }}/{{ $product->image }}" class=""
                                        height="200px" width="200px">
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <th>{{ $product->name }}</th>
                                <td><span @class([
                                    'text-success' => $product->stock_status == 'instock',
                                    'text-danger' => $product->stock_status == 'outofstock',
                                ])>{{ $product->stock_status }}</span></td>
                                <td>${{ $product->price }}</td>
                                <td>
                                    @if ($product->sale_price != null)
                                        ${{ $product->sale_price }}
                                    @else
                                        None
                                    @endif
                                </td>
                                <td>
                                    @if ($product->featured)
                                        <input type="checkbox" checked wire:change='feature(0,{{ $product->id }})'>
                                    @else
                                        <input type="checkbox" wire:change='feature(1,{{ $product->id }})'>
                                    @endif
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                        <i class="fas fa-folder">
                                        </i>
                                        View
                                    </a>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('admin.productsEdit', ['product' => $product->id]) }}"
                                        class="btn btn-danger">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    @if ($product->stock_status == 'instock')
                                        <button class="btn btn-danger btn-sm"
                                            wire:click="stock('outofstock',{{ $product->id }})"
                                            class="btn btn-danger">
                                            <i class="fas fa-trash">
                                            </i>
                                            Out Of Stock
                                        </button>
                                    @elseif ($product->stock_status == 'outofstock' && $product->quantity > 0)
                                        <button class="btn btn-success btn-sm"
                                            wire:click="stock('instock',{{ $product->id }})" class="btn btn-success">
                                            <i class="fas fa-plus">
                                            </i>
                                            In Stock
                                        </button>
                                    @endif
                                    {{-- <button class="btn btn-danger btn-sm" wire:click="deleteId({{ $product->id }})"
                                        class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </button> --}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @if ($itemsPerPage != 'all')
            <div class="mt-3 d-flex justify-content-center text-center"> {{ $products->links() }}</div>
        @endif

    </div>
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete {{ $delProductName }} ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
</div>

{{-- @stop --}}
