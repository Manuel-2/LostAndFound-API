@extends('layout.app')

@section('title','Publicaciones')

@section('content')
<section class="dashboard-group">
  <table class="table-spacious">
    <thead>
      <tr>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Foto</th>
        <th>Categoria</th>
        <th>Ubicacion</th>
        <th>Fecha incidente</th>
        <th>Usuario</th>
        <th>Fecha publicación</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
      <tr>
        <td>{{$post->type}}</td>
        <td>{{$post->status}}</td>
        <td>{{$post->title}}</td>
        <td>{{$post->description}}</td>
        <td>
          {!! $post->pictures
          ? '<img src="'.Storage::disk('s3')->url($post->pictures).'" alt="-" style="width: 100px;">'
          : '-'
          !!}

        </td>
        <td>{{$post->category->name}}</td>
        <td>{{$post->location->name}}</td>
        <td>{{$post->incident_date}}</td>
        <td>{{$post->user->name}}</td>
        <td>{{$post->created_at}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>
@endsection
