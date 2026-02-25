<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitaion extends Model
{
    //


    protected $fillable = [
        'colocation_id',
        'email',
        'token',
        'status',
        'expires_at',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
