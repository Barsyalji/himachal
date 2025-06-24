<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
            'first_name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'last_name' =>  '',
            'username' => $googleUser->getEmail(),
            'password' =>Hash::make($googleUser->getEmail()), // Generate a random password
            ]
        );

        $user->media()->updateOrCreate(
            ['type' => 'avatar'],
            [
                'path' => $googleUser->getAvatar(),
                'file_name' => basename($googleUser->getAvatar()),
                'source' => 'url',
                'type' => 'avatar',
                'resource_type' => get_class($user),
                'resource_id' => $user->id,
            ]
        );
        Auth::login($user);
        return redirect('/');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $fbUser = Socialite::driver('facebook')->user();
        $user = User::updateOrCreate(
            ['email' => $fbUser->getEmail()],
            ['name' => $fbUser->getName()]
        );
        Auth::login($user);
        return redirect('/');
    }
}
