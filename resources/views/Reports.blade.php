@extends('layout.app')

@section('title','Reportes')

@section('content')
<section class="dashboard-group">
    <table class="table-spacious">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo publicacion</th>
                <th>Descripcion publicacion</th>
                <th>Usuario publicacion</th>
                <th>Usuario que reproto</th>
                <th>Motivo de reporte</th>
                <th>Eliminar publicacion</th>
                <th>Ignorar reporte</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>
                    {!! $report->post->pictures
                    ? '<img src="'.Storage::disk('s3')->url($report->post->pictures).'" alt="x" style="width: 100px;">'
                    : '-'
                    !!}

                </td>
                <td>{{$report->post->title}}</td>
                <td>{{$report->post->description}}</td>
                <td>{{$report->post->user->name}}</td>
                <td>{{$report->user->name}}</td>
                <td>{{$report->reason}}</td>
                <td>
                    <form method="post" action="/reports/delete">
                        <input type="submit" value="X" style="background-color: red; border-radius: 15px; font-size: 40px;color:white; border: none;padding:5px 20px;cursor: pointer;">
                        <input type="hidden" name="report_id" value="{{$report->id}}">
                        <input type="hidden" name="post_id" value="{{$report->post->id}}">
                    </form>
                </td>
                <td>
                    <form method="post" action="/reports/ignore">
                        <input type="submit" value="ok" style="background-color: green; border-radius: 15px; font-size: 40px;color:white; border: none;padding:5px 20px;cursor: pointer;">
                        <input type="hidden" name="report_id" value="{{$report->id}}">
                        <input type="hidden" name="post_id" value="{{$report->post->id}}">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
