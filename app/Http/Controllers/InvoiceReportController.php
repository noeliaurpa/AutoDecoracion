<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Vehicle;
use App\Customer;
use App\Article;
use App\Invoicesreport;
use App\Invoicesarticle;
use PDF;
use Session;
use Illuminate\Support\Facades\Redirect;

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
            $factura->state = 1;
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
                $artic = Article::find($Article[0]->id);
                $quantityUpdate = $Article[0]->unit_or_quantity - $facturaArticulo->quantity;
                $artic->unit_or_quantity = $quantityUpdate;
                $artic->save();
            }
        } catch (Exception $e) {

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
        $invoice = Invoicesreport::find($id);
        $invoice['invoicearticle'] = Invoicesarticle::where('invoice_id',$invoice->id)->get();
            // Carga las vista y le pasa el "vehicle"
        return View::make('invoices.show')
        ->with('invoicereport', $invoice);
    }

    public function download($id)
    {
        $invoice = Invoicesreport::find($id);
        $invoice['invoicearticle'] = Invoicesarticle::where('invoice_id',$invoice->id)->get();
        $pdf = PDF::loadView('invoice_reports', ['invoicereport' => $invoice]);
        return $pdf->download('invoice.pdf');
    }

    public function annular($id)
    {
        try {
            $invoiceReport = Invoicesreport::find($id);
            $invoiceReport->state = 0;
            $invoiceReport->save();
            Session::flash('success_message', 'Se anuló la factura correctamente.');
            return Redirect::to('invoices');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'No se pudo anular la factura, ocurrió un error');
            return Redirect::to('invoices');
        }
    }
}
