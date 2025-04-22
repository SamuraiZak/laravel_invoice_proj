<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invoice;

class PdfController extends Controller
{
    public function generatePdf(Invoice $invoice)
    {
        $invoice->with('project.client');
        $data = [
            'clientName' => $invoice->project->client->name,
            'issued_at' => $invoice->created_at,
            'project_name' => $invoice->project->name,
            'hourly_rate' => $invoice->project->rate_per_hour,
            'total_hours' => $invoice->hours,
            'total' => $invoice->total
        ]; 
        $pdf = Pdf::loadView('templatePDF.invoicePDF', $data);
        return $pdf->download('invoice.pdf');
    }
}
