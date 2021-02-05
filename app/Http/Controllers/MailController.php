<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Testmail;
use GuzzleHttp;
use Storage;
use App\Cita;
use DB;


class MailController extends Controller
{
    public function send($id){

        Cita::where('id',$id)->update(['estado'=> 'Confirmado']);
        
        return view('emails/correoconfirmado');
    }
    
}

