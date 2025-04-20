<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //dashboard (default) list all client
    public function index()
    {
        $clients = Client::where('freelancer_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);


        return view('freelancer.dashboardClients', ["clients" => $clients]);
    }

    public function exitForm(){
        return redirect()->back();
    }

   
}
