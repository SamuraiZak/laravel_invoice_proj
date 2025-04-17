<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    protected $fillable = ['username', 'password'];

    /** @use HasFactory<\Database\Factories\FreelancerFactory> */
    use HasFactory;

    //relationships
    public function client()
    {
        return $this->hasMany(Client::class);
    }

    public function income()
    {
        return $this->hasMany(Income::class);
    }
}
