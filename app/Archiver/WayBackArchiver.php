<?php

namespace App\Archiver;

use App\Models\Archive;
use App\Models\Source;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WayBackArchiver extends Archiver
{


    public function __construct(private Source $source)
    {
        $this->sendRequest()
            ->saveArchivedUrl();
    }

    private function saveArchivedUrl()
    {
        $archive = new Archive();
        $archive->source_id = $this->source->id;
        $archive->url = $this->linkToArchive();
        $archive->save();
        return $this;
    }

    private function linkToArchive(): string
    {
        $linkHeader = $this->response->headers()['link'][0];
        $links = explode(', <', $linkHeader);
        return explode('>; rel', last($links))[0];
    }

    private function sendRequest(): static
    {
        $this->response = Http::timeout(180)->get('https://web.archive.org/save/' . $this->source->url);
        return $this;
    }

}
