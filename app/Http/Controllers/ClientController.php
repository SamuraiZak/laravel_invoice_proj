<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    //function to show client on click from list
    public function showClient($id){
        $client = Client::findOrFail($id);
        return view('client.showClient', ["client" => $client]);

    }
}
