<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(UsuarioController::class)->group(function () {
    Route::get('listarUsuarios', 'listarUsuarios');
    Route::post('usuario', 'usuario');
});
