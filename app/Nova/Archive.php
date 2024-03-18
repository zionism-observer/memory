<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Archive extends Resource
{
    public static $model = \App\Models\Archive::class;
    public static $title = 'id';
    public static $with = ['source'];

    public static $search = [
        'id',
        'source.url',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            URL::make('Original', fn() => $this->source->url)
                ->readonly(),

            URL::make('Archive', fn() => $this->url)
                ->readonly(),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
}
