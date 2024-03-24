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
            $table->string('id')->primary();
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
            $table->string('channel_follower_count')->nullable();
            $table->float('duration');
            $table->string('view_count')->nullable();
            $table->string('like_count')->nullable();
            $table->string('comment_count')->nullable();
            $table->string('age_limit')->nullable();
            $table->string('is_live')->nullable();
            $table->string('format');
            $table->string('format_id')->nullable();
            $table->string('format_note')->nullable();
            $table->string('width');
            $table->string('height');
            $table->string('resolution');
            $table->float('tbr')->nullable();
            $table->float('abr')->nullable();
            $table->string('acodec')->nullable();
            $table->string('asr')->nullable();
            $table->string('vbr')->nullable();
            $table->float('fps')->nullable();
            $table->string('vcodec')->nullable();
            $table->string('container')->nullable();
            $table->string('filesize')->nullable();
            $table->string('filesize_approx')->nullable();
            $table->string('protocol')->nullable();
            $table->string('epoch')->nullable();
            $table->text('description')->nullable();
            $table->float('stretched_ratio')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('quality')->nullable();
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
