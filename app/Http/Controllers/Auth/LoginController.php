<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Services\SocialGoogleAccountService;
use Auth;
use App\User;
use Session;
use App\Events\EstadoUser;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
     public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->stateless()->user());
        if(!$user){
            return redirect()->route('login')->withErrors('Email de Login deve pertencer a Empresa !');
        }
        auth()->login($user);

        
            broadcast(new EstadoUser($user))->toOthers();
            return redirect()->route('projeto.index');   
        
        
    }

    public function LogarAdmin($id){
        $user = User::find($id);
        auth()->login($user);
        broadcast(new EstadoUser($user))->toOthers();
        return redirect()->route('projeto.index');    
    }
}
