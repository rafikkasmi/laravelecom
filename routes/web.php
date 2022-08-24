<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\It\ProductsController;
use App\Http\Controllers\It\EventsController as ITEventsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EventsController as AdminEventsController;
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
});

    Route::get("/welcome", function(){
        return view("welcome");
     })->name('welcome');
