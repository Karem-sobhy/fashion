<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductComponent extends Component
{
    public $slug;
    public $is_sale = false;
    public $product;
    public $qty;
    public function store()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $qty = $this->qty;
        if ($qty == null || $qty < 1) {
            $qty = 1;
        }
        Cart::instance('cart')->add($this->product, $qty);
        session()->flash('success_message', 'Item added in cart!');
        return redirect()->route('user.cart');
    }
    public function addwish($slug)
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::where('slug', $slug)->firstOrFail();
        Cart::instance('wish')->add($product, 1);
        // session()->flash('success_message', 'Item added in cart!');
        // return redirect()->route('user.cart');
    }
    public function removewish($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::where('slug', $slug)->firstOrFail();
        foreach (Cart::instance('wish')->content() as $wishitem)
            if ($wishitem->id == $product->id) {
                Cart::instance('wish')->remove($wishitem->rowId);
                return;
            }
        // session()->flash('success_message', 'Item added in cart!');
        // return redirect()->route('user.cart');
    }
    public function mount($slug)
    {
        $this->slug = $slug;
        $this->product = Product::where('slug', $this->slug)->firstOrFail();
    }
    public function render()
    {
        // Cart Store Start
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wish')->store(Auth::user()->email);
        }
        // Cart Store End
        return view('livewire.product-component', ['product' => $this->product]);
    }
}