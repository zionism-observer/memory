<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class WebPage extends Resource
{
    public static $model = \App\Models\WebPage::class;
    public static $title = 'id';
    public static $with = ['source'];

    public static $search = [
        'id',
        'source.url',
        'body',
    ];

    public function fields(NovaRequest $request)
    {
        return [

            ID::make()->sortable(),

            URL::make('URL' , fn() => $this->source->url)
                ->readonly(),

            Trix::make('Body'),

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
