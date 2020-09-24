<?php
namespace App\Services;
use App\GoogleAuth;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
class SocialGoogleAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = GoogleAuth::whereProvider('google')
            ->whereProviderUserId($providerUser->getId())
            ->first();
if ($account) {
            return $account->user;
        } else {

            if(strstr(ltrim($providerUser->getEmail()), '@jangadeiro') || strstr(ltrim($providerUser->getEmail()), '@jornaljangadeiro') || strstr(ltrim($providerUser->getEmail()), '@futeboles') || strstr(ltrim($providerUser->getEmail()), '@todomundoama')){

            }else{
                return null;
            }



$account = new GoogleAuth([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'google'
            ]);
$user = User::whereEmail($providerUser->getEmail())->first();
if (!$user) {
    
        $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'nome' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'is_admin' => 0,
                    'avatar' => $providerUser->getAvatar(),
                    'matricula' => 'DEFINIR',
                    'setor' => 'DEFINIR',
                    'vertical' => 'DEFINIR',
                    'filial' => 'DEFINIR',
                    'status' => 'INATIVO'

                ]);
            } else {
                if ($user->status == 'ATIVO') {
                    $user->password = md5(rand(1,10000));
                    $user->avatar = $providerUser->getAvatar();
                    $user->save();
                }
            }
    
$account->user()->associate($user);
            $account->save();
return $user;
        }
    }
}