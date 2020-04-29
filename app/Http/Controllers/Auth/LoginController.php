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
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->toArray(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['erro' => "ERROU de novo"], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->input('password'), $user->password)) {
            $user->generateToken();
            return $user;
        } else {
            return response()->json(['erro' => "utilizador não encontrado"], 400);
        }
        /*$data->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
        ]);

        $user = User::where("email", $data->email)->first();

        if (!$user  || !Hash::check($data->password, $user->password)) {
            return ["email" => ["Credenciais Erradas"]];
        }

        $token = Str::random(40);
        $user->update(['api_token' => $token]);
        return ["token" => $token];*/
    }

    public function logout(Request $request)
    {
        $user = User::where('api_token', $request->header('Authorization'))->first();

        /*if (!$user) {
            return ["logout" => ["Utilizador não encontrado"]];
        }
        $user->update(["api_token" => null]);
        return 204;*/

        if ($user) {
            $user->api_token = null;
            $user->save();
        } else {
            return response()->json(['data' => 'User not found'], 404);
        }

        return response()->json(['data' => 'User logged out.'], 200);
    }
}
