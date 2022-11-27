@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

{{-- @section('content') --}}
<div class="row">
    <div class="col">
        <button class="btn btn-primary my-4" href="#" class="btn btn-danger" data-toggle="modal"
            data-target="#newmodal">
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

                    </select>
                </div>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <strong>Success</strong> {{ Session::get('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body table-responsive p-0 text-center">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            @if ($isAdmin)
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th>{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->utype }}</td>
                                @if ($isAdmin)
                                    <td class="project-actions text-right">
                                        {{-- <a class="btn btn-primary btn-sm" href="#">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a> --}}
                                        <button class="btn btn-info btn-sm" href="#" class="btn btn-danger"
                                            data-toggle="modal" data-target="#passmodal"
                                            wire:click='passId("{{ $user->id }}")'>
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit Password
                                        </button>
                                        <button class="btn btn-info btn-sm" href="#" class="btn btn-danger"
                                            data-toggle="modal" data-target="#editmodal"
                                            wire:click='editId("{{ $user->id }}")'>
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" class="btn btn-danger" data-toggle="modal"
                                            wire:click='deleteId("{{ $user->id }}")' data-target="#exampleModal">
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
            <div class="mt-3 d-flex justify-content-center text-center"> {{ $users->links() }}</div>
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
                    <p>Are you sure want to delete {{ $delName }} ?</p>
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
                    <p>Change User</p>
                    <input type="text" class="form-control" placeholder="Category" aria-label="cat"
                        aria-describedby="basic-addon1" wire:model='editName'>
                    <br>
                    <select class="custom-select" id="inputGroupSelect01" wire:model='editType'>
                        <option value="admin">Admin</option>
                        <option value="mod">Moderator</option>
                        <option value="user">User</option>

                    </select>
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
    <div wire:ignore.self class="modal fade" id="passmodal" tabindex="-1" role="dialog"
        aria-labelledby="passmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passmodalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Change the password of {{ $passName }}</p>
                    <input type="password" class="form-control" placeholder="Password" aria-label="cat"
                        aria-describedby="basic-addon1" wire:model='newPass'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="pass()" class="btn btn-primary close-modal"
                        data-dismiss="modal">change</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
    {{-- Modal --}}
    <div wire:ignore.self class="modal fade" id="newmodal" tabindex="-1" role="dialog"
        aria-labelledby="newmodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newmodalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>New User</p>
                    <input type="text" class="form-control" placeholder="Name" aria-label=""
                        aria-describedby="basic-addon1" wire:model='name'>
                    <br>
                    <input type="email" class="form-control" placeholder="E-Mail" aria-label=""
                        aria-describedby="basic-addon1" wire:model='email'><br>
                    <input type="password" class="form-control" placeholder="Password" aria-label=""
                        aria-describedby="basic-addon1" wire:model='password'><br>
                    @if ($isAdmin)
                        <select class="custom-select" id="inputGroupSelect02" wire:model='utype'>
                            <option value="admin">Admin</option>
                            <option value="mod">Moderator</option>
                            <option value="user">User</option>
                        </select>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="add()" class="btn btn-primary close-modal"
                        data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}
</div>

{{-- @stop --}}
