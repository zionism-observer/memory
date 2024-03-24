<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Youtube extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Youtube>
     */
    public static $model = \App\Models\Youtube::class;

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

            URL::make('URL', fn() => $this->source->url)
                ->readonly()
                ->displayUsing(fn() => $this->source->url),

            Number::make('Youtube ID')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Video')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Title')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Extension')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Uploader')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Uploader Url')
                ->readonly()
                ->hideFromIndex(),
            
            DateTime::make('Upload Date')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Uploader ID')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Channel')
                ->readonly()
                ->hideFromIndex(),
            
            Text::make('Channel ID')
                ->readonly()
                ->hideFromIndex(),
            
            Text::make('Channel Url')
                ->readonly()
                ->hideFromIndex(),
            
            Number::make('Channel Follower Count')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Duration')
                ->readonly()
                ->hideFromIndex(),

            Number::make('View Count')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Like Count')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Comment Count')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Age Limit')
                ->readonly()
                ->hideFromIndex(),

            Boolean::make('Is Live')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Format')
                ->readonly()
                ->hideFromIndex(),
            
            Text::make('Format ID')
                ->readonly()
                ->hideFromIndex(),
            
            Text::make('Format Note')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Width')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Height')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Resolution')
                ->readonly()
                ->hideFromIndex(),

            Number ::make('Tbr')
                ->readonly()
                ->hideFromIndex(),

            Number ::make('Abr')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Acodec')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Asr')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Vbr')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Fps')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Vcodec')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Container')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Filesize (bytes)')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Filesize Approx (bytes)', 'filesize_approx')
                ->readonly()
                ->hideFromIndex(),

            Text::make('Protocol')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Epoch')
                ->readonly()
                ->hideFromIndex(),

            Textarea::make('Description')
                ->readonly()
                ->alwaysShow(),

            Number::make('Streched Ratio')
                ->readonly()
                ->hideFromIndex(),
                
            Text::make('Thumbnail')
                ->readonly()
                ->hideFromIndex(),

            Number::make('Quality')
                ->readonly()
                ->hideFromIndex(),

            DateTime::make('Created At')
                ->readonly()
                ->hideFromIndex(),

            DateTime::make('Updated At')
                ->readonly()
                ->hideFromIndex(),
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
