@extends('template.main', ['menu' => "admin", 'submenu' => "Ganhos", 'rota'=>"ganho.create"])

@section('titulo') Desenvolvimento Web @endsection

@section('conteudo')

<div class="row">
    <div class="col">
        <table class="table align-middle caption-top table-striped  bg-white">

            <caption class="">Tabela de <b>Ganhos</b></caption>
            <thead>
                <tr>
                    <th scope="col" class="d-none d-md-table-cell">ID</th>
                    <th scope="col">NOME</th>
                    <th scope="col" class="d-none d-md-table-cell">VALOR</th>
                    <th scope="col">FIXO</th>
                    <th scope="col">CATEGORIA</th>
                    <th scope="col">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td d-none d-md-table-cell>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->valor }}</td>
                    <td>
                        @if($item->fixo == 1)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#934789"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#099999"
                            class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />
                        </svg>
                        @endif
                    </td>
                    <td>
                        {{ $item->categoria->nome ?? 'Categoria não encontrada' }}
                    </td>
                    <td>
                        <a href="{{ route('ganho.edit', $item->id) }}" class="btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffff"
                                class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                <path
                                    d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                            </svg>
                        </a>
                        <a nohref style="cursor:pointer"
                            onclick="showRemoveModal('{{ $item->id }}', '{{ $item->nome }}')" class="btn btn-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ffff"
                                class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg>
                        </a>
                    </td>
                    <form action="{{ route('ganho.destroy', $item->id) }}" method="POST" id="form_{{$item->id}}">
                        @csrf
                        @method('DELETE')
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection