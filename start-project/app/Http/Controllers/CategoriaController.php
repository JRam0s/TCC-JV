<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $data = Categoria::orderBy('id')->get();
        return view('categoria.index', compact('data'));
    }

    public function create()
    {
        return view('categoria.create');
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

        $reg = new Categoria();
        $reg->nome = $request->nome;
        $reg->descricao = $request->descricao;
        $reg->save();  
        
        return redirect()->route('categoria.index');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $dados = Categoria::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('categoria.edit', compact('dados'));
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

        $reg = Categoria::find($id);

        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->save();
        }

        return redirect()->route('categoria.index');
    }

    public function destroy($id)
    {
        $reg = Categoria::find($id);
        $reg->delete();
        return redirect()->route('categoria.index');
    }
}
