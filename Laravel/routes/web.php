<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseursController;

 Route::get('/',
 [FournisseursController::class,'index'])->name('index.index');

 Route::get('/inscription',
 [FournisseursController::class,'create'])->name('inscription.create');

 Route::post('/inscription',
 [FournisseursController::class,'store'])->name('inscription.store');

 Route::get('/Fournisseurs/Liste', 
 [FournisseursController::class, 'index'])->name('fournisseurs.list');

 Route::post('/Connexion', 
 [FournisseursController::class, 'login'])->name('fournisseurs.login');

 Route::get('/Fournisseurs/Profile', 
 [FournisseursController::class, 'index'])->name('fournisseurs.profile');
 
 Route::get('/Fournisseurs/Profile/Modifier', 
 [FournisseursController::class, 'edit'])->name('profile.modifier');

 Route::post('/Fournisseurs/Profile/Modifier', 
 [FournisseursController::class, 'update'])->name('profile.edit');

 Route::post('/check-rbq', 
 [FournisseursController::class, 'checkRBQ']);

