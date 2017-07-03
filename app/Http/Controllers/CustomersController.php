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
        $customers['cliennt'] = Customer::search($request->name)->orderBy('id', 'ASC')->paginate();
        $customers['proveer'] = Provider::all();
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
        $customers['proveer'] = Provider::all();
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
        //return $request->all();
        Customer::create($request->all());
        return redirect('customers');
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
        if ($customers->provider_id == null) {
            return View::make('customers.show')
            ->with('cliennt', $customers);
        }else{
            $customers['proveer'] = Provider::find($customers->provider_id);
            return View::make('customers.show')
            ->with('cliennt', $customers);
        }
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
        $customers['proveer'] = Provider::all();
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
        $customers = Customer::find($id);
        $customers->provider_id = $request->get('provider_id');
        $customers->name = $request->get('name');
        $customers->tell = $request->get('tell');
        $customers->observation = $request->get('observation');
        $customers->save();
        return Redirect::to('customers');
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
            return Redirect::to('customers');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'No se puede eliminar el proveedor porque un cliente lo está utilizando');
            return Redirect::to('customers');
        }
    }
}
