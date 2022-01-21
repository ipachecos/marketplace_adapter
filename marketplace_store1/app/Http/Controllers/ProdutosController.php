<?php

namespace App\Http\Controllers;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProdutosController extends BaseController
{
    public function __construct()
    {
        $this->class = Produto::class;
    }

    public function index()
    {
        return $this->class::all();
    }

    public function store(Request $request)
    {
        $serie = $this->class::create([
            'nome' => $request->nome,
            'preco' => $request->preco,
            'descricao' => $request->descricao,
            'nota' => $request->nota,
            'qtd_estoque'=> $request->qtd_estoque,
        ]);

        return response()->json($serie, 201);
    }
}
