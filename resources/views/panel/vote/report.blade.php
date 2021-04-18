<style>
    h3.title {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        text-align: center;
        color: #252525;
        background-color: #d0cfcf;
        padding: 8px 0;
    }

    .cuadro {
        border: 2px solid #d0cfcf;
        width: 100%;
        overflow: hidden;
        text-align: center;
    }

    table tr>td.cuadro {
        border: 2px solid #d0cfcf;
        padding: 10px;
        margin: 10px;
    }

    table.result {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        font-size: 11px;
        text-align: left;
        border-collapse: collapse;
    }

    table.result th,
    table.result td {
        text-align: left;
        padding: 8px;
        border: 1px solid #c7c7c7;
    }

    table.result tr>td:first-child {
        background-color: #f2f2f2;
    }

    .photo {
        width: 48px;
        height: 48px;
        overflow: hidden;
        object-fit: contain;
        align-items: center;
        display: flex;
        background-color: white;
        border: 1px solid;
        border-radius: 5px;
        border-color: rgba(156, 163, 175, 0.6);
    }
</style>

<h3 class="title">
    RESULTADO DE ELECCIONES
</h3>

<hr style="border: 1px solid #d0cfcf;">

<table style="width:100%" class="result">
    <thead>
        <tr style="background-color: steelblue; color:white">
            <th style="width: 10%; text-align: center;"></th>
            <th style="width: 54%; text-align: center;">Candidato</th>
            <th style="width: 12%; text-align: center;">Votos</th>
            <th style="width: 12%; text-align: center;">% global</th>
            <th style="width: 12%; text-align: center;">% Votos</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($candidates as $candidate)
        <tr>
            <td style="text-align: center;">
                <div class="photo">
                    <img src="{{ asset($candidate->census->photo) }}" style="width:100%">
                </div>
            </td>
            <td>
                <p style="font-weight: bold; margin:0; font-size:14px;">{{$candidate->census->name}}
                    {{$candidate->census->last_name}}
                </p>
                <p style="margin:0; font-size:12px;">{{$candidate->party_name}}</p>
            </td>
            <td style="text-align: center;">
                {{$candidate->votes->count()}}
            </td>
            <td style="text-align: center;">
                {{round( ((100/$total)*$candidate->votes->count()), 2)}}%
            </td>
            <td style="text-align: center;">
                {{round( ((100/$emitido)*$candidate->votes->count()), 2)}}%
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
