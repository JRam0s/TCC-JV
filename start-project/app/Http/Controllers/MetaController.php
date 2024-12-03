<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    private $path = "fotos/metas";
    public function index()
    {
        $data = Meta::orderBy('id')->get();
        return view('meta.index', compact('data'));
    }

    public function create()
    {
        return view('meta.create');
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'descricao' => 'required|max:1000|min:10',
            'alcancado' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo [:attribute] é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];

        $request->validate($regras, $msgs);

        if($request->hasFile('foto')) {

            $reg = new Meta();
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->alcancado = $request->alcancado; 

            // Upload da Foto
            $id = $reg->id;
            $extensao_arq = $request->file('foto')->getClientOriginalExtension();
            $nome_arq = $id.'_'.time().'.'.$extensao_arq;
            $request->file('foto')->storeAs("public/$this->path", $nome_arq);
            $reg->foto = $this->path."/".$nome_arq;
            $reg->save();
        }
        
        return redirect()->route('meta.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dados = Meta::find($id);

        if(!isset($dados)) { return "<h1>ID: $id não encontrado!</h1>"; }

        return view('meta.edit', compact('dados'));
    }

    public function update(Request $request, $id)
    {
        $regras = [
            'nome' => 'required|max:100|min:5',
            'descricao' => 'required|max:1000|min:20',
            'alcancado' => 'required',
        ];

        $msgs = [
            "required" => "O preenchimento do campo é obrigatório!",
            "max" => "O campo [:attribute] possui tamanho máximo de [:max] caracteres!",
            "min" => "O campo [:attribute] possui tamanho mínimo de [:min] caracteres!",
        ];
        $request->validate($regras, $msgs);

        $reg = Meta::find($id);

        if(isset($reg)) {
            $reg->nome = $request->nome;
            $reg->descricao = $request->descricao;
            $reg->alcancado = $request->alcancado;
            $reg->save();
        }

        return redirect()->route('meta.index');
    }

    public function destroy($id)
    {
        $reg = Meta::find($id);
        $reg->delete();
        return redirect()->route('meta.index');
    }
}