<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function showProject(Project $project)
    {
        $project->load(['invoice' => function ($invoiceQuery) {
            $invoiceQuery->orderBy('created_at', 'desc');
        }]);

        return view('project.showProject', ["project" => $project]);
    }

    public function add(Client $client)
    {
        $addingProject = true;
        return view('client.showClient', compact('addingProject', 'client'));
    }

    public function store(Request $request, Client $client)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:projects,name",
            "description" => "required|string|max:500",
            "rate_per_hour" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",
        ]);

        $client->project()->create($validated);

        return redirect()->route('show.client', ["client" => $client]);
    }

    // Editing stuff
    public function edit(Project $project)
    {
        $editing = true;
        return view('project.showProject', compact('project', 'editing'));
    }

    public function update(Project $project, Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:projects,name,{$project->id}",
            "description" => "required|string|max:500",
            "rate_per_hour" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/",
            "total_hours" => "numeric|regex:/^\d+(\.\d{1,2})?$/"
        ]);

        $project->update($validated);
        $project->save();

        return redirect()->route('show.project', ["project" => $project]);
    }


    // Deleting stuff
    public function delete(Project $project)
    {
        $deleting = true;
        return view('project.showProject', compact('project', 'deleting'));
    }

    public function destroy(Project $project)
    {
        $client = $project->client;


        $project->delete();

        return redirect()->route('show.client', ["client" => $client]);
    }
}
