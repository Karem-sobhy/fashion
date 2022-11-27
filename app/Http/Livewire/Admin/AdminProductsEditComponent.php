<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminProductsEditComponent extends Component
{
    use WithFileUploads;
    public $product_id;
    public $category_id;
    public $name;
    public $slug;
    public $desc;
    public $stock_status;
    public $price;
    public $sale_price;
    public $featured;
    public $quantity;
    public $image;
    public $newimage;

    public function mount(Product $product)
    {
        // dd($product);
        $this->product_id = $product->id;
        $this->category_id = $product->category_id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->desc = $product->desc;
        $this->stock_status = $product->stock_status;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->image = $product->image;
    }

    public function edit()
    {
        // dd($this);
        $this->slug = Str::slug($this->name);
        $productValues = $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name'          => 'required',
            'slug'          => 'required',
            'desc'          => 'required',
            'price'             => 'required|numeric',
            'sale_price'    => 'nullable',
            'featured'      => 'required|boolean',
            'quantity'      => 'required|integer',
        ]);

        if ($this->newimage) {
            $imagename = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('Products', $imagename);
            $this->image = $imagename;
            $this->newimage = null;
        }
        $product = Product::find($this->product_id);
        $product->image = $this->image;
        if ($this->stock_status) {
            $product->stock_status = 'instock';
        } else {
            $product->stock_status = 'outofstock';
        }
        $product->category_id = $this->category_id;
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->desc = $this->desc;
        $product->price = $this->price;
        $product->sale_price = $this->sale_price;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;
        $product->save();
        session()->flash('success', 'Product Updated Succesfully');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-products-edit-component', ['categories' => $categories])->extends('adminlte::page')->section('content');
    }
}