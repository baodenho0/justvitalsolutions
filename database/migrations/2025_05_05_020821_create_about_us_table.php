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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('About Us');
            $table->string('subtitle')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('section1_title')->nullable();
            $table->text('section1_content')->nullable();
            $table->string('section2_title')->nullable();
            $table->text('section2_content')->nullable();
            $table->json('skills')->nullable();
            $table->json('team_members')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
