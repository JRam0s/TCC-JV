@extends('template.main', ['menu' => "home", "submenu" => "Atividade"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<div class="row mb-3 ">
    <div class="col">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            @foreach ($data as $item)
                <div class="accordion-item ">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush_{{$item->id}}" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span class="text-dark fs-5">{{ $item->nome }}</span>
                        </button>
                    </h2>
                    <div id="flush_{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-md-10 col-xs-12 d-flex align-items-center justify-content-center">
                                    <p class="text-dark fs-6">{{ $item->descricao }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection