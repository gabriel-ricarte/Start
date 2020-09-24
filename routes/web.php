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

Route::get('/', function () {
    return view('bemvindo');
})->name('inicio');

Auth::routes();
Route::get('eita/{id}', 'Auth\LoginController@logarAdmin');
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/contato','HomeController@contato')->name('contact');
Route::get('/start-cadastro-8wQ1U', 'Auth\RegisterController@showRegisterForm')->name('start.cadastro');
Route::post('/start-cadastro-8wQ1U5', 'Auth\RegisterController@create')->name('start.register.post');
Route::get('/new-player', 'PlayerController@newPlayer')->name('newplayer');
Route::get('/move-player', 'PlayerController@movePlayer')->name('moveplayer');
Route::post('/criar-time', 'PlayerController@storeTeamAndSteps')->name('criar.time');
Route::get('/criar-equipe', 'EquipeController@criarEquipe')->name('equipe.criar');
Route::get('/criando-equipe/{id}', 'EquipeController@continueEquipe')->name('equipe.criando');
Route::get('/buscando-pessoa/', 'PlayerController@buscaIntegrante')->name('busca.pessoa');
//Route::get('/kanbs','ProjetoController@kanbs');
Route::resource('projeto','ProjetoController');
Route::resource('kanban','KanbanController');
Route::resource('equipe','EquipeController');
Route::get('/movetask','TaskController@movetask')->name('movetask');
Route::get('/deltask','TaskController@deltask')->name('amarelolixo');
Route::get('/newtask','TaskController@newtask')->name('newtask');
Route::get('/admins','EquipeController@usersIndex')->name('admins.index');
Route::get('/ativa-admin/{id}','EquipeController@ativaUser')->name('admins.activate');
Route::get('/enviando-email/{id}','EquipeController@lembrarTecnico')->name('olaMarilene');
Route::get('/tecnicos','EquipeController@tecnicosIndex')->name('tecnicos.index');
Route::get('/meu-perfil','EquipeController@perfil')->name('perfil');

Route::post('/remove-player', 'PlayerController@removePlayer')->name('removeplayer');
Route::post('/alter-player', 'PlayerController@alterPlayer')->name('alterplayer');

Route::get('buscaTask/{quadro}','TaskController@buscaTask');
Route::post('moveTaskTecnico','TaskController@eventoTask');
Route::get('manda','TaskController@manda')->name('mandei');
Route::get('projetos-em-andamento','ProjetoController@andamento')->name('andamento');
Route::get('criando-quadro/projeto/{id}','KanbanController@create')->name('kanban.criar');

