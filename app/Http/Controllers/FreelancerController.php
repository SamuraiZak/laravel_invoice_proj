<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function dashboard(){
        $freelancers = Freelancer::with('client')->orderBy('created_at', 'desc')->paginate(10);

        return view('freelancer.dashboard');
    }
}
