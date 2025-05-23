<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClientController extends Controller
{

    use AuthorizesRequests;

    //Show Client Detail
    public function showClient(Client $client)
    {

        $this->authorize('view', $client);

        $client->load(['project' => function ($projQuery) {
            $projQuery->orderBy('created_at', 'desc');
        }]);

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
            "email" => "required|email|max:255",
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
            "email" => "required|email|max:255|unique:clients,email,{$client->id}",
            "phone" => "required|string|min:8|max:20|regex:/^\+?[0-9]{8,20}$/",
            "company" => "nullable|string|max:255",
            "address" => "nullable|string|max:500"
        ]);

        $client->update($validated);
        $client->save();

        return redirect()->route('show.client', ["client" => $client]);
    }


    public function delete(Client $client)
    {
        $deleting = true;
        return view('client.showClient', compact('client', 'deleting'));
    }


    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('show.dashboard');
    }
}
