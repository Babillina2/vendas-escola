<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco'];

    public function nomesCriancas()
    {
        return $this->hasMany(NomeCrianca::class);
    }
    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'produto_venda')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }
}
