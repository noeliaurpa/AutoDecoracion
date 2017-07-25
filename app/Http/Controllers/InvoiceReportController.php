<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Vehicle;
use App\Customer;
use App\Provider;
use App\Article;
use App\Invoicesreport;
use App\Invoicesarticle;
use PDF;
use Session;
use Illuminate\Support\Facades\Redirect;

class InvoiceReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de las facturas
        $invoices['factura'] = Invoicesreport::search($request->name)->orderBy('id', 'ASC')->paginate();
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
        $customers['numInvoice'] = Invoicesreport::max('id');
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
            $factura = new Invoicesreport;
            $factura->license_plate_or_detail = $request->license;
            $factura->brand = $request->brand;
            $factura->model = $request->model;
            $factura->number = $request->numInvoice;
            $factura->nameClient = $request->nameC;
            $factura->total = $request->tot;
            $factura->subtotal = $request->sbt;
            $factura->iv = $request->iv;
            $factura->state = 1;
            $factura->Client_or_Provider = 2;
            $factura->save();
            

            $invoiceReport = Invoicesreport::all();
            for ($i=0; $i < count($request->detail) ; $i++) { 
                $Article = Article::where('name',$request->detail[$i])->get();
                $facturaArticulo = new Invoicesarticle;
                $facturaArticulo->invoice_id = $invoiceReport->last()->id;
                $facturaArticulo->codeArticle = $Article[0]->code;
                $facturaArticulo->nameArticle = $Article[0]->name;
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
            Session::flash('success_message', 'Se creó la factura correctamente.');
            return Redirect::to('invoices');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'No se pudo crear la factura, ocurrió un error');
            return Redirect::to('invoices');
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
        return $pdf->download('FacturaCliente.pdf');
    }

    public function annular($id)
    {
        try {
            $invoiceReport = Invoicesreport::find($id);
            $invoiceReport->state = 0;
            $invoiceReport->save();

            $invoiceAricle = Invoicesarticle::where('invoice_id', $id)->get();
            foreach ($invoiceAricle as $key) {
                $article = Article::where('code', '=', $key->codeArticle)->get();
                foreach ($article as $artic) {
                    $artic->unit_or_quantity = $artic->unit_or_quantity + $key->quantity;
                    $artic->save();
                }
            }
            Session::flash('success_message', 'Se anuló la factura correctamente.');
            return Redirect::to('invoices');
        } catch (\Illuminate\Database\QueryException $e) {
           Session::flash('flash_message', 'No se pudo anular la factura, ocurrió un error');
           return Redirect::to('invoices');
       }
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createReportPurchase()
    {
        $customers['provider'] = Provider::all();
        $customers['article'] = Article::all();
        $customers['numInvoice'] = Invoicesreport::max('id');
        // en formato json
        return View::make('invoices/createReportPurchase')
        ->with($customers);
        //return view('invoices/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReportPurchase(Request $request)
    {
        try {  
            $factura = new Invoicesreport;
            $factura->number = $request->numInvoice;
            $factura->nameClient = $request->nameP;
            $factura->total = $request->tot;
            $factura->subtotal = $request->sbt;
            $factura->iv = $request->iv;
            $factura->state = 1;
            $factura->Client_or_Provider = 1;
            $factura->save();

            $invoiceReport = Invoicesreport::all();
            for ($i=0; $i < count($request->detail) ; $i++) { 
                $Article = Article::where('name',$request->detail[$i])->get();
                $facturaArticulo = new Invoicesarticle;
                $facturaArticulo->invoice_id = $invoiceReport->last()->id;
                $facturaArticulo->codeArticle = $Article[0]->code;
                $facturaArticulo->nameArticle = $Article[0]->name;
                $facturaArticulo->quantity = $request->detail[$i+1];
                $facturaArticulo->price = $request->detail[$i+2];
                $facturaArticulo->total = $request->detail[$i+3];
                $facturaArticulo->save();
                $i= $i+3;
                $artic = Article::find($Article[0]->id);
                $quantityUpdate = $Article[0]->unit_or_quantity + $facturaArticulo->quantity;
                $newPrice = $facturaArticulo->price;
                $artic->unit_or_quantity = $quantityUpdate;
                $artic->purchase_price = $newPrice;
                $artic->save();
            }
            Session::flash('success_message', 'Se creó la factura correctamente.');
            return Redirect::to('invoices');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'No se pudo crear la factura, ocurrió un error');
            return Redirect::to('invoices');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showReportPurchase($id)
    {
        $invoice = Invoicesreport::find($id);
        $invoice['invoicearticle'] = Invoicesarticle::where('invoice_id',$invoice->id)->get();
            // Carga las vista y le pasa el "vehicle"
        return View::make('invoices.showReportPurchase')
        ->with('invoicereport', $invoice);
    }

    public function downloadReportPurchase($id)
    {
        $invoice = Invoicesreport::find($id);
        $invoice['invoicearticle'] = Invoicesarticle::where('invoice_id',$invoice->id)->get();
        $pdf = PDF::loadView('invoice_reportsProvider', ['invoicereport' => $invoice]);
        return $pdf->download('FacturaProveedor.pdf');
    }

    public function annularReportPurchase($id)
    {
        try {
            $invoiceReport = Invoicesreport::find($id);
            $invoiceReport->state = 0;
            $invoiceReport->save();

            $invoiceAricle = Invoicesarticle::where('invoice_id', $id)->get();
            foreach ($invoiceAricle as $key) {
                $article = Article::where('code', '=', $key->codeArticle)->get();
                foreach ($article as $artic) {
                    $artic->unit_or_quantity = $artic->unit_or_quantity - $key->quantity;
                    $artic->save();
                }
            }

            Session::flash('success_message', 'Se anuló la factura correctamente.');
            return Redirect::to('invoices');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'No se pudo anular la factura, ocurrió un error');
            return Redirect::to('invoices');
        }
    }
}
