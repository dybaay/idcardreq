<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CardDocumentType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'card_type_id',
    ];

    /**
     * A card document type has many card documents .
     * @return mixed
     */
    public function cardDocuments()
    {
        return $this->hasMany(CardDocument::class);
    }

    /**
     * @return BelongsTo
     */
    public function cardType(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }


}
