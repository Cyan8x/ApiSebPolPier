<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImgProducto extends Model
{
    use HasFactory;

    protected $table = 'img_productos';

    protected $fillable = [
        'id_prod',
        'nombre',
        'formato'
    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }
}
