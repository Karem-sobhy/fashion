<section class="h-100">
    <div class="container py-3">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('home.index') }}">Home</a>
            <a class="breadcrumb-item">User</a>
            <span class="breadcrumb-item active" aria-current="page">Orders</span>
        </nav>
        <div class="row d-flex justify-content-center my-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Orders</h5>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success</strong> {{ Session::get('success_message') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Tax</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Zip Code</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <th scope="row">{{ $order->id }}</th>
                                            <td>${{ $order->subtotal }}</td>
                                            <td>${{ $order->discount }}</td>
                                            <td>${{ $order->tax }}</td>
                                            <td>${{ $order->total }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->zip }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td><a href="{{ route('user.orderdetails', ['order_id' => $order->id]) }}"
                                                    class="btn btn-primary"><i class="fa fa-solid fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex align-items-center justify-content-center">
                                {{ $orders->links() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
