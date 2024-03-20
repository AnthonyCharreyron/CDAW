<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\JouerController;
use App\Http\Controllers\ConnexionController;
use App\Http\Middleware\AuthMiddleware;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/presentation', [PresentationController::class, 'getPresentation'])->name('presentation');
Route::get('/historique', [HistoriqueController::class, 'getClassement']);
Route::get('/jouer', [JouerController::class, 'getPartie'])->middleware(AuthMiddleware::class);

Route::get('/connexion', [ConnexionController::class, 'getConnexion'])->name('connexion');
Route::get('/email/verify', function () {return view('verify-email');})->middleware(AuthMiddleware::class)->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/presentation');
})->middleware([AuthMiddleware::class, 'signed'])->name('verification.verify');

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/authenticate', [ConnexionController::class, 'authenticate'])->name('connexion.authenticate');
Route::post('/logout', [ConnexionController::class, 'logout'])->name('connexion.logout');