<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function index()
    {
        $data = Pagamento::orderBy('nome')->get();
        return view('pagamento.index', compact('data'));
    }

    public function create()
    {
        return view('pagamento.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'descricao' => 'required|max:1000|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $reg = new Pagamento();
        $reg->nome = $request->nome;
        $reg->descricao = $request->descricao;
        $reg->save();
        
        return redirect()->route('pagamento.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Pagamento::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('pagamento.edit', compact('dados'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'descricao' => 'required|max:1000|min:10',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($regras, $msgs);

        $reg = Pagamento::find($id);

        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->save();
        }

        return redirect()->route('pagamento.index');
    }

    public function destroy($id)
    {
        $reg = Pagamento::find($id);
        $reg->delete();
        return redirect()->route('pagamento.index');
    }
}
