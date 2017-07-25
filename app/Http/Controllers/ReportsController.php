<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\InvoicesReport;
use PDF;
use Illuminate\Support\Facades\View;
use DB;
use Session;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('/reports/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            if($request->get('report') == "Facturas de ventas"){
            /*
            SELECT * FROM `invoicesreports` 
            WHERE Client_or_Provider = 2 and created_at >= '2017-07-04 00:00:00' and created_at <= '2017-07-06 00:00:00'

            SELECT *, SUM(invoicesreports.total) as Total_Facturas
            FROM invoicesreports 
            WHERE created_at >= '2017-07-01' and created_at <= '2017-07-31'
            GROUP BY invoicesreports.id WITH ROLLUP
            */
            $invoiceV['invoiceV'] = InvoicesReport::where('Client_or_Provider','=', 2)->where('state', '=', 1)->where('created_at','>=', $request->dateIni . ' 00:00:00')->where('created_at','<=', $request->dateEnd . ' 23:59:59')->get();
            $invoiceV['ventas'] = 2;
            //echo $request->dateIni . ' 00:00:00';
            $invoiceV['contador'] = 0;
            foreach ($invoiceV['invoiceV'] as $key) {
                $invoiceV['contador'] = $invoiceV['contador'] + $key->total;
            }
            //echo $invoiceV['contador'];
            //return View('/reports', $invoiceV);
            $invoiceV['dateIni'] = $request->dateIni;
            $invoiceV['dateEnd'] = $request->dateEnd;

            $pdf = PDF::loadView('reports', $invoiceV);
            return $pdf->download('facturaVentas.pdf');
        }else if($request->get('report') == "Facturas de compras"){
            $invoiceC['invoiceC'] = InvoicesReport::where('Client_or_Provider','=', 1)->where('state', '=', 1)->where('created_at','>=', $request->dateIni . ' 00:00:00')->where('created_at','<=', $request->dateEnd . ' 23:59:59')->get();
            //echo $invoiceC;
            $invoiceC['ventas'] = 1;
            $invoiceC['compras'] = 1;
            $invoiceC['contador'] = 0;
            foreach ($invoiceC['invoiceC'] as $key) {
                $invoiceC['contador'] = $invoiceC['contador'] + $key->total;
            }
            $invoiceC['dateIni'] = $request->dateIni;
            $invoiceC['dateEnd'] = $request->dateEnd;

            $pdf = PDF::loadView('reports', $invoiceC);
            return $pdf->download('facturaCompras.pdf');
            //return View('/reports', $invoiceC);
        }else{
            /*
            SELECT ia.nameArticle, Sum(ia.quantity) AS TotalVentas 
            FROM invoicesarticles ia, invoicesreports ir
            Where ir.Client_or_Provider = 2 and ia.invoice_id = ir.id 
            and ia.created_at >= '2017-07-01' and ia.created_at <= '2017-07-31' 
            GROUP BY ia.id ORDER BY TotalVentas DESC LIMIT 1
            */
            $articles['articles'] = DB::table('invoicesarticles')
            ->join('invoicesreports', 'invoicesarticles.invoice_id', '=', 'invoicesreports.id')
            ->select('invoicesarticles.codeArticle','invoicesarticles.nameArticle', DB::raw('SUM(invoicesarticles.quantity) As TotalVentas'))
            ->where('invoicesreports.Client_or_Provider', '=',2)
            ->where('invoicesreports.state', '=',1)
            ->where('invoicesarticles.created_at', '>=', $request->dateIni . ' 00:00:00')
            ->where('invoicesarticles.created_at', '<=', $request->dateEnd . ' 23:59:59')
            ->groupBy('invoicesarticles.nameArticle', 'invoicesarticles.codeArticle')
            ->orderBy('TotalVentas', 'desc')->take(100)
            ->get();
            $articles['ventas'] = 0;
            $articles['compras'] = 0;
            $articles['dateIni'] = $request->dateIni;
            $articles['dateEnd'] = $request->dateEnd;
            //echo $articles['articles'];
            //return View('/reports', $articles);

            $pdf = PDF::loadView('reports', $articles);
            return $pdf->download('ArticulosMasVendidos.pdf');
        }
        Session::flash('success_message', 'Se ha descargado el reporte exitosamente.');
        return redirect('reports');
    } catch (\Illuminate\Database\QueryException $e) {
        Session::flash('flash_message', 'Hubo un error a la hora de descargar el reporte');
        return Redirect::to('reports');
    }

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
