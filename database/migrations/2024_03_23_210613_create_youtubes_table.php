<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('youtubes', function (Blueprint $table) {
            $table->string('source_id');
            $table->string('id');
            $table->string('video');
            $table->string('title');
            $table->string('resolution');
            $table->string('aspect_ratio');
            $table->string('filesize_approx');
            $table->string('like_count');
            $table->string('channel');
            $table->string('channel_follower_count');
            $table->string('channel_is_verified');
            $table->string('uploader');
            $table->string('uploader_id');
            $table->string('uploader_url');
            $table->timestamp('upload_date');
            $table->string('availability');
            $table->string('duration_string');
            $table->string('is_live');
            $table->string('epoch');
            $table->string('asr');
            $table->string('format_id');
            $table->string('format_note');
            $table->string('source_preference');
            $table->string('audio_channels');
            $table->string('height');
            $table->string('width');
            $table->string('quality');
            $table->string('has_drm');
            $table->string('language');
            $table->string('extension');
            $table->string('vcodec');
            $table->string('acodec');
            $table->string('dynamic_range');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtubes');
    }
};
