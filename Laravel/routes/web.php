<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ForgottenPasswordController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EmployeMiddleware;
use App\Http\Middleware\FournisseurMiddleware;
use App\Http\Middleware\ResponsableMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ExportController;

// Route::fallback(function () {
//     return redirect()->route('index.index'); // replace 'home' with your desired route name
// });

Route::middleware([FournisseurMiddleware::class])->group(function() {
    Route::get('/Fournisseurs/Profile', [FournisseursController::class, 'index'])->name('fournisseurs.profile');
    Route::get('/Fournisseurs/Profile/Supprimer/{contactId}', [FournisseursController::class, 'destroyContact'])->name('profile.supprimer');
    Route::post('/Fournisseurs/Profile/Ajouter', [FournisseursController::class, 'ajoutContact'])->name('profile.ajouter');
    Route::get('/Fournisseurs/Profile/Modifier', [FournisseursController::class, 'edit'])->name('profile.modifier');
    Route::post('/Fournisseurs/Profile/Modifier', [FournisseursController::class, 'update'])->name(name: 'profile.edit');
});

Route::middleware([EmployeMiddleware::class])->group(function() {
    Route::get('/Fournisseurs/Liste/Commis', [FournisseursController::class, 'index'])->name('fournisseurs.listcommis');
    Route::get('/export/{id}', [ExportController::class, 'export'])->name('fournisseur.export');
    Route::get('/export/{id}', [ExportController::class, 'export'])->name('fournisseur.export');
});

Route::middleware([ResponsableMiddleware::class])->group(function() {
    Route::get('/Fournisseurs/Liste', [FournisseursController::class, 'index'])->name('fournisseurs.list');
});

Route::middleware([AdminMiddleware::class])->group(function() {
    //
});

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

Route::post('/Connexion', 
[FournisseursController::class, 'login'])->name('fournisseurs.login');

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

Route::get('Fournisseur/Logout',
[FournisseursController::class, 'logout'])->name('fournisseur.logout');