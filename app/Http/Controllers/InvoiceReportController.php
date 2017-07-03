<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Vehicle;
use App\Customer;
use App\Article;
use App\Invoicesreport;
use App\Invoicesarticle;

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
    public function index(Request $request)
    {
        // recupera todos los registros de las facturas
        $invoices['factura'] = Invoicesreport::all();
        $invoices['client'] = Customer::where('id',$invoices['factura'][0]->client_id)->get();
        var_dump($invoices->client);
        return view('invoices/index' , $invoices);
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
        try {  
            $Vehiculo = Vehicle::where('license_plate_or_detail',$request->license)->get();

            $factura = new Invoicesreport;
            $factura->vehicle_id = $Vehiculo[0]->id;
            $factura->number = $request->numInvoice;
            $factura->client_id = $Vehiculo[0]->client_id;
            $factura->total = $request->tot;
            $factura->subtotal = $request->sbt;
            $factura->iv = $request->iv;
            $factura->save();

            $invoiceReport = Invoicesreport::all();
            for ($i=0; $i < count($request->detail) ; $i++) { 
                $Article = Article::where('name',$request->detail[$i])->get();
                $facturaArticulo = new Invoicesarticle;
                $facturaArticulo->invoice_id = $invoiceReport->last()->id;
                $facturaArticulo->article_id = $Article[0]->id;
                $facturaArticulo->quantity = $request->detail[$i+1];
                $facturaArticulo->price = $request->detail[$i+2];
                $facturaArticulo->total = $request->detail[$i+3];
                $facturaArticulo->save();
                $i= $i+3;
            }
        } catch (Exception $e) {

        }

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
