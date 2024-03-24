<?php

namespace App\Archiver;

use App\Models\Source;
use App\Models\Youtube;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;
use YoutubeDl\Entity\Video;
use Illuminate\Support\Facades\Storage;

class YoutubeArchiver extends Archiver
{
    private string $binaryUrl = "https://github.com/yt-dlp/yt-dlp/releases/latest/download/yt-dlp";
    private string $binaryStoragePath = "/dependencies/yt-dlp";
    private string $videoPath;
    private YoutubeDl $downloader;
    private Video $videoFromYtdlp;
    private Youtube $youtube;

    public function __construct(private Source $source) {

        try {
            $this->downloader = new YoutubeDl();
            $this->validateUrl()
                 ->ensureYtdlpPresent()
                 ->getVideo()
                 ->archiveVideo();
        }
        catch (\Exception $e) {
            $this->error = $e->getCode() . ': ' . $e->getMessage();
        }
    }

    private function validateUrl(): static
    {
        $this->url = $this->source->url;

        if (! self::isYoutube($this->url))
            throw new \Exception('Attempted to archive a non-YouTube URL with YoutubeArchiver');

        return $this;
    }

    public static function isYoutube(string $url): bool
    {
        return Str::startsWith($url, ['https://www.youtube.com']);
    }

    private function ensureYtdlpPresent(): static
    {
        if (!Storage::exists($this->binaryStoragePath)) {
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->binaryUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new \Exception("Error downloading yt-dlp ");
            }
            curl_close($ch);

            Storage::disk('local')->put($this->binaryStoragePath, $result);
            chmod(Storage::disk('local')->path('/dependencies/yt-dlp'), 0700); 
        }
        return $this;
    }

    private function getVideo(): static
    {
        $this->videoPath = Storage::disk('public')->path('sources/' . $this->source->id. '/videos/');

        $this->downloader->setBinPath(Storage::disk('local')->path('/dependencies/yt-dlp'));
        $options = Options::create()
            ->downloadPath($this->videoPath)
            ->url($this->url)
            ->output('%(id)s.%(ext)s');
        
        $videos = $this->downloader->download($options)->getVideos();

        if(empty($videos)) 
            throw new \Exception("Unable to download YouTube video ($this->url)");
        elseif($videos[0]->getError())
            throw new \Exception("Error downloading video: {$videos[0]->getError()}.");

        $this->videoFromYtdlp = $videos[0];

        return $this;
    }

    private function archiveVideo(): static
    {
        $this->youtube = new Youtube();
        $this->hydrateVideo();
        $this->youtube->save();

        return $this;
    }

    private function hydrateVideo(): void
    {
        $this->youtube->source_id = $this->source->id;
        $this->youtube->youtube_id = $this->videoFromYtdlp->getId();
        $this->youtube->title = $this->videoFromYtdlp->getTitle();
        $this->youtube->extension = $this->videoFromYtdlp->getExt();
        $this->youtube->video = $this->videoPath . '' . $this->youtube->youtube_id . '.' . $this->youtube->extension;
        $this->youtube->uploader = $this->videoFromYtdlp->getUploader();
        $this->youtube->uploader_url = $this->videoFromYtdlp->getUploaderUrl();
        $this->youtube->upload_date = $this->videoFromYtdlp->getUploadDate();
        $this->youtube->uploader_id = $this->videoFromYtdlp->getUploaderId();
        $this->youtube->channel = $this->videoFromYtdlp->getChannel();
        $this->youtube->channel_id = $this->videoFromYtdlp->getChannelId();
        $this->youtube->channel_url = $this->videoFromYtdlp->getChannelUrl();
        $this->youtube->channel_follower_count = $this->videoFromYtdlp->getChannelFollowerCount();
        $this->youtube->duration = $this->videoFromYtdlp->getDuration();
        $this->youtube->view_count = $this->videoFromYtdlp->getViewCount();
        $this->youtube->like_count = $this->videoFromYtdlp->getLikeCount();
        $this->youtube->comment_count = $this->videoFromYtdlp->getCommentCount();
        $this->youtube->age_limit = $this->videoFromYtdlp->getAgeLimit();
        $this->youtube->is_live = $this->videoFromYtdlp->getIsLive();
        $this->youtube->format = $this->videoFromYtdlp->getFormat();
        $this->youtube->format_id = $this->videoFromYtdlp->getFormatId();
        $this->youtube->format_note = $this->videoFromYtdlp->getFormatNote();
        $this->youtube->width = $this->videoFromYtdlp->getWidth();
        $this->youtube->height = $this->videoFromYtdlp->getHeight();
        $this->youtube->resolution = $this->videoFromYtdlp->getResolution();
        $this->youtube->tbr = $this->videoFromYtdlp->getTbr();
        $this->youtube->abr = $this->videoFromYtdlp->getAbr();
        $this->youtube->acodec = $this->videoFromYtdlp->getAcodec();
        $this->youtube->asr = $this->videoFromYtdlp->getAsr();
        $this->youtube->vbr = $this->videoFromYtdlp->getVbr();
        $this->youtube->fps = $this->videoFromYtdlp->getFps();
        $this->youtube->vcodec = $this->videoFromYtdlp->getVcodec();
        $this->youtube->container = $this->videoFromYtdlp->getContainer();
        $this->youtube->filesize = $this->videoFromYtdlp->getFilesize();
        $this->youtube->filesize_approx = $this->videoFromYtdlp->getFilesizeApprox();
        $this->youtube->protocol = $this->videoFromYtdlp->getProtocol();
        $this->youtube->epoch = $this->videoFromYtdlp->getEpoch();
        $this->youtube->description = $this->videoFromYtdlp->getDescription();
        $this->youtube->stretched_ratio = $this->videoFromYtdlp->getStretchedRatio();
        $this->youtube->thumbnail = $this->videoFromYtdlp->get('thumbnail');
        $this->youtube->quality = $this->videoFromYtdlp->get('quality');
    }
}
