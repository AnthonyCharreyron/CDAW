<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\JouerController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonProfilController;
use App\Http\Middleware\AuthMiddleware;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/presentation', [PresentationController::class, 'getPresentation'])->name('presentation');
Route::get('/monProfil', [MonProfilController::class, 'getProfil']);

Route::get('/historique', [HistoriqueController::class, 'getClassement']);
Route::get('/historique/{id}', [HistoriqueController::class, 'statClassement'])->name('stats');

Route::get('/jouer', [JouerController::class, 'getPartie'])->middleware(AuthMiddleware::class);
Route::get('/jouer/parties', [JouerController::class, 'getInfoParties'])->middleware(AuthMiddleware::class);
Route::get('/jouer/lobby/{code_partie}', [JouerController::class, 'getLobby'])->middleware(AuthMiddleware::class);
Route::get('/jouer/partie/{code_partie}', [JouerController::class, 'getPartieJouee'])->middleware(AuthMiddleware::class);

Route::post('/jouer/creer', [JouerController::class, 'createPartie'])->middleware(AuthMiddleware::class);
Route::post('/jouer/rejoindre', [JouerController::class, 'rejoindrePartie'])->middleware(AuthMiddleware::class);


Route::get('/connexion', [ConnexionController::class, 'getConnexion'])->name('connexion');
Route::post('/connexion/creerUser', [UserController::class, 'createUser'])->name('inscription');
Route::get('/email/verify', function () {return view('verify-email');})->middleware(AuthMiddleware::class)->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/presentation');
})->middleware([AuthMiddleware::class, 'signed'])->name('verification.verify');



Route::post('/authenticate', [ConnexionController::class, 'authenticate'])->name('connexion.authenticate');
Route::post('/logout', [ConnexionController::class, 'logout'])->name('connexion.logout');
Route::post('/message', [MessageController::class, 'sendMessage'])->name('message.send');