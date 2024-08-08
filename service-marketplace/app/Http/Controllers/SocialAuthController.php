<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::firstOrCreate([
            'email' => $socialUser->getEmail(),
        ], [
            'name' => $socialUser->getName(),
            'password' => Hash::make(Str::random(24)), // Random password for social logins
        ]);

        $user->socialAccounts()->firstOrCreate([
            'provider' => $provider,
            'provider_user_id' => $socialUser->getId(),
        ]);

        Auth::login($user, true);

        return redirect()->route('home');
    }
}
