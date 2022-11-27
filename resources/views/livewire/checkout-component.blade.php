<section class="h-100">
    <div class="container py-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <a class="breadcrumb-item" href="{{ route('user.cart') }}">Cart</a>
            <span class="breadcrumb-item active" aria-current="page">Checkout</span>
        </nav>
        <form action="" wire:submit.prevent='placeOrder()'>
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">Billing Info</h5>
                        </div>
                        <div class="card-body">
                            @if (Session::has('success_message'))
                                <div class="alert alert-success">
                                    <strong>Success</strong> {{ Session::get('success_message') }}
                                </div>
                            @endif

                            <!-- Address -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Name</label>
                                            <input type="text" class="form-control" id="inputName" wire:model='name'>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputName" class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="inputName"
                                                wire:model='phone'>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="inputAddress"
                                                wire:model='line1'>
                                            @error('line1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCity" class="form-label">City</label>
                                            <input type="text" class="form-control" id="inputCity" wire:model='city'>
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label">State</label>
                                            <input id="inputState" class="form-control" type="text"
                                                wire:model='state'>
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputZip" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="inputZip" wire:model='zip'>
                                            @error('zip')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Address -->
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h5 class="mb-0">Summary</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Sub Total
                                    <span>${{ Cart::instance('cart')->subTotal() }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                    Total Discount
                                    <span>${{ $discount }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    Tax
                                    <span>${{ Cart::instance('cart')->tax() }}</span>
                                </li>
                                <li
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                    <div>
                                        <strong>Total amount</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                    </div>
                                    <span><strong>${{ Cart::instance('cart')->total() }}</strong></span>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Place Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
