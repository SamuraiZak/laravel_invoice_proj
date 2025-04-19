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


        return view('freelancer.dashboardClients', ["clients" => $clients]);



        // $ninjas = Ninja::with('dojo')->orderBy('created_at', 'desc')->paginate(10);

        // return view('ninjas.index', ["ninjas" => $ninjas]);
    }

    //The Add New client button on the dashboard
    public function addClient(Request $request) {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:clients,email",
            "phone" => "required|string|min:8|max:20",
            "company" => "nullable|string|max:255",
            "address" => "nullable|string|max:500"
        ]);

        $validated['freelancer_id'] = Auth::user()->id;

        Client::create($validated);

        return redirect()->back();

    }
}
