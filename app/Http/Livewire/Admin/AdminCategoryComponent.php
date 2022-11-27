<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $delCatName;
    public $delCatId;
    public $editCatName;
    public $editCatId;
    public $NewCatName;
    public $itemsPerPage = 5;
    public function editId(Category $category)
    {
        $this->editCatId = $category->id;
        $this->editCatName = $category->name;
    }
    public function edit()
    {
        $category = Category::find($this->editCatId);
        $this->validate(
            [
                'editCatName' => 'required|unique:categories,name',
            ],
            [
                'editCatName.required' => 'The Name cannot be empty.',
                'editCatName.unique' => 'The Name is Already Taken.',
            ],
        );
        $category->name = $this->editCatName;
        $category->slug = Str::slug($this->editCatName);
        $category->save();
    }
    public function add()
    {

        $this->validate(
            [
                'NewCatName' => 'required|unique:categories,name',
            ],
            [
                'NewCatName.required' => 'The Name cannot be empty.',
                'NewCatName.unique' => 'The Name is Already Taken.',
            ],
        );
        $category = new Category();
        $category->name = $this->NewCatName;
        $category->slug = Str::slug($this->NewCatName);
        $category->save();
        session()->flash('success', 'Added Successfully!');
    }
    public function deleteId(Category $category)
    {
        $this->delCatId = $category->id;
        $this->delCatName = $category->name;
    }
    public function delete()
    {
        $category = Category::find($this->delCatId);
        $category->delete();
    }

    public function render()
    {
        $isAdmin = false;
        if (Auth::user()->utype == 'admin') {
            $isAdmin = true;
        }
        if ($this->itemsPerPage != 'all') {
            $categories = Category::paginate($this->itemsPerPage);
        } else {
            $categories = Category::all();
        }
        return view('livewire.admin.admin-category-component', ['categories' => $categories, 'isAdmin' => $isAdmin])->extends('adminlte::page')->section('content');
    }
}