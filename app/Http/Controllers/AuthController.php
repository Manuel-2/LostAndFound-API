<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    public function webLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::query()->where('email', $credentials['email'])->first();

        if ($user != null && $user->hasRole("admin") == false) {
            return back()->with(['error' => "Credenciales Incorrectas o no eres admin"]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }


        return back()->with(['error' => "Credenciales Incorrectas o no eres admin"]);
    }

    public function recoverPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['message' => "Enlace de recuperacion de contraseña enviado al correo"]);
        } else {
            return back()->with(['message' => "Enlace de recuperacion de contraseña enviado al correo"]);
        }
    }

    public function updatePassword(Request $request)
    {

        if ($request->password != $request->password_confirmation) {
            return back()->with(['message' => "Contraseñas no coinciden"]);
        };


        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );


        if ($status === Password::PASSWORD_RESET) {
            return back()->with(['message' => "Contraseña actualizada"]);
        } else {
            return back()->with(['message' => "Fallo"]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->tokens()->delete();
            return $user->createToken($user->name)->plainTextToken;
        } else {
            return response()->json([
                'message' => "Credenciales Incorrectas."
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => "Sesión cerrada correctamente."
        ]);
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:4'],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['required', 'integer', 'min:10'],
            'password' => ['required', 'min:6'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => "Usuario creado con existo",
            'data' => $user,
        ]);
    }
    //
}
