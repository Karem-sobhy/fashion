<section class="h-100">
    <div class="container py-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <a class="breadcrumb-item">User</a>
            <a class="breadcrumb-item" href="{{ route('user.profile') }}">Profile</a>
            <span class="breadcrumb-item active" aria-current="page">Edit</span>
        </nav>
        <div class="row d-flex justify-content-center my-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Profile</h5>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success</strong> {{ Session::get('success_message') }}
                            </div>
                        @endif

                        <!-- Profile -->
                        <form wire:submit.prevent='updateProfile'>
                            <div class="row">
                                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                    <!-- Image -->
                                    <div class="rounded">

                                        @if ($newimage)
                                            <img wire:loading.class='opacity-25' wire:target="uploaded"
                                                src="{{ $newimage->temporaryUrl() }}" class="w-100" />
                                        @elseif($image)
                                            <img wire:loading.class='opacity-25' wire:target="uploaded"
                                                src="{{ asset('assets/img/profile') }}/{{ $image }}"
                                                class="w-100" />
                                        @else
                                            <img wire:loading.class='opacity-25' wire:target="uploaded"
                                                src="{{ asset('assets/img/profile') }}/default.png" class="w-100" />
                                        @endif
                                        <input type="file" class="form-control" wire:model='uploaded'
                                            wire:loading.attr="disabled" wire:target='uploaded'>
                                        <div wire:loading wire:target="uploaded" class="my-2">Uploading <div
                                                class="spinner-grow spinner-grow-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                        @error('uploaded')
                                            <span wire:loading.remove class="text-danger">Please upload only photos that are
                                                not bigger than
                                                1MB!</span>
                                        @enderror
                                    </div>
                                    <!-- Image -->
                                </div>
                                <div class="col-lg-9 col-md-12">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="inputName" wire:model='name'>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="inputName"
                                                wire:model='phone'>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="inputAddress"
                                                wire:model='line1'>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">Address 2</label>
                                            <input type="text" class="form-control" id="inputAddress2"
                                                wire:model='line2'>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCountry" class="form-label">Country</label>
                                            <input type="text" class="form-control" id="inputCountry"
                                                wire:model='country'>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">City</label>
                                            <input type="text" class="form-control" id="inputCity" wire:model='city'>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label">State</label>
                                            <input id="inputState" class="form-control" type="text"
                                                wire:model='state'>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="inputZip"
                                                wire:model='zip'>
                                        </div>
                                        <div class="col-12
                                            d-flex">
                                            <a href="{{ route('user.profile') }}" class="cancel-link">Cancel</a>
                                            <button type="submit" class="btn purple-btn ms-auto"
                                                wire:loading.attr="disabled" wire:target='uploaded'>save</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Profile -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
