<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tweet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Tweet>
     */
    public static $model = \App\Models\Tweet::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $with = ['source'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [

            ID::make()->sortable(),

            Textarea::make('Body')
                ->readonly()
                ->alwaysShow(),

            URL::make('URL', fn() => $this->source->url)
                ->readonly()
                ->displayUsing(fn() => $this->source->url),

            Text::make('Language', 'lang')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Client')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Twitter ID')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Likes')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Retweets')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Replies')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Created At')
                ->readonly()
                ->hideFromIndex(),

            HasMany::make('TweetMedias'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
