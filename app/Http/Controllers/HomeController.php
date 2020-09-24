<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function contato(Request $request){
        $user = User::find(1);
        $user->notify(new Contato($request->nome,$request->telefone,$request->texto));
        session()->flash('msg','Agradecemos seu contato, em breve retornaremos com uma resposta !');
        return redirect()->route('inicio');

    }
}
