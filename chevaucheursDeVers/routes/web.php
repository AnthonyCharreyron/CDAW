<?php

use Illuminate\Support\Facades\Route;
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
Route::get('/chat', function () {
    return view('chat');
});

Route::post('/authenticate', [ConnexionController::class, 'authenticate'])->name('connexion.authenticate');
Route::post('/logout', [ConnexionController::class, 'logout'])->name('connexion.logout');