<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/presentation', 'PresentationController@getPresentation');
Route::get('/historique', 'HistoriqueController@getClassement');
Route::get('/jouer', 'JouerController@getPartie');
Route::get('/connexion', 'ConnexionController@getConnexion');