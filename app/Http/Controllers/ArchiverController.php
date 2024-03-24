<?php

namespace App\Http\Controllers;

use App\Archiver\TwitterArchiver;
use App\Archiver\YoutubeArchiver;
use App\Archiver\WebPageArchiver;
use App\Models\Source;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ArchiverController extends Controller
{
    private string $url;
    private Source $source;

    public function __invoke(Request $request)
    {
        $this->ensureValidUrl($request); 
        $this->url = $request->input('url');
        $this->source = Source::create(['url' => $this->url]);
        return $this->archive();
    }

    private function archive()
    {
        $archiver = $this->archiver();

        if ($archiver->failed())
            return '';

        return $this->source->id;
    }

    private function archiver()
    {
        if (TwitterArchiver::isTwitter($this->url))
            return new TwitterArchiver($this->source);
        elseif (YoutubeArchiver::isYoutube($this->url))
            return new YoutubeArchiver($this->source);
        else
            return new WebPageArchiver($this->source);
    }

    private function ensureValidUrl(Request $request)
    {
        if (! $request->input('url'))
            throw new \Exception('Missing required parameter: url');
        if (! Str::startsWith($request->input('url'), ['http://', 'https://']))
            throw new \Exception('Invalid URL protocol, must start with http or https.');
    }

}
