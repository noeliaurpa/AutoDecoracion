<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TextMagicSMS\TextMagicAPI;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Customer;
use App\Notification;
use Illuminate\Support\Facades\View;

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
        try {
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
        } catch (\Exception $e) {
            Session::flash('flash_message','No se puede enviar mensajes porque no tienes saldo suficiente. '.$e);
            return Redirect::to('/message');
        }
    }
}
