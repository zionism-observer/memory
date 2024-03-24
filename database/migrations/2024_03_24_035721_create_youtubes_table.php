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
            $table->id();
            $table->unsignedBigInteger('source_id');
            $table->string('youtube_id');
            $table->string('video');
            $table->string('title');
            $table->string('extension');
            $table->string('uploader');
            $table->string('uploader_url');
            $table->dateTime('upload_date');
            $table->string('uploader_id')->nullable();
            $table->string('channel');
            $table->string('channel_id')->nullable();
            $table->string('channel_url')->nullable();
            $table->unsignedInteger('channel_follower_count')->nullable();
            $table->float('duration');
            $table->unsignedInteger('view_count')->nullable();
            $table->unsignedInteger('like_count')->nullable();
            $table->unsignedInteger('comment_count')->nullable();
            $table->unsignedInteger('age_limit')->nullable();
            $table->boolean('is_live')->nullable();
            $table->string('format');
            $table->string('format_id')->nullable();
            $table->string('format_note')->nullable();
            $table->unsignedInteger('width');
            $table->unsignedInteger('height');
            $table->string('resolution');
            $table->float('tbr')->nullable();
            $table->unsignedInteger('abr')->nullable();
            $table->string('acodec')->nullable();
            $table->unsignedInteger('asr')->nullable();
            $table->string('vbr')->nullable();
            $table->float('fps')->nullable();
            $table->string('vcodec')->nullable();
            $table->string('container')->nullable();
            $table->unsignedInteger('filesize')->nullable();
            $table->unsignedInteger('filesize_approx')->nullable();
            $table->string('protocol')->nullable();
            $table->unsignedInteger('epoch')->nullable();
            $table->text('description')->nullable();
            $table->float('stretched_ratio')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedInteger('quality')->nullable();
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
