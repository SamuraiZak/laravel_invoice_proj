<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Attachment;


class InvoiceCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Invoice $invoice) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS', 'default@example.com'), env('MAIL_FROM_NAME', 'Default Name')),
            subject: 'Invoice Issued',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        $this->invoice->load('project.client');

        return new Content(
            view: 'emails.email',
            with: [
                'clientName' => $this->invoice->project->client->name,
                'project_name' => $this->invoice->project_name,
                'hourly_rate' => $this->invoice->project->rate_per_hour,
                'total_hours' => $this->invoice->hours,
                'total' => $this->invoice->total,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {

        $this->invoice->load('project.client');
        $data = [
            'clientName' => $this->invoice->project->client->name,
            'issued_at' => $this->invoice->created_at,
            'project_name' => $this->invoice->project->name,
            'hourly_rate' => $this->invoice->project->rate_per_hour,
            'total_hours' => $this->invoice->hours,
            'total' => $this->invoice->total
        ];

        $pdf = Pdf::loadView('templatePDF.invoicePDF', $data);

        return [Attachment::fromData(fn() => $pdf->output(), 'invoice.pdf')
            ->withMime('application/pdf')];
    }
}
