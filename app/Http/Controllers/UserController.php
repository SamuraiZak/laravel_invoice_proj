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
use Illuminate\Support\Facades\DB;

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


        // Number of projects
        $projectCount = Project::whereHas('client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();

        //Outstanding Invoices
        //'project.client' means go up the relationship chain from Invoice -> Project -> Client
        $outstandingInvoiceCount = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();




        return view('freelancer.dashboardClients', ["clients" => $clients], compact('monthlyIncome', 'numberOfClients', 'projectCount', 'outstandingInvoiceCount'));
    }

    public function indexProjects()
    {
        // $clients = Client::where('freelancer_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        $freelancer = Auth::user();
        $projects = Project::whereHas('client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->with('client')->orderBy('created_at', 'desc')->paginate(10);

        //Monthly Income
        $currentYearMonth = Carbon::now()->format('Y-m');


        $targetMonthIncome = Income::where('freelancer_id', $freelancer->id)->where('year_month', $currentYearMonth)->first();

        $monthlyIncome = 0;

        if ($targetMonthIncome) {
            $monthlyIncome = $targetMonthIncome->income;
        }

        //Number of Clients
        $numberOfClients = $freelancer->client->count();


        // Number of projects
        $projectCount = Project::whereHas('client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();

        //Outstanding Invoices
        //'project.client' means go up the relationship chain from Invoice -> Project -> Client
        $outstandingInvoiceCount = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();




        return view('freelancer.dashboardProjects', ["projects" => $projects], compact('monthlyIncome', 'numberOfClients', 'projectCount', 'outstandingInvoiceCount'));
    }


    public function indexInvoices()
    {

        $freelancer = Auth::user();
        $outStandingInvoices = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->with('project.client')->paginate(10);

        //Monthly Income
        $currentYearMonth = Carbon::now()->format('Y-m');


        $targetMonthIncome = Income::where('freelancer_id', $freelancer->id)->where('year_month', $currentYearMonth)->first();

        $monthlyIncome = 0;

        if ($targetMonthIncome) {
            $monthlyIncome = $targetMonthIncome->income;
        }

        //Number of Clients
        $numberOfClients = $freelancer->client->count();


        // Number of projects
        $projectCount = Project::whereHas('client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();

        //Outstanding Invoices
        //'project.client' means go up the relationship chain from Invoice -> Project -> Client
        $outstandingInvoiceCount = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();




        return view('freelancer.dashboardInvoices', ["outStandingInvoices" => $outStandingInvoices], compact('monthlyIncome', 'numberOfClients', 'projectCount', 'outstandingInvoiceCount'));
    }

    // ===============================================================
    //duplicate routes from InvoiceController managing deleting, marking invoices
    //where instead of redirecting back to the project page, we redirect to dashboard
    //Times running short, dont want to research a more elegant way doing this

    
    public function deleteInvoice(Invoice $invoice)
    {
        //Necessary Data to show on the dashboard

        $freelancer = Auth::user();
        $outStandingInvoices = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->with('project.client')->paginate(10);

        //Monthly Income
        $currentYearMonth = Carbon::now()->format('Y-m');


        $targetMonthIncome = Income::where('freelancer_id', $freelancer->id)->where('year_month', $currentYearMonth)->first();

        $monthlyIncome = 0;

        if ($targetMonthIncome) {
            $monthlyIncome = $targetMonthIncome->income;
        }

        //Number of Clients
        $numberOfClients = $freelancer->client->count();


        // Number of projects
        $projectCount = Project::whereHas('client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();

        //Outstanding Invoices
        //'project.client' means go up the relationship chain from Invoice -> Project -> Client
        $outstandingInvoiceCount = Invoice::where('isPaid', false)->whereHas('project.client', function ($query) use ($freelancer) {
            $query->where('freelancer_id', $freelancer->id);
        })->count();

        $deletingInvoice = true;
        $project = $invoice->project;
        return view('freelancer.dashboardInvoices', ["outStandingInvoices" => $outStandingInvoices], compact('monthlyIncome', 'numberOfClients', 'projectCount', 'outstandingInvoiceCount', 'deletingInvoice', 'invoice'));
    }

    public function destroyInvoice(Invoice $invoice)
    {

        $invoice->delete();

        return redirect()->route('show.dashboardInvoices');
    }

    public function markAsPaid(Invoice $invoice)
    {
        $project = $invoice->project;
        try {
            DB::transaction(function () use ($invoice) {
                //Set invoice as paid
                $invoice->isPaid = true;
                $invoice->save();


                //Logic to update the incomes table (to be displayed on the dashboard)
                $freelancer = $invoice->project->client->user;
                $invoiceYearMonth = Carbon::parse($invoice->updated_at)->format('Y-m');

                //query the income row with the same year and month
                $income = Income::where('year_month', $invoiceYearMonth)->where('freelancer_id', $freelancer->id)->first();

                // if income exist, add to it. If it doesnt, make new one 
                if ($income) {
                    $income->income += $invoice->total;
                    $income->save();
                } else {
                    // create new income row based on corresponding freelancer
                    $freelancer->income()->create(['income' => $invoice->total, 'year_month' => $invoiceYearMonth]);
                }
            });
            return redirect()->route('show.dashboardInvoices', ["project" => $project]);
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Failed to mark invoice as paid', $e->getMessage()]);
        }
    }

    public function markAsUnpaid(Invoice $invoice)
    {
        $project = $invoice->project;
        try {
            // if invoice marked paid last month, then marked as unpaid this month, potentially negative value profit?

            DB::transaction(function () use ($invoice) {
                //Set invoice as unpaid
                $invoice->isPaid = false;
                $invoice->save();


                //Logic to update the incomes table (to be displayed on the dashboard)
                $freelancer = $invoice->project->client->user;
                $invoiceYearMonth = Carbon::parse($invoice->updated_at)->format('Y-m');

                //query the income row with the same year and month
                $income = Income::where('year_month', $invoiceYearMonth)->where('freelancer_id', $freelancer->id)->first();

                // if income exist, add to it. If it doesnt, make new one 
                if ($income) {
                    $income->income -= $invoice->total;
                    $income->save();
                    Log::info('new income total: ', [$income->total]);
                } else {
                    // create new income row based on corresponding freelancer
                    Log::info('else statement is running for marking as unpaid');
                    $freelancer->income()->create(['income' => $invoice->total, 'year_month' => $invoiceYearMonth]);
                }
            });
            return redirect()->route('show.dashboardInvoices', ["project" => $project]);
        } catch (\Exception $e) {

            return back()->withErrors(['error' => 'Failed to mark invoice as paid', $e->getMessage()]);
        }
    }
}
