<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardProperty extends Model
{
    use HasFactory;

    const STATUS = [
        'Pending' => 'Pending',
        'Failed' => 'Failed',
        'Incomplete/Invalid/Blur Document' => 'Incomplete/Invalid/Blur Document',
        'In Progress' => 'In Progress',
        'Printed' => 'Printed',
        'Ready' => 'Ready'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'card_id',
        'identity_no',
        'status',
        'expire_at',
        'printed_at',
    ];

    protected $casts = [
        'expire_at' => 'datetime',
        'printed_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    /**
     * A card document type has many card documents .
     * @return mixed
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

}
