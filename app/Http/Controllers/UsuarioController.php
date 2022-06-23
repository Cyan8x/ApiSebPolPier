<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\GetUsuarioRequest;
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

    public function usuario(GetUsuarioRequest $request)
    {
        try {
            // $usuario = DB::select('call pr_get_usuario(?,?)');

            $password = Crypt::encrypt($request->password);

            $usuario = DB::select('call pr_get_usuario(?,?)',[
                $request->email,
                $password
            ]);


            return response()->json([
                'res' => true,
                'Usuario' => $usuario
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'res' => false,
                'error' => $e
            ], 500);
        }
    }
}
