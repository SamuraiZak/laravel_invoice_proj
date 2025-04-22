<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['freelancer_id', 'income', 'year_month'];

    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;

    //relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
