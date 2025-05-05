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
        Schema::create('landing_page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('section_type')->default('default'); // hero, features, testimonials, etc.
            $table->json('extra_data')->nullable(); // For additional data specific to section types
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_page_sections');
    }
};
