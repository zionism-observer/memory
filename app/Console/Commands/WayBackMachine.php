<?php

namespace App\Console\Commands;

use App\Archiver\WayBackArchiver;
use App\Models\Source;
use Illuminate\Console\Command;

class WayBackMachine extends Command
{
    protected $signature = 'app:way-back-machine {source}';
    protected $description = 'Archives a source url with Archive.org\'s WayBack Machine';

    private Source $source;
    private WayBackArchiver $archiver;

    public function handle()
    {
        $this->getSource()
            ->archive()
            ->recordArchivedUrl();
    }

    private function recordArchivedUrl()
    {

    }

    private function archive()
    {
        $this->archiver = new WayBackArchiver($this->source);
        return $this;
    }

    private function getSource()
    {
        $this->source = Source::find($this->argument('source'));
        return $this;
    }
}
