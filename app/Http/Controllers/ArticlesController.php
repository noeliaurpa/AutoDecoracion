<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\TagRequest;
use App\Article;
use App\Inventorie;
use App\Smallboxe;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Session;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los artistas
        $articles['articlee'] = Article::search($request->name)->orderBy('id', 'ASC')->paginate(99999999999);
        // en formato json
        //return response()->json($Articles);
        return View('/articles/index', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $articles['articlee'] = Article::all();
            // en formato json
        return View::make('articles.create')
        ->with($articles);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $id = Article::create($request->all());
            $idd = $id->id;
            $nameArticle = $id->name;
            if($request->get('radSize') == 'inventario')
            {
                $Inventorie = new Inventorie;
                $Inventorie->article_id = $idd;
                $Inventorie->nameArticle = $nameArticle;
                $Inventorie->observation = null;
                $Inventorie->save();
            }else{
                $Smallboxe = new Smallboxe;
                $Smallboxe->article_id = $idd;
                $Smallboxe->nameArticle = $nameArticle;
                $Smallboxe->observation = null;
                $Smallboxe->save();
            }
            Session::flash('success_message', 'Se ha creado correctamente.');
            return redirect('articles');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de crear el articulo');
            return Redirect::to('articles');
        }
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
        $articles = Article::find($id);

            // Carga las vista y le pasa el "Article"
        return View::make('articles.show')
        ->with('articlee', $articles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Recupera el registro de base de datos
        $articles['articlee'] = Article::find($id);

            //  Muestra el formulario de edición y pasa datos del registro
        return View::make('articles.edit')
        ->with($articles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $articles = Article::find($id);
            //$Articles->name = Input::get('name');
            $articles->name = $request->get('name');
            $articles->code = $request->get('code');
            $articles->sale_price = $request->get('sale_price');
            $articles->purchase_price = $request->get('purchase_price');
            $articles->unit_or_quantity = $request->get('unit_or_quantity');
            $articles->save();
            Session::flash('update_message', 'Se actualizó correctamente.');
            return Redirect::to('articles');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de actualizar el articulo');
            return Redirect::to('articles');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // delete
            $articles = Article::find($id);
            $inventori = Inventorie::where('article_id', $id)->get();
            $smallB = Smallboxe::where('article_id', $id)->get();
            if(count($inventori) > 0){
                $inventario = Inventorie::find($inventori[0]->id);
                $inventario->delete();
                $articles->delete();
            }else{
                $cajachica = Smallboxe::find($smallB[0]->id);
                $cajachica->delete();
                $articles->delete();
            }
            Session::flash('success_message', 'Se eliminó correctamente.');
            return Redirect::to('articles');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Eliminaste un articulo por lo tanto se eliminó de la caja chica o del inventario');
            return Redirect::to('articles');
        }
    }
}
