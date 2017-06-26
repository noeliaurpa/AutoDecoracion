<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\TagRequest;
use App\Customer;
use App\vehicle;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los vehiculos
        $vehicles['vehiclee'] = Vehicle::search($request->license_plate_or_detail)->orderBy('id', 'DESC')->paginate(5);
        $vehicles['clieen'] = Customer::all();
        // en formato json
        //return response()->json($vehicles);
        return View('/vehicles/index', $vehicles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicles['vehiclee'] = Vehicle::all();
        $vehicles['clieen'] = Customer::all();
        // en formato json
        //return response()->json($vehicles);
        //return View('/vehicles/index', $vehicles);
        return View::make('vehicles.create')
        ->with($vehicles);
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
        Vehicle::create($request->all());
        return redirect('vehicles');
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
        $vehicles = Vehicle::find($id);
        $vehicles['clieen'] = Customer::find($vehicles->Customer_id);

            // Carga las vista y le pasa el "vehicle"
        return View::make('vehicles.show')
        ->with('vehiclee', $vehicles);
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
        $vehicles['vehiclee'] = Vehicle::find($id);
        $vehicles['clieen'] = Customer::all();

            //  Muestra el formulario de edición y pasa datos del registro
        return View::make('vehicles.edit')
        ->with($vehicles);
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
        $vehicles = Vehicle::find($id);
        $vehicles->Customer_id = $request->get('Customer_id');
        $vehicles->license_plate_or_detail   = $request->get('license_plate_or_detail    ');
        $vehicles->brand = $request->get('brand');
        $vehicles->model = $request->get('model');
        $vehicles->observation = $request->get('observation');
        $vehicles->save();
        return Redirect::to('vehicles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $vehicles = Vehicle::find($id);
        $vehicles->delete();
        return Redirect::to('vehicles');
    }
}
