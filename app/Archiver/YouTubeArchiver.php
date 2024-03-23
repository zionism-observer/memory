<?php

namespace App\Archiver;

use App\Models\Source;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;
use Illuminate\Support\Facades\Storage;

class YouTubeArchiver extends Archiver
{
    private string $ytdlp_binary_url = "https://github.com/yt-dlp/yt-dlp/releases/latest/download/yt-dlp";
    private string $ytdlp_storage_path = "/dependencies/yt-dlp";
    private YoutubeDl $downloader;

    public function __construct(private Source $source) {

        try {
            $this->downloader = new YoutubeDl();
            $this->validateUrl()
                 ->ensureYtdlpPresent()
                 ->downloadVideo();
        }
        catch (\Exception $e) {
            $this->error = $e->getCode() . ': ' . $e->getMessage();
        }
    }

    private function validateUrl(): static
    {
        $this->url = $this->source->url;

        if (! self::isYouTube($this->url))
            throw new \Exception('Attempted to archive a non-YouTube URL with YoutubeArchiver');

        return $this;
    }

    public static function isYouTube(string $url): bool
    {
        return Str::startsWith($url, ['https://www.youtube.com']);
    }

    private function ensureYtdlpPresent(): static
    {
        if (!Storage::exists($this->ytdlp_storage_path)) {
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->ytdlp_binary_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new \Exception("Error downloading yt-dlp ");
            }
            curl_close($ch);

            Storage::disk('local')->put($this->ytdlp_storage_path, $result);
            chmod(Storage::disk('local')->path('/dependencies/yt-dlp'), 0700); 
        }
        return $this;
    }

    private function downloadVideo(): static
    {
        $this->downloader->setBinPath(Storage::disk('local')->path('/dependencies/yt-dlp'));

        $options = Options::create()
            ->downloadPath(Storage::disk('public')->path('sources/source-id/videos/')) //TODO: Add actual source id here after adding model
            ->url($this->url);
        
        $collection = $this->downloader->download($options);

        return $this;
    }
}
