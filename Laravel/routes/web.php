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
