<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AdminProductsAddComponent extends Component
{
    use WithFileUploads;
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


    public function add()
    {
        $this->slug = Str::slug($this->name);
        $productValues = $this->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|unique:products,name',
            'slug' => 'required',
            'desc' => 'required',
            'stock_status' => 'required|boolean',
            'price' => 'required|numeric',
            'sale_price' => 'nullable',
            'featured' => 'required|boolean',
            'quantity' => 'required|integer',
        ]);

        if ($this->newimage) {
            $imagename = Carbon::now()->timestamp . '.' . $this->newimage->extension();
            $this->newimage->storeAs('Products', $imagename);
            $this->image = $imagename;
            $this->newimage = null;
        } else {
            session()->flash('error', 'Error put image');
            return true;
        }
        $product = new Product($productValues);
        $product->image = $this->image;
        if ($this->stock_status) {
            $product->stock_status = 'instock';
        } else {
            $product->stock_status = 'outofstock';
        }
        $product->save();
        session()->flash('success', 'Product added Succesfully');
        return redirect()->route('admin.products');
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.admin.admin-products-add-component', ['categories' => $categories])->extends('adminlte::page')->section('content');
    }
}