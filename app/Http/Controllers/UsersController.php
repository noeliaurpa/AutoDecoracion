<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // recupera todos los registros de los usuarios
        $users['users'] = User::search($request->name)->orderBy('id', 'ASC')->paginate(99999999999);
        // en formato json
        return View('/auth/index', $users);
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
        $users['users'] = User::find($id);

            //  Muestra el formulario de edición y pasa datos del registro
        return View::make('auth.edit')
        ->with($users);
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
            $users = User::find($id);
            $users->tell = $request->get('tell');
            $users->salary = $request->get('salary');
            $users->observation = $request->get('observation');
            $users->save();
            Session::flash('update_message', 'Se actualizó correctamente.');
            return Redirect::to('/users');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de modificar el usuario');
            return Redirect::to('/users');
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
            $users = User::find($id);
            $users->delete();
            Session::flash('flash_message', 'Se eliminó correctamente.');
            return Redirect::to('/users');
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('flash_message', 'Hubo un error a la hora de eliminar el usuario');
            return Redirect::to('/users');
        }
    }
}
