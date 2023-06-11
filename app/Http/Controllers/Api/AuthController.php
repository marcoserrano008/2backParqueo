<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use App\Models\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(SignupRequest $request)
    {
        date_default_timezone_set('America/Manaus');
        $data = $request->validated();
        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'ci' => $data['ci'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'celular' => $data['celular']
        ]);

        $token = $user->createToken('main')->plainTextToken;
        $cliente = new Cliente;
        $cliente->id_cliente = $data['ci'];
        $cliente->id_usuario = auth()->user()->id;;
        $cliente->save();

        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user', 'token'));
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if(!Auth::attempt($credentials)){
            return response([
                'message' => 'El correo o contraseña ingresado es incorrecto',
            ], 422);
        }
        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user', 'token'));
    }

    public function logout(Request $request){
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response('', 204);
    }

    public function getRol(){
        $user = Auth::user();
        $rol = $user->rol;
        return ['rol' => $rol];
    }
    
    public function clientes(){
        $clientes = Cliente::all();
        return $clientes;
    }

    public function usuarios(){
        $usuarios = User::all();
        return $usuarios;
    }
}
