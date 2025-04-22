<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Invoice;
use App\Models\Project;

class UserController extends Controller
{
    //dashboard (default) list all client
    public function index()
    {
        $clients = Client::where('freelancer_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        //Monthly Income
        $currentYearMonth = Carbon::now()->format('Y-m');
        $freelancer = Auth::user();

        $targetMonthIncome = Income::where('freelancer_id', $freelancer->id)->where('year_month', $currentYearMonth)->first();

        $monthlyIncome = 0;

        if ($targetMonthIncome) {
            $monthlyIncome = $targetMonthIncome->income;
        }

        //Number of Clients
        $numberOfClients = $freelancer->client->count();
        Log::error('client count is: ' . $numberOfClients);

        // Number of projects
        $projectCount = Project::whereHas('client', function($query) use ($freelancer){
            $query->where('freelancer_id', $freelancer->id);
        })->count();

        //Outstanding Invoices
        //'project.client' means go up the relationship chain from Invoice -> Project -> Client
        $outstandingInvoiceCount = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();
        Log::error('unpaid invoice count is: ' . $outstandingInvoiceCount);



        return view('freelancer.dashboardClients', ["clients" => $clients], compact('monthlyIncome', 'numberOfClients', 'projectCount', 'outstandingInvoiceCount'));
    }
}
