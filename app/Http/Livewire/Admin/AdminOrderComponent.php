<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrderComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $itemsPerPage = 5;
    public $route;
    public function mount()
    {
        $route = Route::currentRouteName();
        $this->route = $route;
    }


    public function deliver(Order $order)
    {
        $order->status = 'deliverd';
        $order->save();
    }
    public function cancel(Order $order)
    {
        $order->status = 'canceled';
        $order->save();
    }
    public function order(Order $order)
    {
        $order->status = 'ordered';
        $order->save();
    }

    public function render()
    {
        if ($this->route == 'admin.orders') {
            if ($this->itemsPerPage != 'all') {
                $orders = Order::latest()->paginate($this->itemsPerPage);
            } else {
                $orders = Order::latest()->get();
            }
        } else {
            if ($this->itemsPerPage != 'all') {
                $orders = Order::where('status', 'ordered')->paginate($this->itemsPerPage);
            } else {
                $orders = Order::where('status', 'ordered')->get();
            }
        }
        return view('livewire.admin.admin-order-component', ['orders' => $orders])->extends('adminlte::page')->section('content');
    }
}