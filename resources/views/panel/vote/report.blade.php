<style>
    h3.title {
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        text-align: center;
        color: #252525;
        padding: 8px 0;
        text-transform:uppercase;
        /*border-bottom:1px solid #ccc;*/
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
        margin-top:3rem;
    }

    table.result th,
    table.result td {
        text-align: left;
        padding: 8px;
    }
    table.result td{
        border: 1px solid #c7c7c7;
    }

    table.result tr>td:first-child {
        background-color: #f2f2f2;
    }
    table tr th{
        background: steelblue;
        border:1px solid steelblue; 
        color:white;
        text-align:center;
        padding:8px;
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
    .abstract{
        font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
        margin-top:1.5rem;
        border-collapse: collapse;
        font-size:0.9rem;
    }
    .abstract tr th,
    .abstract tr td{
        padding:0.2rem 0.5rem;
        font-size:0.7rem;
    }
    .abstract tr td {
        border:1px solid #c7c7c7;
    }
    .abstract tr th{
            
    }
</style>

<h3 class="title">
    Resultados de Elección Municipio Escolar de la {{ $school->name }}
</h3>

<table style="width:100%" class="result">
    <thead>
        <tr>
            <th style="width: 10%; text-align: center;"></th>
            <th style="width: 54%; text-align: center;">Candidato</th>
            <th style="width: 12%; text-align: center;">Votos</th>
            <th style="width: 24%; text-align: center;">% Votos sobre el Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($candidates as $candidate)
        <tr>
            <td style="text-align: center;">
                <div class="photo">
                    <img src="{{ asset($candidate->photo) }}" style="width:100%">
                </div>
            </td>
            <td>
                <p style="font-weight: bold; margin:0; font-size:14px;">{{$candidate->name}}
                    {{$candidate->last_name}}
                </p>
                <p style="margin:0; font-size:12px;">{{$candidate->party_name}}</p>
            </td>
            <td style="text-align: center;">
                {{$candidate->votes}}
            </td>
            <td style="text-align: center;">
                {{round( ((100/$total)*$candidate->votes), 2)}}%
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="abstract">
    <thead>
        <tr>
            <th colspan="2" style="width:100px;text-align:center;">Detalles</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total padrón</td><td style="text-align:center;">{{ $total }}</td>        
        </tr>
        <tr>
            <td>Número de candidatos</td><td style="text-align:center;" >{{ $candidates->count() }}</td>        
        </tr>
        <tr>
            <td>Actas procesadas</td><td style="text-align:center;" >{{ round((100/$total)*$emitido,2)  }}%</td>        
        </tr>
    </tbody>
</table>