<?php

namespace App\Nova\Actions;

use App\Jobs\WayBackJob;
use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class WayBack extends Action implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $source)
            $this->handleSource($source);
    }

    private function handleSource(Source $source)
    {
        WayBackJob::dispatch($source);
//        \Artisan::call("app:way-back-machine $source->id");
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
