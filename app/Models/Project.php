<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = ['client_id', 'name', 'description', 'rate/hour', 'total hours'];
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    //relationships
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function invoice(){
        return $this->hasMany(Invoice::class, 'project_id');
    }
}
