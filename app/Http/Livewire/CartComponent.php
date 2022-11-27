<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{

    public $outofstock = false;
    public $morethanstock = false;

    public function remove($rowId)
    {

        Cart::instance('cart')->remove($rowId);
    }

    public function changenum($qty, $rowId)
    {
        if ($qty == '' || $qty < 1) {
            $qty = 1;
        }
        if ($qty > 500) {
            $qty = 500;
        }
        $product = Cart::instance('cart')->get($rowId);
        Cart::instance('cart')->update($rowId, $qty);
    }
    public function add($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty;
        Cart::instance('cart')->update($rowId, ++$qty);
    }

    public function minus($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty;
        Cart::instance('cart')->update($rowId, --$qty);
    }

    public function render()
    {
        // Cart Store Start
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wish')->store(Auth::user()->email);
        }
        // Cart Store End

        return view('livewire.cart-component');
    }
}