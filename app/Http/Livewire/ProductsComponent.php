<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;




class ProductsComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $title = 'Our Products';
    public $slug;


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




    public function mount($slug = '')
    {
        if ($slug == '') {
            return;
        }
        $this->slug = $slug;
    }
    public function render()
    {
        // Cart Store Start
        if (Auth::check()) {
            Cart::instance('cart')->store(Auth::user()->email);
            Cart::instance('wish')->store(Auth::user()->email);
        }
        // Cart Store End

        if ($this->slug == '') {
            $products = Product::active()->paginate(8);
        } else {
            $category = Category::where('slug', $this->slug)->firstOrFail();
            $this->title = $category->name;
            $products = $category->product()->active()->paginate(8);
        }
        $categories = Category::all();
        return view('livewire.products-component', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}