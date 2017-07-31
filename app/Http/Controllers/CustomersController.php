<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\TagRequest;
use App\Customer;
use App\Provider;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Session;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los artistas
        $customers['cliennt'] = Customer::search($request->name)->orderBy('id', 'ASC')->paginate(99999999999);
        return View('/customers/index', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers['cliennt'] = Customer::all();
        return View::make('customers.create')
        ->with($customers);
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
            Customer::create($request->all());
            Session::flash('success_message', 'Se ha creado correctamente.');
            return redirect('customers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de crear al cliente');
            return Redirect::to('customers');
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
        $customers = Customer::find($id);
        return View::make('customers.show')
        ->with('cliennt', $customers);
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
        $customers['cliennt'] = Customer::find($id);
        return View::make('customers.edit')
        ->with($customers);
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
            $customers = Customer::find($id);
            $customers->name = $request->get('name');
            $customers->tell = $request->get('tell');
            $customers->observation = $request->get('observation');
            $customers->save();
            Session::flash('update_message', 'Se actualizó correctamente.');
            return Redirect::to('customers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de actualizar al cliente');
            return Redirect::to('customers');
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
            $customers = Customer::find($id);
            $customers->delete();
            Session::flash('success_message', 'Se eliminó correctamente.');
            return Redirect::to('customers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'No se pudo eliminar el cliente porque es dueño de un vehículo');
            return Redirect::to('customers');
        }
    }
}
