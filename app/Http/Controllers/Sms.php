<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TextMagicSMS\TextMagicAPI;

class Sms extends Controller
{
	public function index()
	{
		return view('sms');
	}

	public function send(Request $request)
	{

    //var_dump($request->tell);
        try {
            $api = new TextMagicAPI(array
                (
                    'username' => 'noeliaurpa',
                    'password' => 'Noelia111495'
                    )
                );

            $text = 'Noelia Sirvio';

            $numero = (float)$request->tell;

            $phones = array
            (
            // Country Number + Phone Number
            $numero,  // Phone1
            );

            $is_unicode = true;

            $api->send($text, $phones, $is_unicode);
            
        } catch (\Exception $e) {
            echo "No se puede enviar mensajes porque no tienes saldo suficiente. ".$e;
            return view('/home');
        }
    }
}
