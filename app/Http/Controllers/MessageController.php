<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\TagRequest;
use App\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Session;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los mensajes
        $message['messaje'] = Notification::search($request->message)->orderBy('id', 'ASC')->paginate(99999999999);
        // en formato json
        return View('/notifications/index', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $message['messaje'] = Notification::all();
            // en formato json
        return View::make('notifications.create')
        ->with($message);
        
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
            $validator = Validator::make($request->all(),[
                'message' => 'required|string|max:70'
                ]);

            if($validator->fails()){
                Session::flash('flash_message', 'Algunos de los campos se insertaron de forma incorrecta, al final podrá observar el error');
                return redirect('message/create')->withErrors($validator)->withInput();
            }else{
                Notification::create($request->all());
                Session::flash('success_message', 'Se ha creado correctamente.');
                return redirect('message');
            }
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de crear el mensaje');
            return Redirect::to('message');
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
        $message['messaje'] = Notification::find($id);

            //  Muestra el formulario de edición y pasa datos del registro
        return View::make('notifications.edit')
        ->with($message);
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
            $message = Notification::find($id);
            $message->message = $request->get('message');
            $message->save();
            Session::flash('update_message', 'Se actualizó correctamente.');
            return Redirect::to('message');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de actualizar el mensaje');
            return Redirect::to('message');
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
            $message = Notification::find($id);
            $message->delete();
            Session::flash('success_message', 'Se eliminó correctamente.');
            return Redirect::to('message');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de eliminar el mensaje');
            return Redirect::to('message');
        }
    }
}
