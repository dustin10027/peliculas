<?php

namespace App\Http\Controllers;

use App\Models\Peliculas;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['peliculas']=Peliculas::paginate(4);
        return view('pelicula.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pelicula.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $campos=[
            'Nombres'=>'required|string|max:100',
            'Imagen'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Imagen.required'=>'La imagen es requerida'
        ];

        $this->validate($request,$campos,$mensaje);
        //$datosPelicula= request()->all();
        $datosPelicula= request()->except('_token');
        
        if($request->hasFile('Imagen')){
            $datosPelicula['Imagen']=$request->file('Imagen')->store('uploads','public');
        }


        Peliculas::insert($datosPelicula);

        //return response()->json($datosPelicula);
        return redirect('pelicula')->with('mensaje','Pelicula agregada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function show(Peliculas $peliculas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pelicula=Peliculas::findOrFail($id);
        return view('pelicula.edit', compact('pelicula'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombres'=>'required|string|max:100',
            'Imagen'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Imagen.required'=>'La imagen es requerida'
        ];

        $this->validate($request,$campos,$mensaje);
        //
        $datosPelicula= request()->except(['_token','_method']);

        if($request->hasFile('Imagen')){
            $pelicula=Peliculas::findOrFail($id);
            Storage::delete('public/'.$pelicula->Imagen);
            $datosPelicula['Imagen']=$request->file('Imagen')->store('uploads','public');
        }

        Peliculas::where('id','=',$id)->update($datosPelicula);

        $pelicula=Peliculas::findOrFail($id);
        //return view('pelicula.edit', compact('pelicula'));

        return redirect('pelicula')->with('mensaje','Pelicula Modificada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $pelicula=Peliculas::findOrFail($id);
        if(Storage::delete('public/'.$pelicula->Imagen)){
            Peliculas::destroy($id);
        }
        
        return redirect('pelicula')->with('mensaje','Pelicula Borrada');
    }
}
