<?php

namespace App\Http\Controllers\pdf;

use App\Http\Controllers\Controller;
use App\Venda;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfVendaController extends Controller
{
    public function factura()
    {
        session()->forget('carrinho');
        $venda = Venda::all()->last();
        $dados = array();
        $dados[0] = $venda->total_compra;

        foreach ($venda->produtos as $produto) {
            $quantidade = DB::table('produto_venda')->select('quantidade')->where([
                'produto_id' => $produto->id,
                'venda_id' => $venda->id,
            ])->get()[0]->quantidade;
            array_push($dados, [
                'produto' => $produto->descricao,
                'preco' => $produto->preco_venda,
                'quantidade' => $quantidade,
                'valor' => $quantidade * $produto->preco_venda,
            ]);
        }

        $pdf = PDF::loadView('pdf.factura', ['dados' => $dados])->setPaper('a4', 'portrait');
        return $pdf->stream('factura.pdf', ['Atachment' => true]);
    }
}
