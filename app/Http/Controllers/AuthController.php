<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('registro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'clave_institucional' => 'required|unique:usuarios',
            'password' => 'required|min:4',
            'rol' => 'required'
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'clave_institucional' => $request->clave_institucional,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'activo' => true
        ]);



        return redirect('/');
    }

    public function login(Request $request)
    {
        $usuario = Usuario::where('clave_institucional', $request->clave_institucional)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return back()->with('error', 'Credenciales incorrectas');
        }

        session([
            'usuario_id' => $usuario->id,
            'usuario_nombre' => $usuario->nombre,
            'usuario_rol' => $usuario->rol
        ]);

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }
}
