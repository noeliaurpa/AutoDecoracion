<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Smallboxe;
use App\Article;
use Illuminate\Support\Facades\View;

class SmallboxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los artistas
        $smallbox['smallbox'] = Smallboxe::search($request->name)->orderBy('id', 'ASC')->paginate();
        // en formato json
        //return response()->json($Articles);
        return View('/smallboxes/index', $smallbox);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Recupera el registro de base de datos
        $smallbox = Smallboxe::find($id);
        $smallbox['article'] = Article::find($smallbox->article_id);
        // Carga las vista y le pasa el "inventario de articulos"
        return View::make('smallboxes.show')
        ->with('smallb', $smallbox);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
