<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YouTube extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source_id',
        'video',
        'title',
        'resolution',
        'aspect_ratio',
        'filesize_approx',
        'like_count',
        'channel',
        'channel_follower_count',
        'channel_is_verified',
        'uploader',
        'uploader_id',
        'uploader_url',
        'upload_date',
        'availability',
        'duration_string',
        'is_live',
        'epoch',
        'asr',
        'format_id',
        'format_note',
        'source_preference',
        'audio_channels',
        'height',
        'width',
        'quality',
        'has_drm',
        'language',
        'extension',
        'vcodec',
        'acodec',
        'dynamic_range',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'upload_date' => 'timestamp',
    ];
}
