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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->foreignId('source_id');
            $table->unsignedInteger('created_timestamp');
            $table->string('lang')->nullable();
            $table->unsignedInteger('views');
            $table->string('client')->nullable();
            $table->string('twitter_id');
            $table->unsignedInteger('likes');
            $table->unsignedInteger('retweets');
            $table->unsignedInteger('replies');
            $table->string('twitter_created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};
