<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

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

    public function login(Request $request)
    {
        /*$this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
            $user->generateToken();

            return response()->json([
                'data' => $user->toArray(),
            ]);
        }

        return $this->sendFailedLoginResponse($request);*/
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user  || !Hash::check($request->password, $user->password)) {
            return ["email" => ["Credenciais Erradas"]];
        }

        $token = Str::random(40);
        $user->update(['api_token' => $token]);
        return ["token" => $token];
    }

    public function logout(Request $request)
    {
        $user = User::where('api_token', $request->header('Authorization'))->first();

        if (!$user) {
            return ["logout" => ["Utilizador não encontrado"]];
        }
        $user->update(["api_token" => null]);
        return 204;

        /*if ($user) {
            $user->api_token = null;
            $user->save();
        } else {
            return response()->json(['data' => 'User not found'], 404);
        }

        return response()->json(['data' => 'User logged out.'], 200);*/
    }
}
