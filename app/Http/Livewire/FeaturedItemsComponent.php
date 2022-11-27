<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FeaturedItemsComponent extends Component
{
    public $home = false;
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

        $categories = Category::whereHas('product', function ($q) {
            $q->where('featured', 1)->where('stock_status', 'instock');
        })->get();
        $featured_categories = [];
        if ($this->home) {
            foreach ($categories as $category) {
                $featured_categories[] = Product::where('category_id', $category->id)->where('featured', 1)->active()->take(8)->get();
            }
        } else {
            foreach ($categories as $category) {
                $featured_categories[] = Product::where('category_id', $category->id)->where('featured', 1)->active()->get();
            }
        }
        return view('livewire.featured-items-component', [
            'categories' => $categories,
            'featured_categories' => $featured_categories
        ]);
    }
}