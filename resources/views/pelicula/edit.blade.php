@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url('/pelicula/'.$pelicula->id) }}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('pelicula.form',['modo'=>'Editar']);

</form>
</div>
@endsection

