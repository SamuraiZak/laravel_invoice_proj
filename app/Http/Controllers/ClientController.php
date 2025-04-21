<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    //Show Client Detail
    public function showClient(Client $client)
    {
        $client->load('project');

        // echo $client->project;   turn this to json to see in terminal pls

        return view('client.showClient', ["client" => $client]);
    }

    //When click Add New Client button
    public function showAddClient()
    {
        return view('client.createClient');
    }

    // When submitting Client Creation Form
    public function addClient(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:clients,email",
            "phone" => "required|string|min:8|max:20",
            "company" => "nullable|string|max:255",
            "address" => "nullable|string|max:500"
        ]);

        $validated['freelancer_id'] = Auth::user()->id;

        Client::create($validated);

        return redirect()->route('show.dashboard');
    }


    public function edit(Client $client)
    {
        $editing = true;

        return view('client.showClient', compact('client', 'editing'));
    }


    public function update(Client $client, Request $request)
    {
        $validated = $request->validate([
            "email" => "required|email|max:255|unique:clients,email",
            "phone" => "required|string|min:8|max:20",
            "company" => "nullable|string|max:255",
            "address" => "nullable|string|max:500"
        ]);

        $client->update($validated);
        $client->save();

        return redirect()->route('show.client', ["client" => $client]);
    }



    public function destroy(Client $client){
        $deleting = true;
    }
}
