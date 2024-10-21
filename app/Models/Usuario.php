<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'password'];

    // Definir que a senha não deve ser exibida diretamente
    protected $hidden = ['password'];
}
