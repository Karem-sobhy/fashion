<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OrderDetailsComponent extends Component
{
    public $order_id;

    public function rate(OrderItem $orderItem, $num)
    {
        if ($orderItem->order->user_id != Auth::user()->id) {
            return redirect()->back();
        }
        $orderItem->review = $num;
        $orderItem->save();
        session()->flash('star', 'Rating Saved!');
    }
    public function mount($order_id)
    {
        $this->order_id = $order_id;
    }

    public function render()
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $this->order_id)->firstOrFail();

        return view('livewire.user.order-details-component', ['order' => $order]);
    }
}