<?php

namespace App\Archiver;

use App\Models\Source;
use App\Models\Tweet;
use App\Models\TweetMedia;
use App\Models\WebPage;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WebPageArchiver extends Archiver
{

    private WebPage $webPage;

    public function __construct(private Source $source) {

        try {
            $this->getWebPage()
                ->validateResponse()
                ->archiveWebPage();
        }
        catch (\Exception $e) {
            $this->error = $e->getCode() . ': ' . $e->getMessage();
        }
    }

    private function getWebPage()
    {
        $this->response = Http::get($this->source->url);
        return $this;
    }
     private function archiveWebPage(): static
    {
        $this->webPage = new WebPage();
        $this->hydrateWebPage();
        $this->webPage->save();

        return $this;
    }

    private function hydrateWebPage()
    {
        $this->webPage->source_id = $this->source->id;
        $this->webPage->body = $this->response->body();
        $this->webPage->status = $this->response->status();
        $this->webPage->headers = json_encode($this->response->headers(), JSON_PRETTY_PRINT);
    }

    private function validateResponse(): static
    {
        if ($this->response->status() != 200)
            throw new \Exception('Received invalid response from website(' . $this->response->status() . ') , can not get tweet');

        return $this;
    }

}
