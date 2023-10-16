<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RealEstateController;
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
    return view('403');
});

Route::get('/', [RealEstateController::class, 'home'])
    ->name('index');

Route::get('/about', [RealEstateController::class, 'about'])
    ->name('about');

Route::get('/agent_single', [RealEstateController::class, 'agent_single'])
    ->name('agent_single');

Route::get('/agents_grid', [RealEstateController::class, 'agents_grid'])
    ->name('agents_grid');

Route::get('/blog_grid', [RealEstateController::class, 'blog_grid'])
    ->name('blog_grid');

Route::get('/blog_single', [RealEstateController::class, 'blog_single'])
    ->name('blog_single');

Route::get('/contact', [RealEstateController::class, 'contact'])
    ->name('contact');

Route::get('/property_grid', [RealEstateController::class, 'property_grid'])
    ->name('property_grid');

Route::get('/property_single', [RealEstateController::class, 'property_single'])
    ->name('property_single');

// Route::get('/testimonial', [RealEstateController::class, 'testimonial'])
//     ->name('testimonial');
Route::get('login', [LoginController::class, 'show_login']);

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', [LoginController::class, 'show_login'])->name('admin.login');
    Route::get('login', [LoginController::class, 'show_login'])->name('login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::group(['middleware' => 'auth'], function (){
        Route::get('forgot_password', [LoginController::class, 'logout'])->name('forgot_password');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::post('reset_password', [HomeController::class, 'change_password'])->name('reset_password');
        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

        Route::get('users', [UserController::class, 'user'])->name('admin.users');

        Route::get('/booking', [AdminPanelController::class, 'booking'])->name('admin.booking');

        Route::get('/carousel', [AdminPanelController::class, 'carousel'])->name('admin.carousel');

        Route::get('/articles', [AdminPanelController::class, 'blog'])->name('admin.blog');

        Route::get('/property', [AdminPanelController::class, 'property'])->name('admin.property');

        Route::get('/team', [AdminPanelController::class, 'team'])->name('admin.team');

        Route::get('/testimonial', [AdminPanelController::class, 'testimonial'])->name('admin.testimonial');

    });
});
