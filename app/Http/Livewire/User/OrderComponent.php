<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class OrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(8);

        return view('livewire.user.order-component', ['orders' => $orders]);
    }
}