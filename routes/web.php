<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProducttController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\ProdukController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('categories', [kategoriController::class, 'index'])->name('categories.index');
Route::get('categories/create', [kategoriController::class, 'create'])->name('categories.create');
Route::post('categories', [kategoriController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [kategoriController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [kategoriController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [kategoriController::class, 'destroy'])->name('categories.destroy');


Route::get('products', [ProdukController::class, 'index'])->name('products.index');
Route::get('products/create', [ProdukController::class, 'create'])->name('products.create');
Route::post('products', [ProdukController::class, 'store'])->name('products.store');
Route::get('products/{product}/edit', [ProdukController::class, 'edit'])->name('products.edit');
Route::put('products/{product}', [ProdukController::class, 'update'])->name('products.update');
Route::delete('products/{product}', [ProdukController::class, 'destroy'])->name('products.destroy');
Route::get('products/{product}', [ProdukController::class, 'show'])->name('products.show');