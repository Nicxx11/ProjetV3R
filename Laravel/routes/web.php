<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\ForgottenPasswordController;
use App\Http\Controllers\LicencesRBQController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EitherFournisseurOrEmployeMiddleware;
use App\Http\Middleware\EmployeMiddleware;
use App\Http\Middleware\FournisseurMiddleware;
use App\Http\Middleware\ResponsableMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ExportController;

// Route::fallback(function () {
//     return redirect()->to(url()->previous()); // go back to previous url if error in url/view/route
// });

Route::middleware([FournisseurMiddleware::class])->group(function() {
    Route::get('/Fournisseurs/Profile', [FournisseursController::class, 'index'])->name('fournisseurs.profile');
    Route::get('/Fournisseurs/Profile/Supprimer/{contactId}', [FournisseursController::class, 'destroyContact'])->name('profile.supprimer');
    Route::post('/Fournisseurs/Profile/Ajouter', [FournisseursController::class, 'ajoutContact'])->name('profile.ajouter');
    Route::get('/Fournisseurs/Profile/Modifier', [FournisseursController::class, 'edit'])->name('profile.modifier');
    Route::post('/Fournisseurs/Profile/Modifier', [FournisseursController::class, 'update'])->name('profile.edit');
    Route::get('/Fournisseurs/Profile/Delete/{id}', [FournisseursController::class, 'deleteFournisseur'])->name('profile.delete');
});

Route::middleware([EmployeMiddleware::class])->group(function() {
    Route::get('/Utilisateur/Fournisseurs/{id}', [FournisseursController::class, 'showFournisseurProfile'])->name('fournisseur.profileUser');
    Route::get('Utilisateur/Fournisseurs/Profile/Modifier/{id}', [FournisseursController::class, 'editId'])->name('fournisseur.editProfileUser');
    Route::post('Utilisateur/Fournisseurs/Profile/Modifier', [FournisseursController::class, 'update'])->name('fournisseur.updateProfileUser');
    Route::get('/Fournisseurs/Liste/Commis', [FournisseursController::class, 'index'])->name('fournisseurs.listcommis');
    Route::get('/export/{id}', [ExportController::class, 'export'])->name('fournisseur.export');
    Route::get('/export/{id}', [ExportController::class, 'export'])->name('fournisseur.export');
    Route::get('/Fournisseurs/Details/{ids}', [FournisseursController::class, 'detailsFournisseurs'])->name('fournisseurs.details');
});

Route::middleware([EitherFournisseurOrEmployeMiddleware::class])->group(function() {
    Route::post('/Finances/Update', [FournisseursController::class, 'updateFinances'])->name('finances.upload');
    Route::post('/RBQ/Add', [LicencesRBQController::class, 'addRBQ'])->name('rbq.add');
    Route::get('/RBQ/Delete/{id}', [LicencesRBQController::class, 'deleteRBQ'])->name('rbq.delete');
    Route::get('/Service/Add/{id}', [ServicesController::class, 'addService'])->name('service.add');
    Route::post('/Service/Store', [ServicesController::class, 'storeService'])->name('service.store');  
    Route::get('/Service/Delete/{id}', [ServicesController::class, 'deleteService'])->name('service.delete');
    Route::post('/Details/Update', [FournisseursController::class, 'updateDetails'])->name('details.update');
    Route::get('/fetch-services', [ServicesController::class, 'fetchServices'])->name('service.fetchServices');
});

Route::middleware([ResponsableMiddleware::class])->group(function() {
    Route::get('/Fournisseurs/Liste', [FournisseursController::class, 'index'])->name('fournisseurs.list');
    Route::post('/upload', [FileUploadController::class, 'upload'])->name('file.upload');
});

Route::middleware([AdminMiddleware::class])->group(function() {
    Route::get('/Admin/Utilisateurs', [UtilisateurController::class, 'listUtilisateurs'])->name('administrateur.utilisateurs');
    Route::post('/Admin/Utilisateurs', [UtilisateurController::class,'updateUtilisateurs'])->name('utilisateurs.updateRoles');
    Route::post('/Admin/Utilisateurs/Ajouter', [UtilisateurController::class,'store'])->name('utilisateurs.store');
    Route::post('/Admin/Utilisateurs/Supprimer/{id}', [UtilisateurController::class,'destroy'])->name('utilisateurs.destroy');
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

Route::get('Fournisseur/Logout',
[FournisseursController::class, 'logout'])->name('fournisseur.logout');

Route::get('/Utilisateur/Logout',
[UtilisateurController::class, 'logout'])->name('utilisateur.logout');