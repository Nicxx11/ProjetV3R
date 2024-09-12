<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseursController;

// Route::get('/', function () {
//     return view('index');
// });

 Route::get('/',
 [FournisseursController::class,'index'])->name('login.index');