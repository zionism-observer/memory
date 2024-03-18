<?php

namespace App\Archiver;

use App\Models\Source;
use App\Models\Tweet;
use App\Models\TweetMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TwitterArchiver extends Archiver
{

    private int $code;
    private array $tweetFromApi;
    private Tweet $tweet;

    public function __construct(private Source $source) {

        try {
            $this->validateUrl()
                ->getTweet()
                ->validateResponse()
                ->archiveTweet()
                ->archiveMedia();
        }
        catch (\Exception $e) {
            $this->error = $e->getCode() . ': ' . $e->getMessage();
        }
    }

    public static function isTwitter(string $url): bool
    {
        return Str::startsWith($url, ['https://twitter.com', 'https://x.com']);
    }

     private function archiveTweet(): static
    {
        $this->tweet = new Tweet();
        $this->hydrateTweet();
        $this->tweet->save();

        return $this;
    }

    private function hydrateTweet(): void
    {
        $this->tweet->source_id = $this->source->id;
        $this->tweet->body = $this->tweetFromApi['text'];
        $this->tweet->created_timestamp = $this->tweetFromApi['created_timestamp'];
        $this->tweet->lang = $this->tweetFromApi['lang'];
        $this->tweet->views = $this->tweetFromApi['views'];
        $this->tweet->client = $this->tweetFromApi['source'];
        $this->tweet->twitter_id = $this->tweetFromApi['id'];
        $this->tweet->likes = $this->tweetFromApi['likes'];
        $this->tweet->retweets = $this->tweetFromApi['retweets'];
        $this->tweet->replies = $this->tweetFromApi['replies'];
        $this->tweet->twitter_created_at = $this->tweetFromApi['created_at'];
    }

    private function archiveMedia()
    {
        if (! $this->hasMedia())
            return $this;

        foreach ($this->tweetFromApi['media']['all'] as $media) {

            if ($media['type'] === 'photo')
                $this->archivePhoto($media);
            elseif ($media['type'] === 'video')
                $this->archiveVideo($media);

        }

        return $this;
    }

    private function archiveVideo(array $mediaFromApi): static
    {
        $media = $this->newTweetMedia($mediaFromApi);
        $this->hydrateVideo($media, $mediaFromApi);
        $media->save();

        return $this;
    }

    private function archivePhoto(array $mediaFromApi): static
    {
        $media = $this->newTweetMedia($mediaFromApi);
        $media->alt_text = $mediaFromApi['altText'];
        $media->save();

        return $this;
    }

    private function newTweetMedia(array $mediaFromApi): TweetMedia
    {
        $media = new TweetMedia();
        $this->hydrateSharedMediaFields($media, $mediaFromApi);
        return $media;
    }

    private function hydrateVideo(Model $media, array $mediaFromApi): void
    {
        $media->thumbnail_url = $mediaFromApi['thumbnail_url'];
        $media->duration = $mediaFromApi['duration'];
        $media->format = $mediaFromApi['format'];
    }

    private function hydrateSharedMediaFields(Model $media, array $mediaFromApi): void
    {
        $media->source_id = $this->source->id;
        $media->tweet_id = $this->tweet->id;
        $media->type = $mediaFromApi['type'];
        $media->url = $mediaFromApi['url'];
        $media->width = $mediaFromApi['width'];
        $media->height = $mediaFromApi['height'];
    }

    private function getTweet(): static
    {
        $this->response = Http::get($this->twitterArchivalUrl());
        $this->code = $this->response->json()['code'];
        $this->tweetFromApi = $this->response->json()['tweet'];

        return $this;
    }

    private function hasMedia(): bool
    {
        return isset($this->tweetFromApi['media']);
    }

    private function validateUrl(): static
    {
        $this->url = $this->source->url;

        if (! self::isTwitter($this->url))
            throw new \Exception('Attempted to archive a non-twitter URL with TwitterArchiver');

        return $this;
    }

    private function validateResponse(): static
    {
        if ($this->code != 200)
            throw new \Exception("Received invalid response ($this->code) from Twitter, can not get tweet");

        return $this;
    }

    private function twitterArchivalUrl()
    {
        return 'https://api.fxtwitter.com/' . $this->twitterPath();
    }

    private function twitterPath()
    {
        return Str::remove(['https://' , 'twitter.com/', 'x.com/'], $this->url);
    }

}
