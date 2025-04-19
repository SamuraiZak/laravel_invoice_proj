<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    //function to show client on click from list
    public function showClient($id){
        $client = Client::with('project')->findOrFail($id);

        // echo $client->project;   turn this to json to see in terminal pls

        return view('client.showClient', ["client" => $client, "projects" => $client->project]);

    }

    public function showProject($id){

    }
}
