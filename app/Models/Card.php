<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'card_type_id',
        'faculty_id',
        'department_id'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * A card belongs to a card type
     *
     * @return mixed
     */
    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    /**
     * A card has many card property
     *
     * @return mixed
     */
    public function cardProperty()
    {
        return $this->hasOne(CardProperty::class);
    }

    /**
     * A card has many card documents
     *
     * @return mixed
     */
    public function cardDocuments()
    {
        return $this->hasMany(CardDocument::class);
    }

    /**
     * A card has one transaction
     *
     * @return mixed
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderByDesc('created_at');
    }

    /**
     * A card belongs to a faculty
     *
     * @return mixed
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * A card belongs to a department
     *
     * @return mixed
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
