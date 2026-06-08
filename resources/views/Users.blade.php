@extends('layout.app')

@section('title','Usuarios')

@section('content')
<section class="dashboard-group">
    <table class="table-spacious">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Fecha registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>
                    {!! $user->picture
                    ? '<img src="'.Storage::disk('s3')->url($user->picture).'" alt="x" style="width: 100px;">'
                    : '-'
                    !!}

                </td>
                <td>{{$user->name}}</td>
                <td>{{$user->phone?$user->phone:'-'}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->created_at->toDateString()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
