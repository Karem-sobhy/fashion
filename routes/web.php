<?php

use App\Http\Controllers\FacebookController;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminOrderComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminProductsAddComponent;
use App\Http\Livewire\Admin\AdminProductsComponent;
use App\Http\Livewire\Admin\AdminProductsEditComponent;
use App\Http\Livewire\Admin\AdminUsersComponent;
use App\Http\Livewire\Admin\DashboardComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\FeaturedItemsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ProductComponent;
use App\Http\Livewire\ProductsComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\OrderComponent;
use App\Http\Livewire\User\OrderDetailsComponent;
use App\Http\Livewire\User\UserChangePasswordComponent;
use App\Http\Livewire\User\UserEditProfileComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class)->name('home.index');
Route::get('/shop', ProductsComponent::class)->name('home.shop');
Route::get('/featured', FeaturedItemsComponent::class)->name('home.featured');
Route::get('/product/{slug}', ProductComponent::class)->name('product.details');
Route::get('/category/{slug}', ProductsComponent::class)->name('product.category');
Route::get('/search/{q}', SearchComponent::class)->name('home.search');

Route::get('auth/facebook', [FacebookController::class, 'facebookRedirect'])->name('auth.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'loginWithFacebook']);


Route::middleware(['auth'])->group(function () {
    Route::get('/cart', CartComponent::class)->name('user.cart');
    Route::get('/checkout', CheckoutComponent::class)->name('user.checkout');
    Route::get('/wishlist', WishlistComponent::class)->name('user.wish');
    Route::get('/user/profile/changepassword', UserChangePasswordComponent::class)->name('user.changePassword');
    Route::get('/user/profile', UserProfileComponent::class)->name('user.profile');
    Route::get('/user/profile/edit', UserEditProfileComponent::class)->name('user.editprofile');
    Route::get('/user/orders', OrderComponent::class)->name('user.orders');
    Route::get('/user/orders/{order_id}', OrderDetailsComponent::class)->name('user.orderdetails');
});

Route::middleware(['auth', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', DashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/products', AdminProductsComponent::class)->name('admin.products');
    Route::get('/admin/products/add', AdminProductsAddComponent::class)->name('admin.productsAdd');
    Route::get('/admin/products/edit/{product}', AdminProductsEditComponent::class)->name('admin.productsEdit');
    Route::get('/admin/users', AdminUsersComponent::class)->name('admin.users');
    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/orders/pending', AdminOrderComponent::class)->name('admin.ordersPending');
    Route::get('/admin/orders/{order_id}', AdminOrderDetailsComponent::class)->name('admin.ordersDetails');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });