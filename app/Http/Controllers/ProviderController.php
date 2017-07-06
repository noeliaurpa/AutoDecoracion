<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\TagRequest;
use App\Provider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Session;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los artistas
        $providers['provideer'] = Provider::search($request->name)->orderBy('id', 'ASC')->paginate();
        // en formato json
        //return response()->json($providers);
        return View('/providers/index', $providers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('providers.create');
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
            Provider::create($request->all());
            Session::flash('success_message', 'Se ha creado correctamente.');
            return redirect('Providers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de crear un proveedor');
            return Redirect::to('Providers');
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
        $providers = Provider::find($id);

            // Carga las vista y le pasa el "Provider"
        return View::make('providers.show')
        ->with('provideer', $providers);
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
        $providers = Provider::find($id);

            //  Muestra el formulario de edición y pasa datos del registro
        return View::make('providers.edit')
        ->with('provideer', $providers);
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
            $providers = Provider::find($id);
            //$providers->name = Input::get('name');
            $providers->name = $request->get('name');
            $providers->number_provider = $request->get('number_provider');
            $providers->address_provider = $request->get('address_provider');
            $providers->email = $request->get('email');
            $providers->fax_provider = $request->get('fax_provider');
            $providers->observation = $request->get('observation');
            $providers->save();
            Session::flash('update_message', 'Se actualizó correctamente.');
            return Redirect::to('Providers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de modificar un proveedor');
            return Redirect::to('Providers');
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
            $providers = Provider::find($id);
            $providers->delete();
            Session::flash('flash_message', 'Se eliminó correctamente.');
            return Redirect::to('Providers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de eliminar un proveedor');
            return Redirect::to('Providers');
        }
    }
}
