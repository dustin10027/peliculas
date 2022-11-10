<h1>{{ $modo }} pelicula</h1>
@if(count($errors)>0)

  <div class="alert alert-danger" role="alert">
<ul>
    @foreach($errors->all() as $error)

     <li>{{ $error }}</li>
  @endforeach
</ul>  
  </div>

 
@endif


<div class="form-group">

<label for="Nombres">Nombre</label>
<input type="text" class="form-control" name="Nombres" value="{{ isset($pelicula->Nombres)?$pelicula->Nombres:old('Nombres') }}" id="Nombres">
<br>

</div>

<div class="form-group">
<label for="FechaPublicación">Fecha Publicación</label>
<input type="date" class="form-control" name="FechaPublicación" value="{{ isset($pelicula->FechaPublicación)?$pelicula->FechaPublicación:old('FechaPublicación') }}" id="FechaPublicación">
<br>
</div>

<div class="form-group">
<label for="Imagen"></label>
@if(isset($pelicula->Imagen))

<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$pelicula->Imagen }}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Imagen" value="" id="Imagen">
<br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }}">

<a class="btn btn-primary" href="{{ url('pelicula/') }}">Regresar</a>
<br>