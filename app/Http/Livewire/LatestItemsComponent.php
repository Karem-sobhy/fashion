<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class LatestItemsComponent extends Component
{
    use WithPagination;
    public $item_count = 8;
    public function add_items()
    {
        sleep(1);
        $this->item_count += 4;
    }
    public function store($slug)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $product = Product::where('slug', $slug)->firstOrFail();
        // dd($product);
        Cart::instance('cart')->add($product, 1);
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

    public function render()
    {
        // Cart Store Start
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wish')->store(Auth::user()->email);
        }
        // Cart Store End
        $products = Product::active()->paginate($this->item_count);
        return view('livewire.latest-items-component', ['products' => $products]);
    }
}