<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\Income;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceCreated;


class InvoiceController extends Controller
{

    public function add(Project $project)
    {
        $addingInvoice = true;
        return view('project.showProject', compact('addingInvoice', 'project'));
    }

    public function store(Project $project, Request $request)
    {
        $total = $project->rate_per_hour * $request->hours;

        $validated = $request->validate(["hours" => "required|numeric|regex:/^\d+(\.\d{1,2})?$/"]);

        $invoice = $project->invoice()->create(array_merge($validated, ["total" => $total]));






        Mail::to($project->client->email)->send(new InvoiceCreated($invoice));
        // try {
        //     $project->load('client');
        //     $data = [
        //         'clientName' => $project->client->name,
        //         'project_name' => $project->name,
        //         'hourly_rate' => $project->rate_per_hour,
        //         'total_hours' => $invoice->hours,
        //         'total' => $invoice->total,
        //     ];

        //     // Send the email directly without using a Mailable
        //     Mail::send('emails.email', $data, function ($message) use ($project) {
        //         $message->to($project->client->email)
        //             ->subject('Invoice Issued')
        //             ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        //     });

        //     // Log success
        //     Log::info("Invoice email sent to: " . $project->client->email);
        // } catch (\Exception $e) {
        //     // Log failure
        //     Log::error("Failed to send invoice email: " . $e->getMessage());
        // }

        return redirect()->route('show.project', ["project" => $project]);
    }

    public function delete(Invoice $invoice)
    {
        $deletingInvoice = true;
        $project = $invoice->project;
        return view('project.showProject', compact('invoice', 'project', 'deletingInvoice'));
    }

    public function destroy(Invoice $invoice)
    {
        $project = $invoice->project;

        $invoice->delete();

        return redirect()->route('show.project', ["project" => $project]);
    }

    //$yearMonth = Carbon::now()->format('Y-m');  = example, "2025-04"
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
            return redirect()->route('show.project', ["project" => $project]);
        } catch (\Exception $e) {
            Log::error('Invoice markAsPaid failed: ' . $e->getMessage());
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
            return redirect()->route('show.project', ["project" => $project]);
        } catch (\Exception $e) {
            Log::error('Invoice markAsPaid failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to mark invoice as paid', $e->getMessage()]);
        }
    }
}
