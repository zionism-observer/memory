<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id' => 'string',
        'source_id' => 'integer',
        'upload_date' => 'datetime',
        'duration' => 'float',
        'tbr' => 'float',
        'abr' => 'float',
        'fps' => 'float',
        'stretched_ratio' => 'float',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }
}
