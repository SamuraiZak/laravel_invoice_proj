<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function showProject($id){
        $project = Project::findOrFail($id);

        return view('project.showProject', ["project" => $project]);

    }
}
