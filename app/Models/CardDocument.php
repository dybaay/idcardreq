<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class CardDocument extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'card_id',
        'name',
        'file',
        'card_document_type_id',
        'card_type_id',
        'slug',
    ];

    /**
     * A card document belongs to a card document type.
     * @return mixed
     */
    public function cardDocumentType()
    {
        return $this->belongsTo(CardDocumentType::class);
    }

    /**
     * @return BelongsTo
     */
    public function cardType(): BelongsTo
    {
        return $this->belongsTo(CardType::class);
    }

    /**
     * A card document belongs to a card .
     * @return mixed
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model) {
            $model->slug = Str::slug(get_user_first_name().'_'.$model->name.'_'.Carbon::now()->toString());
        });
    }


}
