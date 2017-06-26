<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quote;

class QuotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *vamos a recuperar todos los quoteos para mostrarlos en el home
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = quote::all();
        //return Response()->json($data);

        $data = Quote::get(['id','title', 'start','end', 'color']);
        return Response()->json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quote = new Quote();
        $quote->title = $request->title;
        $quote->start = $request->date_start.' '.$request->time_start;
        $quote->end = $request->date_end;
        $quote->color = $request->color;
        $quote->save();

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::find($id);
        if($quote == null)
            return Response()->json([
            'message' => 'success delete.'
            ]);
        $quote->delete();
        return Response()->json([
            'message' => 'success delete.'
        ]);
    }
}
