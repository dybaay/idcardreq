<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const STATUS = [
        'Pending' => 'Pending',
        'Failed' => 'Failed',
        'Successful' => 'Successful',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'card_id',
        'amount',
        'status',
        'payment_method',
        'reference',
        'description',
        'payment_proof',
    ];

    /**
     * A transaction belongs to a user
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A transaction belongs to a card
     * @return mixed
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

}
