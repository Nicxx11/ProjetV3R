<?php

use App\Http\Controllers\ForgottenPasswordController;
use App\Http\Controllers\MailController;
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
[FournisseursController::class, 'update'])->name(name: 'profile.edit');

Route::get('/Fournisseurs/Profile/Supprimer', 
[FournisseursController::class, 'destroyContact'])->name('profile.supprimer');

 Route::get('/Fournisseurs/Profile/Ajouter/', 
 [FournisseursController::class, 'ajoutContact'])->name('profile.ajouter');

 Route::post('/check-rbq', 
 [FournisseursController::class, 'checkRBQ']);

Route::get('/emailtest',
[MailController::class, 'sendFournisseurToFinancesEmail'])->name('email.test');

Route::get('/Password',
 function () {return view('auth.forgotten');})->name('password.forgotten');

Route::post('/Password',
[MailController::class, 'sendPasswordResetLink'])->name('token.send');

Route::get('/Password/Reset/{Token}',
[ForgottenPasswordController::class, 'index'])->name('token.input');

Route::post('/Password/Reset',
[ForgottenPasswordController::class, 'resetPassword'])->name('password.reset');