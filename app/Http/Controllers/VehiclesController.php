<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\TagRequest;
use App\Customer;
use App\Vehicle;
use App\Brand;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Session;
use Illuminate\Support\Facades\Validator;

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
        $vehicles['vehiclee'] = Vehicle::search($request->license_plate_or_detail)->orderBy('id', 'ASC')->paginate(99999999999);
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
        $vehicles['brands'] = Brand::all();
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
        try {
            if($request->observation == null){
                $validator = Validator::make($request->all(),[
                    'license_plate_or_detail' => 'required|string|max:6',
                    'model' => 'required|string|max:50'
                    ]);
            }else{
                $validator = Validator::make($request->all(),[
                    'license_plate_or_detail' => 'required|string|max:6',
                    'model' => 'required|string|max:50',
                    'observation' => 'string|max:150'
                    ]);
            }
            
            if($validator->fails()){
                Session::flash('flash_message', 'Algunos de los campos se insertaron de forma incorrecta, al final podrá observar el error');
                return redirect('vehicles/create')->withErrors($validator)->withInput();
            }else{
                Vehicle::create($request->all());
                Session::flash('success_message', 'Se ha creado correctamente.');
                return redirect('vehicles');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de crear el registro de un vehículo');
            return Redirect::to('vehicles');
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
        $vehicles = Vehicle::find($id);
        $vehicles['clieen'] = Customer::find($vehicles->client_id);
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
        $vehicles['clieen'] = Customer::where('id', '=', $vehicles['vehiclee']->client_id)->get();
        $vehicles['brands'] = Brand::where('brand', '=', $vehicles['vehiclee']->brand)->get();
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
        try {
            if($request->observation == null){
                $validator = Validator::make($request->all(),[
                    'license_plate_or_detail' => 'required|string|max:6',
                    'model' => 'required|string|max:50'
                    ]);
            }else{
                $validator = Validator::make($request->all(),[
                    'license_plate_or_detail' => 'required|string|max:6',
                    'model' => 'required|string|max:50',
                    'observation' => 'string|max:150'
                    ]);
            }
            
            if($validator->fails()){
                Session::flash('flash_message', 'Algunos de los campos se insertaron de forma incorrecta, al final podrá observar el error');
                return redirect('vehicles/'.$id.'/edit')->withErrors($validator)->withInput();
            }else{
                $vehicles = Vehicle::find($id);
                $vehicles->client_id = $request->get('client_id');
                $vehicles->license_plate_or_detail = $request->get('license_plate_or_detail');
                $vehicles->brand = $request->get('brand');
                $vehicles->model = $request->get('model');
                $vehicles->observation = $request->get('observation');
                $vehicles->save();
                Session::flash('update_message', 'Se actualizó correctamente.');
                return Redirect::to('vehicles');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de actualizar el vehículo');
            return Redirect::to('vehicles');
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
            $vehicles = Vehicle::find($id);
            $vehicles->delete();
            Session::flash('success_message', 'Se eliminó correctamente.');
            return Redirect::to('vehicles');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de eliminar el vehículo porque pertenece a una factura');
            return Redirect::to('vehicles');
        }
    }
}
