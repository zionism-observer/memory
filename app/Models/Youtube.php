<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Youtube extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source_id',
        'youtube_id',
        'video',
        'title',
        'extension',
        'uploader',
        'uploader_url',
        'upload_date',
        'uploader_id',
        'channel',
        'channel_id',
        'channel_url',
        'channel_follower_count',
        'duration',
        'view_count',
        'like_count',
        'comment_count',
        'age_limit',
        'is_live',
        'format',
        'format_id',
        'format_note',
        'width',
        'height',
        'resolution',
        'tbr',
        'abr',
        'acodec',
        'asr',
        'vbr',
        'fps',
        'vcodec',
        'container',
        'filesize',
        'filesize_approx',
        'protocol',
        'epoch',
        'description',
        'stretched_ratio',
        'thumbnail',
        'quality',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'source_id' => 'integer',
        'upload_date' => 'datetime',
        'channel_follower_count' => 'integer',
        'duration' => 'float',
        'view_count' => 'integer',
        'like_count' => 'integer',
        'comment_count' => 'integer',
        'age_limit' => 'integer',
        'is_live' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'tbr' => 'float',
        'abr' => 'integer',
        'asr' => 'integer',
        'fps' => 'float',
        'filesize' => 'integer',
        'filesize_approx' => 'integer',
        'epoch' => 'integer',
        'stretched_ratio' => 'float',
        'quality' => 'integer',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }
}
