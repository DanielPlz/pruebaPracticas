<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function FAQ(){
        // $contacto = $request->input("")
        return view('faq.faq');
    }
}
