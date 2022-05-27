<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class IdCardDocument extends Resource
{
    public static $group = 'Card';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\CardDocument::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
//    public static $title = 'name';

    public function title()
    {
        return "{$this->card->user->first_name} card document for card (id: {$this->card->id})";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'slug'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Card','card',IdCard::class),

            NovaBelongsToDepend::make('Card Type', 'cardType', IdCardType::class)
                ->placeholder('Select Card Type')
                ->options(\App\Models\CardType::all()),

            NovaBelongsToDepend::make('Card Document Type', 'cardDocumentType', IdCardDocumentType::class)
                ->placeholder('Select Card Document Type')
                ->optionsResolve(function ($type) {
                    return $type->cardDocumentTypes()->get(['id','name']);
                })
                ->dependsOn('cardType'),

            Text::make('Name', 'name')->sortable()->rules('required', 'max:255'),

            Text::make('Slug', 'slug')->readonly(),

            Image::make('File','file')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
