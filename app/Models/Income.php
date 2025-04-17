<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['freelancer_id', 'income', 'month'];

    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;

    //relationships
    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
}
