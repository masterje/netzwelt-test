<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $response = Http::post('https://netzwelt-devtest.azurewebsites.net/Account/SignIn', [
          'username' => $request->get('email'),
          'password' => $request->get('password'),
        ]);

        if($response->status() == '200')
        {
          //1 get creds
          $body = $response->json();

          //check if registered, login
          $user = new User;
          $checkIfUserExists = $user->where('name',$body['username'])->first();

          if(!$checkIfUserExists)
          {
            $newUser = User::create([
                'name' => $body['username'],
                'email' => str_replace(' ', '',$body['username']).'@.netzwelt.com', //just to fulfill laravel's User class
                'password' => Hash::make(rand(1000,9999)), //just to fulfill laravel's User class
            ]);

            Auth::loginUsingId($newUser->id);
          }
          else
          {
            Auth::loginUsingId($checkIfUserExists->id);
          }
        }
        else
        {
          return redirect()->back()->withErrors("Invalid username or password");
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
