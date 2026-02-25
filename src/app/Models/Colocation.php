<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Membership;

class Colocation extends Model
{
    //

    protected $fillable = [
        'name',
        'owner_id',
        'status',
        'description'
    ];


    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function activeMembers()
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->wherePivot('status', 'active');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot('role', 'joined_at', 'left_at')
            ->withTimestamps();
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitaion::class);
    }
}
