<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'id_marc',
        'id_cate',
        'id_prov',
        'cod_origen',
        'imagenes',
        'url',
        'nombre',
        'stock',
        'precio'
    ];

    public function imagenesProducto()
    {
        return $this->hasMany('App\Models\ImgProducto');
    }
}
