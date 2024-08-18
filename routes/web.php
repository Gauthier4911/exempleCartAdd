<?php

use Illuminate\Support\Facades\Route;


    Route::get('/cart', \App\Livewire\CartComponent::class)->name('cart.view');


    Route::get('/', [\App\Http\Controllers\HomeContronllers::class, 'index'])->name('app.home');
    Route::get('/product/create', [\App\Http\Controllers\HomeContronllers::class, 'create'])->name('products.create');
    Route::post('/product/store', [\App\Http\Controllers\HomeContronllers::class, 'store'])->name('product.store');
    Route::get('/cart', [\App\Http\Controllers\CartContronllers::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [\App\Http\Controllers\CartContronllers::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [\App\Http\Controllers\CartContronllers::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [\App\Http\Controllers\CartContronllers::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [\App\Http\Controllers\CartContronllers::class, 'checkout'])->name('checkout');
Route::fallback(function () {
    return redirect('/');
});

