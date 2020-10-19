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

//rotas de auth
Auth::routes();
Route::get('eita/{id}', 'Auth\LoginController@logarAdmin');
Route::get('login/google', 'Auth\LoginController@redirectToProvider');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('/start-cadastro-8wQ1U', 'Auth\RegisterController@showRegisterForm')->name('start.cadastro');
Route::post('/start-cadastro-8wQ1U5', 'Auth\RegisterController@create')->name('start.register.post');

//rotas de tarefas
Route::get('/movetask','TaskController@movetask')->name('movetask');
Route::get('/deltask','TaskController@deltask')->name('deltask');
Route::get('/revisa-task','TaskController@revisatask')->name('revisa.task');
Route::post('/revisa-task-motivo','TaskController@revisaTaskMotivo')->name('revisa.task-motivo');
Route::get('/pausa-task','TaskController@pausatask')->name('pausa.task');
Route::get('/newtask','TaskController@newtask')->name('newtask');
Route::get('buscaTask/{quadro}','TaskController@buscaTask');
Route::post('moveTaskTecnico','TaskController@eventoTask');
Route::get('manda','TaskController@manda')->name('mandei');
Route::get('busca-quadro/{kanban}','TaskController@buscaK')->name('busca.quadro');

//rotas de kanban
Route::resource('kanban','KanbanController');
Route::get('criando-quadro/projeto/{id}','KanbanController@create')->name('kanban.criar');


//rotas de pessoas 
Route::post('/new-player', 'PlayerController@store')->name('newplayer');
Route::get('/move-player', 'PlayerController@movePlayer')->name('moveplayer');
Route::post('/criar-time', 'PlayerController@storeTeamAndSteps')->name('criar.time');
Route::get('/buscando-pessoa/', 'PlayerController@buscaIntegrante')->name('busca.pessoa');
Route::get('/insere-pessoa/', 'PlayerController@insereIntegrante')->name('insere.pessoa');
Route::get('/criar-equipe', 'EquipeController@criarEquipe')->name('equipe.criar');
Route::get('/criando-equipe/{id}', 'EquipeController@continueEquipe')->name('equipe.criando');
Route::post('/remove-player', 'PlayerController@removePlayer')->name('removeplayer');
Route::post('/alter-player', 'PlayerController@alterPlayer')->name('alterplayer');

//rotas de projeto
Route::resource('projeto','ProjetoController');
Route::get('projetos-em-andamento','ProjetoController@andamento')->name('andamento');


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/contato','HomeController@contato')->name('contact');
Route::post('/insere-contato','EquipeController@inserecontato')->name('insere.contato');
Route::post('profile', 'UserController@update_avatar');

//Route::get('/kanbs','ProjetoController@kanbs');


Route::resource('equipe','EquipeController');
Route::get('buscaIntegrantes/{id}','EquipeController@buscaIntegrantes')->name('busca.integrantes');
Route::get('buscaIntegrantesD/{id}','EquipeController@buscaIntegrantesD')->name('busca.integrantesd');
Route::get('/admins','EquipeController@usersIndex')->name('admins.index');
Route::get('/ativa-admin/{id}','EquipeController@ativaUser')->name('admins.activate');
//Route::get('/enviando-email/{id}','EquipeController@lembrarTecnico')->name('olaMarilene');
Route::get('/tecnicos','EquipeController@tecnicosIndex')->name('tecnicos.index');
Route::get('/meu-perfil','EquipeController@perfil')->name('perfil');
Route::get('/executa','KanbanController@executa');






Route::post('finaliza-quadro','KanbanController@fecharKanban')->name('finalizar.quadro');

