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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Contact Us');
            $table->string('subtitle')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('intro_text')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('map_embed_code')->nullable();
            $table->json('office_hours')->nullable();
            $table->boolean('show_contact_form')->default(true);
            $table->string('form_title')->nullable();
            $table->text('form_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
