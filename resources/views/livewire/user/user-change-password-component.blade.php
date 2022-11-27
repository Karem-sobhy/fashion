<div class="container py-3">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
        <a class="breadcrumb-item">User</a>
        <a class="breadcrumb-item" href="{{ route('user.profile') }}">Profile</a>
        <span class="breadcrumb-item active" aria-current="page">Change Password</span>
    </nav>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Change Password</div>

                <div class="card-body">
                    <form wire:submit.prevent='newpass()' method="POST" action="">
                        @csrf

                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach

                        <div class="form-group row my-2">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password"
                                    wire:model='current_password'>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password"
                                    wire:model='new_password'>
                            </div>
                        </div>

                        <div class="form-group row my-2">
                            <label for="password" class="col-md-4 col-form-label text-md-end">New Confirm
                                Password</label>

                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control"
                                    name="new_confirm_password" wire:model='new_confirm_password'>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
