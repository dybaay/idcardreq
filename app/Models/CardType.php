<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CardType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * A card document type has many cards .
     * @return mixed
     */
    public function cards()
    {
        return $this->hasMany(Card::class)->orderByDesc('created_at');
    }

    /**
     * @return HasMany
     */
    public function cardDocumentTypes(): HasMany
    {
        return $this->hasMany(CardDocumentType::class);
    }


}
