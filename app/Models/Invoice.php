<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['project_id', 'total', 'isPaid', 'hours'];

    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
