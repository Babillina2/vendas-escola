<?php
// app/Http/Controllers/TipoPagamentoController.php
namespace App\Http\Controllers;

use App\Models\TipoPagamento;
use Illuminate\Http\Request;

class TipoPagamentoController extends Controller
{
    // Exemplo de método que lida com o pagamento
    public function processarPagamento(Request $request)
    {
        $tipoPagamento = $request->tipo_pagamento; // 'pix' ou 'cartao_credito'
        $valorTotal = $request->valor_total; // O valor original da compra

        if ($tipoPagamento == 'pix') {
            // Conceder um desconto de 5% para pagamento via PIX
            $desconto = 0.05 * $valorTotal;
            $valorFinal = $valorTotal - $desconto;

            return response()->json([
                'tipo_pagamento' => 'pix',
                'valor_original' => $valorTotal,
                'desconto' => $desconto,
                'valor_final' => $valorFinal,
            ]);
        }

        if ($tipoPagamento == 'cartao_credito') {
            // Calcular o valor da parcela em até 12x
            $parcelas = [];
            for ($i = 1; $i <= 12; $i++) {
                $parcelas[$i] = $valorTotal / $i;
            }

            return response()->json([
                'tipo_pagamento' => 'cartao_credito',
                'valor_original' => $valorTotal,
                'parcelas' => $parcelas,
            ]);
        }

        return response()->json([
            'error' => 'Tipo de pagamento inválido',
        ], 400);
    }
}
