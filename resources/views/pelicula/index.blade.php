@extends('layouts.app')
@section('content')
<div class="container">





<a href="{{ url('pelicula/create') }}" class="btn btn-success">Registrar nueva pelicula</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Id</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Fecha Publicación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peliculas as $pelicula)
        <tr>
            <td>{{ $pelicula->id }}</td>

            <td>
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$pelicula->Imagen }}"  width="100" alt="">
            </td>

            <td>{{ $pelicula->Nombres }}</td>
            <td>{{ $pelicula->FechaPublicación }}</td>
            <td>
            
            <a href="{{ url('/pelicula/'.$pelicula->id.'/edit') }}" class="btn btn-warning">
                Editar
            </a>
                
             
                
            <form action="{{ url('/pelicula/'.$pelicula->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar esto?')" value="Borrar">
            </form>    
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $peliculas->links() !!}
</div>
@endsection