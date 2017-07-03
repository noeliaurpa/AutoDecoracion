<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventorie;
use App\Article;
use Illuminate\Support\Facades\View;

class InventoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los artistas
        $inventories['inventor'] = Inventorie::search($request->name)->orderBy('id', 'ASC')->paginate();
        // en formato json
        //return response()->json($Articles);
        return View('/inventories/index', $inventories);
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
        $inventory = Inventorie::find($id);
        $inventory['article'] = Article::find($inventory->article_id);
        // Carga las vista y le pasa el "inventario de articulos"
        return View::make('inventories.show')
        ->with('inventor', $inventory);
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
