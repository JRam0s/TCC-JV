<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório PDF</title>
</head>

<body>
    <h1>Relatório de Gastos, Ganhos, Metas e Pagamentos</h1>

    <h2>Gastos</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Forma de Pagamento</th>
                <th>Vencimento</th>
                <th>Data de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($gasto as $item)
            <tr>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->categoria->nome ?? 'Categoria não encontrada' }}</td>
                <td>{{ number_format($item->valor, 2, ',', '.') }}</td>
                <td>{{ $item->pagamento->nome ?? 'Pagamento não encontrado' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->dt_vencimento)->format('d/m/Y') }}</td>
                <td>
                    @if($item->dt_pagamento)
                        {{ \Carbon\Carbon::parse($item->dt_pagamento)->format('d/m/Y') }}
                    @else
                    &nbsp;
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Ganhos</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Valor</th>
                <th>Fixo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ganho as $item)
            <tr>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->categoria->nome ?? 'Categoria não encontrada' }}</td>
                <td>{{ number_format($item->valor, 2, ',', '.') }}</td>
                <td>{{ $item->fixo ? 'Sim' : 'Não' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Metas</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Alcançado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($meta as $item)
            <tr>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->descricao }}</td>
                <td>{{ $item->alcancado ? 'Sim' : 'Não' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Pagamentos</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagamento as $item)
            <tr>
                <td>{{ $item->nome }}</td>
                <td>{{ $item->descricao }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Ganhos e Gastos Por Categoria</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ganhosPorCategoria as $ganho)
            <h3>Categoria: {{ $ganho->categoria->nome }} </h3>
            <p><strong>Total de Ganhos: R$ {{ number_format($ganho->total_ganhos, 2, ',', '.') }}</strong></p>

            @php
            // Buscar os gastos para a mesma categoria
            $gasto = $gastosPorCategoria->where('categoria_id', $ganho->categoria_id)->first();
            @endphp

            <p><strong>Total de Gastos: R$
                    {{ $gasto ? number_format($gasto->total_gastos, 2, ',', '.') : 'R$ 0,00' }}</strong></p>
            <br><br>
            @endforeach
        </tbody>
    </table>

</body>

</html>