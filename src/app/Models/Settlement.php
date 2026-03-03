<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    //

    protected $fillable = [
        'colocation_id',
        'from_user',
        'to_user',
        'amount',
        'status',
        'paid_at'
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    public function creditor()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user'); // foreign key in settlements table
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user'); // foreign key in settlements table
    }
}
