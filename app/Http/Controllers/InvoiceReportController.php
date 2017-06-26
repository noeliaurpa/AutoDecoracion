<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Vehicle;
use App\Customer;
use App\Article;

class InvoiceReportController extends Controller
{
    private $client = null;

    public function __CONSTRUCT()
    {
        $this->client = new Customer();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers['client'] = Customer::all();
        $customers['vehicle'] = Vehicle::all();
        $customers['article'] = Article::all();
        // en formato json
        return View::make('invoices/create')
        ->with($customers);
        //return view('invoices/create');
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
    }
    /**
     * .
     *
     * @return \Illuminate\Http\Response
     */
    public function findVehicle(Request $request)
    {
        //$vehicles['vehiclee'] = Vehicle::search($request->license_plate_or_detail)->orderBy('id', 'DESC')->paginate(5);
        $vehicles['vehiculo'] = Vehicle::vehicle($request->id)->orderBy('id', 'DESC');
        var_dump($vehicles);
        //return $vehicles;
    }

    /**
     * .
     *
     * @return \Illuminate\Http\Response
     */
    public function findClient(Request $request)
    {
        //$clients['client'] = Customer::name($request->name)->orderBy('id', 'DESC');
        var_dump(Customer::search($request->name)->orderBy('id', 'DESC'));
        //return $clients;
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
