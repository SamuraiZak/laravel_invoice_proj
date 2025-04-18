<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $clients = Client::where('freelancer_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('freelancer.dashboard', ["clients" => $clients]);



        // $ninjas = Ninja::with('dojo')->orderBy('created_at', 'desc')->paginate(10);

        // return view('ninjas.index', ["ninjas" => $ninjas]);
    }
}
