    @section('title', 'Categories')

    @section('content_header')
        <h1>Categories</h1>
    @stop

    {{-- @section('content') --}}
    <div class="row">
        <div class="col-12">
            <button class="btn btn-primary my-4" href="#" class="btn btn-danger" data-toggle="modal"
                data-target="#addmodal">
                <i class="fas fa-plus">
                </i>
                Add New
            </button>
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
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Item Count</th>
                                @if ($isAdmin)
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th>{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->product->count() }}</td>

                                    @if ($isAdmin)
                                        <td class="project-actions text-right">
                                            {{-- <a class="btn btn-primary btn-sm" href="#">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a> --}}
                                            <button class="btn btn-info btn-sm" href="#"
                                                wire:click="editId({{ $category->id }})" class="btn btn-danger"
                                                data-toggle="modal" data-target="#editmodal">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                wire:click="deleteId({{ $category->id }})" class="btn btn-danger"
                                                data-toggle="modal" data-target="#exampleModal">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            @if ($itemsPerPage != 'all')
                <div class="mt-3 d-flex justify-content-center text-center"> {{ $categories->links() }}</div>
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
                        <p>Are you sure want to delete {{ $delCatName }} ?</p>
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

        {{-- Modal --}}
        <div wire:ignore.self class="modal fade" id="editmodal" tabindex="-1" role="dialog"
            aria-labelledby="editmodalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editmodalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Change Name of Category</p>
                        <input type="text" class="form-control" placeholder="Category" aria-label="cat"
                            aria-describedby="basic-addon1" wire:model='editCatName'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="edit()" class="btn btn-primary close-modal"
                            data-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal --}}
        {{-- Modal --}}
        <div wire:ignore.self class="modal fade" id="addmodal" tabindex="-1" role="dialog"
            aria-labelledby="addmodalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addmodalLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Name of Category</p>
                        <input type="text" class="form-control" placeholder="Category" aria-label="cat"
                            aria-describedby="basic-addon1" wire:model='NewCatName'>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                            data-dismiss="modal">Close</button>
                        <button type="button" wire:click.prevent="add()" class="btn btn-primary close-modal"
                            data-dismiss="modal">Add</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal --}}
    </div>

    {{-- @stop --}}
