<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class IdCard extends Resource
{
    public static $group = 'Card';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Card::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
//    public static $title = 'user';
    public function title()
    {
        return "{$this->user->first_name} card (type: {$this->cardType->name}, id: {$this->id}) for {$this->faculty->name} ({$this->department->name})";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['id'];

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

            BelongsTo::make('User','user',User::class),

            NovaBelongsToDepend::make('Faculty')
                ->placeholder('Select Faculty')
                ->options(\App\Models\Faculty::all()),

            NovaBelongsToDepend::make('Department')
                ->placeholder('Select Department')
                ->optionsResolve(function ($query) {
                    return $query->departments()->get(['id','name']);
                })
                ->dependsOn('Faculty'),

            BelongsTo::make('Card Type','cardType', IdCardType::class),

            HasOne::make('Card Property','cardProperty',IdCardProperty::class),

            HasMany::make('Documents', 'cardDocuments', IdCardDocument::class)
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
