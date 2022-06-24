<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\LoginUsuarioRequest;
use App\Http\Requests\Usuario\InsertarUsuarioRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function listarUsuarios()
    {
        try {
            $usuarios = DB::select('call pr_listar_usuarios');
            return response()->json([
                'res' => true,
                'Usuarios' => $usuarios
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'res' => false,
                'error' => $e
            ], 500);
        }
    }

    public function insertarUsuario(InsertarUsuarioRequest $request)
    {
        try {
            $passwordEncript = password_hash($request->password, PASSWORD_DEFAULT, [14]);
            DB::statement('call pr_insertar_usuario(?,?,?,?)', [
                $request->nombres,
                $request->apellidos,
                $request->email,
                $passwordEncript
            ]);
            return response()->json([
                'res' => true,
                'response' => "Usuario correctamente insertado."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'res' => false,
                'error' => $e
            ], 500);
        }

        // return response()->json([
        //     'res' => true,
        //     'response' => "Usuario correctamente insertado."
        // ], 200);
    }

    public function validateUsuario(LoginUsuarioRequest $request)
    {
        try {
            $usuario = DB::select('call pr_login_usuario(?)', [
                $request->email,
            ]);

            $json = json_decode(str_replace(array("[", "]"), '', json_encode($usuario)));

            if ($json == null) {
                return response()->json([
                    'res' => false,
                    'error' => "Email Invalido"
                ], 500);
            }

            $passwordEncript = "";

            foreach ($json as $key => $value) {
                if ($key == 'Password') {
                    $passwordEncript = $value;
                }
            }

            if (password_verify($request->password, $passwordEncript)) {
                return response()->json([
                    'res' => true,
                    'response' => "Contraseña Valida"
                ], 200);
            }else{
                return response()->json([
                    'res' => false,
                    'error' => "Contraseña Invalida"
                ], 500);
            }

        } catch (Exception $e) {
            return response()->json([
                'res' => false,
                'error' => $e
            ], 500);
        }
    }
}
