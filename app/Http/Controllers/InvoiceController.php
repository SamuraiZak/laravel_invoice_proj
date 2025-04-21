<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Project;

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

        $project->invoice()->create([$validated, "total" => $total]);

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


    public function markAsPaid(Invoice $invoice) {
        $invoice->isPaid=true;
        $invoice->save();
        $project = $invoice->project;

        return redirect()->route('show.project', ["project" => $project]);
    }

    public function markAsUnpaid(Invoice $invoice) {
        $invoice->isPaid = false;
        $invoice->save();
        $project = $invoice->project;

        return redirect()->route('show.project', ["project" => $project]);
    }
}
