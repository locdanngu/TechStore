<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Homepage');
})->name('home.page');

Route::get('/Loginpage', function () {
    return view('Loginpage');
})->name('login.page');

// Route::get('/Signuppage', function () {
//     return view('Signuppage');
// })->name('signup.page');

Route::get('/Forgotpage', function () {
    return view('Forgotpage');
})->name('forgot.page');

Route::get('/Profileuserpage', function () {
    return view('Profileuserpage');
})->name('profileuser.page');

// Route::post('/Userpage', [ProductController::class, 'showUser'])->name('user.page');

Route::get('/Userpage', [ProductController::class, 'showData'])->name('user.page');             //lỗi get post


Route::post('/Userpage/{idcategory}/{idprice}/{search?}', [ProductController::class, 'ajaxRequest'])->name('product.ajaxRequest');


Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/Signuppage', [RegisterController::class, 'create'])->name('signup.page');
Route::post('/register', [RegisterController::class, 'store'])->name('register');









Route::get('/test', function () {
    return view('test');
})->name('test');
