<?php

namespace App\Http\Controllers;

use App\Models\Ganho;
use App\Models\Categoria;
use Illuminate\Http\Request;

class GanhoController extends Controller
{
    public function index()
    {
        $data = Ganho::orderBy('id')->get();
        return view('ganho.index', compact('data'));
    }

    public function create()
    {
        $data = Categoria::orderBy('nome')->get();
        return view('ganho.create', compact('data'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $regras = [
            'nome' => 'required|max:100|min:5',
            'valor' => 'required',
            'fixo' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        $reg = new Ganho();
        $reg->nome = $request->nome;
        $reg->valor = $request->valor;
        $reg->fixo = $request->fixo;
        $reg->categoria_id = $request->categoria;
        $reg->save();  
        
        return redirect()->route('ganho.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Ganho::find($id);
        $data = Categoria::orderBy('nome')->get();

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('ganho.edit', compact('dados'), compact('data'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'valor' => 'required',
            'fixo' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($regras, $msgs);

        $reg = Ganho::find($id);

        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->valor = $request->valor;
            $reg->fixo = $request->fixo;
            $reg->categoria_id = $request->categoria;
            $reg->save();
        }

        return redirect()->route('ganho.index');
    }

    public function destroy($id)
    {
        $reg = Ganho::find($id);
        $reg->delete();
        return redirect()->route('ganho.index');
    }
}
