<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ForgottenPasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UtilisateurController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ExportController;

Route::get('/',
[FournisseursController::class,'index'])->name('index.index');

Route::get('/UtilisateursLogin',
[UtilisateurController::class, 'index'])->name('utilisateurs.showLogin');

Route::post('UtilisateursLogin',
[UtilisateurController::class, 'login'])->name('utilisateurs.login');

Route::get('/inscription',
[FournisseursController::class,'create'])->name('inscription.create');

Route::post('/inscription',
[FournisseursController::class,'store'])->name('inscription.store');

Route::get('/Fournisseurs/Liste', 
[FournisseursController::class, 'index'])->name('fournisseurs.list')->middleware('employe');

Route::post('/Connexion', 
[FournisseursController::class, 'login'])->name('fournisseurs.login');

Route::get('/Fournisseurs/Profile', 
[FournisseursController::class, 'index'])->name('fournisseurs.profile')->middleware('fournisseur');
 
Route::get('/Fournisseurs/Profile/Modifier', 
[FournisseursController::class, 'edit'])->name('profile.modifier')->middleware('fournisseur');

Route::post('/Fournisseurs/Profile/Modifier', 
[FournisseursController::class, 'update'])->name(name: 'profile.edit')->middleware('fournisseur');

Route::get('/Fournisseurs/Profile/Supprimer/{contactId}', 
[FournisseursController::class, 'destroyContact'])->name('profile.supprimer')->middleware('fournisseur');

 Route::post('/Fournisseurs/Profile/Ajouter', 
 [FournisseursController::class, 'ajoutContact'])->name('profile.ajouter')->middleware('fournisseur');

 Route::post('/check-rbq', 
 [FournisseursController::class, 'checkRBQ']);

Route::get('/Password',
 function () {return view('auth.forgotten');})->name('password.forgotten');

Route::post('/Password',
[MailController::class, 'sendPasswordResetLink'])->name('token.send');

Route::get('/Password/Reset/{Token}',
[ForgottenPasswordController::class, 'index'])->name('token.input');

Route::post('/Password/Reset',
[ForgottenPasswordController::class, 'resetPassword'])->name('password.reset');

Route::get('/files', 
[FileUploadController::class, 'showFiles'])->name('files.index');

Route::post('/upload', 
[FileUploadController::class, 'upload'])->name('file.upload');

Route::get('/export/{id}',
[ExportController::class, 'export'])->name('fournisseur.export')->middleware('employe');

Route::get('Fournisseur/Logout',
[FournisseursController::class, 'logout'])->name('fournisseur.logout');