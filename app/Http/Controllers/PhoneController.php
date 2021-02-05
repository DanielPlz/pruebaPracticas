<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Authy\AuthyApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Twilio\Rest\Client;

class PhoneController extends Controller
{
    protected $authyApi;
    protected $client;
    public function __construct()
    {
        $this->middleware('auth');
        $this->authyApi = new AuthyApi(env('AUTHY_API_KEY'));
        $this->client = new Client(env('TWILIO_SID'),env('TWILIO_TOKEN'));

    }
    
}
