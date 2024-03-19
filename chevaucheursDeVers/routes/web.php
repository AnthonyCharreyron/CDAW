<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\JouerController;
use App\Http\Controllers\ConnexionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/presentation', [PresentationController::class, 'getPresentation'])->name('accueil');
Route::get('/historique', [HistoriqueController::class, 'getClassement']);
Route::get('/jouer', [JouerController::class, 'getPartie']);
Route::get('/connexion', [ConnexionController::class, 'getConnexion']);

Route::post('/authenticate', [ConnexionController::class, 'authenticate'])->name('connexion.authenticate');