<section class="h-100">
    <div class="container py-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <a class="breadcrumb-item">User</a>
            <span class="breadcrumb-item active" aria-current="page">Profile</span>
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
                        <div class="row">
                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                <!-- Image -->
                                <div class="rounded">
                                    @if ($user->profile->image)
                                        <img src="{{ asset('assets/img/profile') }}/{{ $user->profile->image }}"
                                            class="w-100" />
                                    @else
                                        <img src="{{ asset('assets/img/profile') }}/default.png" class="w-100" />
                                    @endif
                                </div>

                                <!-- Image -->
                            </div>
                            <div class="col-lg-9 col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmail4" readonly
                                            value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="inputName"
                                            value="{{ $user->name }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputName" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="inputName"
                                            value="{{ $user->profile->phone }}" readonly>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="inputAddress"
                                            value="{{ $user->profile->line1 }}" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Address 2</label>
                                        <input type="text" class="form-control" id="inputAddress2"
                                            value="{{ $user->profile->line2 }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCountry" class="form-label">Country</label>
                                        <input type="text" class="form-control" id="inputCountry"
                                            value="{{ $user->profile->country }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCity" class="form-label">City</label>
                                        <input type="text" class="form-control" id="inputCity"
                                            value="{{ $user->profile->city }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputState" class="form-label">State</label>
                                        <input id="inputState" class="form-control" type="text"
                                            value="{{ $user->profile->state }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputZip" class="form-label">Zip</label>
                                        <input type="text" class="form-control" id="inputZip"
                                            value="{{ $user->profile->zip }}" readonly>
                                    </div>

                                    <div class="col-12
                                            d-flex">
                                        <a href="{{ route('user.editprofile') }}"
                                            class="btn purple-btn ms-auto">Edit</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Profile -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
