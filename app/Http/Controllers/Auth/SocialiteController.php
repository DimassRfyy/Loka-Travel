<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Socialite as ModelsSocialite;
use Illuminate\Support\Facades\Log;

class SocialiteController extends Controller
{
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
       }
    
       public function callback($provider) {
         try {
             $socialUser = Socialite::driver($provider)->user();
             $authUser = $this->store($socialUser, $provider);
             Auth::login($authUser);
             return redirect('/');
         } catch (\Exception $e) {
             Log::error('Socialite callback error: ' . $e->getMessage());
             return redirect('/login')->withErrors(['msg' => 'Login gagal, coba lagi.']);
         }
     }
     
    
       public function store($socialUser, $provider) {
        $socialAccount = ModelsSocialite::where('provider_id', $socialUser->id)->where('provider_name', $provider)->first();
    
        if (!$socialAccount) {
          $user = User::where('email', $socialUser->getEmail())->first();
    
          if(!$user) {
             $user = User::updateOrCreate([
                'name' => $socialUser->getName() ? $socialUser->getName() : $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make('socialite'),
                'avatar' => $socialUser->getAvatar(),
                'phonenumber' => '082130869378',
             ]);
          }
    
          $user->socialites()->create([
             'provider_id' => $socialUser->getId(),
             'provider_name' => $provider,
             'provider_token' => $socialUser->token,
             'provider_refresh_token' => $socialUser->refreshToken,
          ]);

          $user->assignRole('customer');
   
          return $user;
        }
    
        return $socialAccount->user;
       }
}
