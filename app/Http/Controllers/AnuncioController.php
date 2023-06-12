<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;

class AnuncioController extends Controller{
    public function verAnuncios(){
        $anuncios = Anuncio::where("tipo","Todos")->get();
        return $anuncios;
    }
    public function verAnunciosUsuario(){
        $id_usuario = auth()->user()->id;
        $anuncios = Anuncio::where("id_usuario",$id_usuario)->get();
        return $anuncios;
    }
    public function enviarAnuncio(Request $request){
        $anuncio = new Anuncio;
        $anuncio->mensaje = $request->mensaje;
        if($request->para == 0){
            $anuncio->tipo = "Todos";
            $anuncio->id_usuario = 0;
        }else{
            $anuncio->tipo = "Unico";
            $anuncio->id_usuario = $request->para;
        }
        $anuncio->fecha = date("Y-m-d H:i:s");
        $anuncio->save();
        return "Mensaje creado correctamente";
    }
}