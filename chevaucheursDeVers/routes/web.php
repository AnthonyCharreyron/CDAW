<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test', function () {
//     return view('welcome');
// });
Route::get('/', function(){
    echo 'Hello World!';
    //return 'Hello World!";
});
Route::get('/hello/{nom}/{prenom}', function($nom, $prenom){
    return "Hello $nom et $prenom !";
});
Route::get('article/{title}', function ($title) {
    return "Title : $title";
})->where('title', '[A-Za-z]+');
Route::get('/liste-joueurs', function () {
    return "Liste des joueurs";
})->name('listeJoueurs');


