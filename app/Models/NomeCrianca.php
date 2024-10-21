<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NomeCrianca extends Model
{
    protected $fillable = ['venda_id', 'nome_crianca', 'produto_id', 'quantidade'];

    // Relacionamento com venda
    public function venda()
    {
        return $this->belongsTo(Venda::class);
    }

    // Relacionamento com produto (cada criança tem um produto)
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
