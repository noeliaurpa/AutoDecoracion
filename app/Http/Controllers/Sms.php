<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TextMagicSMS\TextMagicAPI;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
use App\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class Sms extends Controller
{
    public function index()
    {
        $customers['cliennt'] = Customer::all();
        $customers['mesage'] = Notification::all();
        return View::make('sms')
        ->with($customers);
    }

    public function send(Request $request)
    {
        $custom = Customer::where('name', '=', $request->nameClient)->get();
     try {
        foreach ($custom as $key) {
            if(("506".$key->tell) == $request->tellClient){
                $validator = Validator::make($request->all(),[
                    'message' => 'required|string|max:70',
                    'tellClient' => 'required|string|max:11'
                    ]);

                if($validator->fails()){
                    Session::flash('flash_message', 'Algunos de los campos se insertaron de forma incorrecta, al final podrá observar el error');
                    return redirect('send')->withErrors($validator)->withInput();
                }else{
                    $api = new TextMagicAPI(array
                        (
                            'username' => 'noeliaurpa',
                            'password' => 'Noelia111495'
                            )
                        );

                    $text = $request->message;

                    $numero = (float)$request->tellClient;

                    $phones = array
                    (
            // Country Number + Phone Number
            $numero,  // Phone1
            );

                    $is_unicode = true;

                    $api->send($text, $phones, $is_unicode);
                    Session::flash('success_message','Se envió el mensaje correctamente.');
                    return Redirect::to('/message');
                }
            }else{
                Session::flash('flash_message','El número de teléfono no corresponde a ese cliente.');
                return Redirect::to('/send');
            }
        }

    } catch (\Exception $e) {
        Session::flash('flash_message','No se puede enviar mensajes porque no tienes saldo suficiente. ');
        return Redirect::to('/message');
    }
}
}
