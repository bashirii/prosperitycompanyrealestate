<?php

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
