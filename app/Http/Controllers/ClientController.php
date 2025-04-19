<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{

    //Show Client Detaail
    public function showClient($id){
        $client = Client::with('project')->findOrFail($id);

        // echo $client->project;   turn this to json to see in terminal pls

        return view('client.showClient', ["client" => $client, "projects" => $client->project]);

    }

    //When click on view project detail
    public function showProject($id){

    }

    
}
