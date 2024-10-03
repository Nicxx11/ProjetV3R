<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseursController;

// Route::get('/', function () {
//     return view('index');
// });

 Route::get('/',
 [FournisseursController::class,'index'])->name('index.index');

 Route::get('/inscription',
 [FournisseursController::class,'create'])->name('inscription.create');

 Route::post('/inscription',
 [FournisseursController::class,'store'])->name('inscription.store');

 Route::get('/Fournisseurs/Liste', 
 [FournisseursController::class, 'index'])->name('fournisseurs.list');

 Route::post('/Fournisseurs/Liste', 
 [FournisseursController::class, 'login'])->name('fournisseurs.list');
