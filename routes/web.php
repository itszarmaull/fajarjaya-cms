<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContactController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/produk', [FrontendController::class, 'products'])->name('products');
Route::get('/produk/{slug}', [FrontendController::class, 'productDetail'])->name('product.detail');
Route::get('/proyek', [FrontendController::class, 'projects'])->name('projects');
Route::get('/proyek/{slug}', [FrontendController::class, 'projectDetail'])->name('project.detail');
Route::get('/tentang', [FrontendController::class, 'about'])->name('about');
Route::get('/kontak', [FrontendController::class, 'contact'])->name('contact');
Route::get('/kalkulator', [FrontendController::class, 'calculator'])->name('calculator');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::post('/kontak', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');
