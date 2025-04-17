<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['freelancer_id', 'name', 'email', 'phone', 'company', 'address'];

    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;


    //relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'client_id');
    }
}
