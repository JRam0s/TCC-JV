@extends('template.main', ['menu' => "admin", 'submenu' => "Novo Gasto"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<form action="{{ route('gasto.store') }}" method="POST" enctype="multipart/form-data">
    @csrf  
    <div class="row">
        <div class="col" >
            <div class="form-floating mb-3">
                <input 
                    type="text" 
                    class="form-control @if($errors->has('nome')) is-invalid @endif" 
                    name="nome" 
                    placeholder="Nome"
                    value="{{old('nome')}}"
                />
                <label for="nome">Nome</label>
                @if($errors->has('nome'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('nome') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <textarea
                    type="number"
                    class="form-control @if($errors->has('valor')) is-invalid @endif"
                    name="valor"
                    placeholder="Valor"
                    style="min-height: 100px"
                >{{old('valor')}}</textarea>
                <label for="valor">Valor</label>
                @if($errors->has('valor'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('valor') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                FIXO
                <div class="form-check">
                    <input class="form-check-input @if($errors->has('fixo')) is-invalid @endif" type="radio" name="fixo"
                        id="fixo" value="1" {{ old('fixo') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="fixo">
                        SIM
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @if($errors->has('fixo')) is-invalid @endif" type="radio" name="fixo"
                        id="fixo" value="0" {{ old('fixo') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="fixo">
                        NÃO
                    </label>
                </div>
                @if($errors->has('fixo'))
                <div class='invalid-feedback'>
                    {{ $errors->first('fixo') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-floating mb-3">
                <input 
                    type="date" 
                    class="form-control @if($errors->has('dt_vencimento')) is-invalid @endif" 
                    name="dt_vencimento" 
                    placeholder="Data"
                    value="{{old('dt_vencimento')}}" 
                />
                <label for="dt_vencimento">Data de Vencimento</label>
                @if($errors->has('dt_vencimento'))
                    <div class='invalid-feedback'>
                        {{ $errors->first('dt_vencimento') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text bg-success text-white">Categoria</span>
                <select name="categoria" class="form-select"
                    class="form-control @if($errors->has('categoria')) is-invalid @endif">
                    @foreach ($data as $item)
                    <option value="{{$item->id}}" @if($item->id == old('categoria')) selected="true" @endif>
                        {{ $item->nome }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('categoria'))
                <div class='invalid-feedback'>
                    {{ $errors->first('categoria') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text bg-success text-white">Forma de Pagamento</span>
                <select name="pagamento" class="form-select"
                    class="form-control @if($errors->has('pagamento')) is-invalid @endif">
                    @foreach ($dota as $item)
                    <option value="{{$item->id}}" @if($item->id == old('pagamento')) selected="true" @endif>
                        {{ $item->nome }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('pagamento'))
                <div class='invalid-feedback'>
                    {{ $errors->first('pagamento') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{route('gasto.index')}}" class="btn btn-light btn-block align-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z"/>
                </svg>
                &nbsp; Voltar
            </a>
            <button type="submit" class="btn btn-light btn-block align-content-center">
                Confirmar &nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
            </button>
        </div>
    </div>
</form>

@endsection
