<?php

namespace App\Console\Commands;

use App\Archiver\Archiver;
use App\Archiver\TwitterArchiver;
use App\Archiver\WebPageArchiver;
use App\Models\Source;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class Remember extends Command
{
    protected $signature = 'app:remember {url}';
    protected $description = 'Archives web pages, tweets, etc.';

    private string $url;
    private Source $source;
    private Archiver $archiver;

    public function handle()
    {
        if ($this->isReadyToArchive())
            $this->remember();
    }

    private function remember()
    {
        $this->info("remembering $this->url");
        $this->source = Source::create(['url' => $this->url]);
        $this->archiver = $this->archiver();

        if ($this->archiver->failed())
            $this->error('Failed');
        else
            $this->info("$this->url archived. Source ID: " . $this->source->id);
    }

    private function isReadyToArchive()
    {
        $this->url = $this->argument('url');
        return
            $this->urlIsValid()
            &&
            $this->sourceDoesNotExist();

    }

    private function sourceDoesNotExist(): bool
    {
        $this->info('source does not exist? ' . ! Source::where('url', $this->url)->exists());
        return ! Source::where('url', $this->url)->exists();
    }

    private function urlIsValid(): bool
    {
        $this->info('valid url? ' . filter_var($this->url, FILTER_VALIDATE_URL));
        return filter_var($this->url, FILTER_VALIDATE_URL);
    }

    private function archiver()
    {
        if (TwitterArchiver::isTwitter($this->url))
            return new TwitterArchiver($this->source);
        else
            return new WebPageArchiver($this->source);
    }

}
