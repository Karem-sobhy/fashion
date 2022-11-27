<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class AdminUsersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $itemsPerPage = 5;


    // Delete
    public $delId;
    public $delName;
    public function deleteId(User $user)
    {
        $this->delId = $user->id;
        $this->delName = $user->name;
    }
    public function delete()
    {
        $user = User::find($this->delId);
        $user->delete();
    }
    // Delete

    // Edit
    public $editId;
    public $editName;
    public $editType;
    public function editId(User $user)
    {
        $this->editId = $user->id;
        $this->editName = $user->name;
        $this->editType = $user->utype;
    }
    public function edit()
    {
        $user = User::find($this->editId);
        $user->name = $this->editName;
        $user->utype = $this->editType;
        $user->save();
    }
    // Edit

    // Change Password
    public $passId;
    public $passName;
    public $newPass;
    public function passId(User $user)
    {
        $this->passId = $user->id;
        $this->passName = $user->name;
    }
    public function pass()
    {
        $user = User::find($this->passId);
        $user->password = Hash::make($this->newPass);
        $user->save();
        session()->flash('success', 'Password for user ' . $this->passName . ' Updated!');
    }
    // Change Password

    // Add new User
    public $name;
    public $email;
    public $password;
    public $utype = 'user';
    public function add()
    {
        $userValues = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'utype' => 'required',
        ]);
        $user = new User($userValues);
        $user->password = Hash::make($this->password);
        $user->utype = $this->utype;
        $user->save();
        session()->flash('success', 'User Created!');
    }
    // Add new User

    public function render()
    {
        $isAdmin = false;
        if (Auth::user()->utype == 'admin') {
            $isAdmin = true;
        }
        if ($this->itemsPerPage != 'all') {
            $users = User::paginate($this->itemsPerPage);
        } else {
            $users = User::all();
        }
        return view('livewire.admin.admin-users-component', ['users' => $users, 'isAdmin' => $isAdmin])->extends('adminlte::page')->section('content');
    }
}