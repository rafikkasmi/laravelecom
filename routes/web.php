<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\It\ProductsController;
use App\Http\Controllers\It\EventsController as ITEventsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EventsController as AdminEventsController;
use App\Http\Controllers\Shop\PagesController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\Shop\ReviewController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Events\EventsController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
Route::group(['middleware' => 'guest'], function () {
Route::get("/login", function(){
    return view("auth.login");
 })->name('login');
 Route::get("/register", function(){
    return view("auth.register");
 })->name('register');
 Route::post('/login', [AuthController::class, 'login'])->name('login.post');
 Route::post('/register', [AuthController::class, 'register'])->name('register.post');

});

 Route::post('/login', [AuthController::class, 'login'])->name('login.post');
 Route::post('/register', [AuthController::class, 'register'])->name('register.post');

 Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    //les routes de it dashboard
    // if(User::findOrFail(Auth::user()->id)->role_id == User::IT_ROLE){
        Route::prefix('it')->name('it.')->group(function () {
            Route::resource('products', ProductsController::class);
            Route::resource('events', ITEventsController::class);
        });  
       
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('users', UsersController::class);
            Route::patch('/users/block/{id}', [UsersController::class,'block'])->name('users.block');
            
            Route::patch('/events/accept/{id}', [AdminEventsController::class,'accept'])->name('events.accept');
            Route::patch('/events/deny/{id}', [AdminEventsController::class,'deny'])->name('events.deny');
            Route::get('events/pending', [AdminEventsController::class,'pending'])->name('events.pending');
            Route::resource('events', AdminEventsController::class);

            // Route::name('products.')->prefix('products')->group(function() {
            //     Route::get('/', [ProductsController::class,'index'])->name('index');
            //     Route::get('/add', [ProductsController::class,'addPage'])->name('addPage');
            //     Route::post('/add', [ProductsController::class,'create'])->name('create');
            //     Route::get('/edit/{id}', [ProductsController::class,'edit'])->name('edit');
            //     Route::patch('/edit/{id}', [ProductsController::class,'update'])->name('update');
            //     Route::delete('/delete/{id}', [ProductsController::class,'delete'])->name('delete');
                
            // });
            
            // Route::resource('evenements', PhotoController::class);
        });  
    // }
    
    Route::get("/cart", [PagesController::class,'cart'])->name('cart');
    Route::post("/cart/{id}", [CartController::class,'addToCart'])->name('addToCart');
    Route::post("/cart/remove/{id}", [CartController::class,'removeFromCart'])->name('removeFromCart');
    Route::get("/cart-count", [CartController::class,'cartCount'])->name('cartCount');
    Route::post("/product/{id}/review", [ReviewController::class,'postReview'])->name('postReview');

    //checkout
    Route::get("/checkout", [PagesController::class,'checkout'])->name('checkout');
    Route::post("/checkout", [CheckoutController::class,'confirmOrder'])->name('confirmOrder');

    //events
    Route::get("/event/like/{id}", [EventsController::class,'like'])->name('like');
    Route::post("/event/comment/{id}", [EventsController::class,'comment'])->name('comment');

    //account
    Route::get("/account", [AccountController::class,'index'])->name('checkout');
    Route::post("/account/update-user-data", [AccountController::class,'updateUserData'])->name('updateUserData');
    Route::post("/account/reset-password", [AccountController::class,'resetPassword'])->name('resetPassword');

    Route::get("/account/orders", [AccountController::class,'orders'])->name('orders');
    

});

    Route::get("/", [PagesController::class,'index'])->name('index');
    Route::get("/shop", [PagesController::class,'shop'])->name('shop');
    Route::get("/product/{id}", [PagesController::class,'product'])->name('product');

    Route::get("/events", [EventsController::class,'index'])->name('index');
