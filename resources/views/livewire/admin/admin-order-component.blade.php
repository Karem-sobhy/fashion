@section('title', 'Orders')

@section('content_header')
    <h1>Orders</h1>
@stop

<div class="row d-flex justify-content-center my-4">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">Orders</h5>
            </div>
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
                                <th scope="col">Email(User)</th>
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
                                    <th scope="row">{{ $order->user->email }}</th>
                                    <td>${{ $order->subtotal }}</td>
                                    <td>${{ $order->discount }}</td>
                                    <td>${{ $order->tax }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>{{ $order->zip }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.ordersDetails', ['order_id' => $order->id]) }}"
                                            class="btn btn-primary"><i class="fa fa-solid fa-eye"></i></a>
                                        @if ($order->status != 'ordered')
                                            <button wire:click='order("{{ $order->id }}")'
                                                class="btn btn-warning"><i class="fa fa-solid fa-check"></i>
                                                Pending</button>
                                        @endif
                                        @if ($order->status != 'deliverd')
                                            <button wire:click='deliver("{{ $order->id }}")'
                                                class="btn btn-success"><i class="fa fa-solid fa-check"></i>
                                                Deliverd</button>
                                        @endif
                                        @if ($order->status != 'canceled')
                                            <button wire:click='cancel("{{ $order->id }}")'
                                                class="btn btn-danger"><i class="fas fa-trash"></i>
                                                Cancel</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($itemsPerPage != 'all')
                        <div class="mt-3 d-flex justify-content-center text-center"> {{ $orders->links() }}</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
