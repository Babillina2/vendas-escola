<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'valor_total', 'status'];

    // Relacionamento com produtos (muitos-para-muitos)
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_venda')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    // Relacionamento com nomes das crianças (um-para-muitos)
    public function nomesCriancas()
    {
        return $this->hasMany(NomeCrianca::class);
    }
    public function comprador()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
