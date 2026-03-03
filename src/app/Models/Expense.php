<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    //

    protected $with = ['user'];


    protected $fillable = [
        'colocation_id',
        'category_id',
        'user_id',
        'title',
        'amount',
        'expense_date',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSharedExpense()
    {
        $memberCount = $this->colocation->user->count();
        if ($memberCount === 0) {
            return 0;
        }

        return $this->amount / $memberCount;
    }

    public function settlement()
    {
        return $this->hasMany(Settlement::class);
    }
}
