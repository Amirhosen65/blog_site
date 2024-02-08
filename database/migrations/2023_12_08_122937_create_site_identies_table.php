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
        Schema::create('site_identies', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->string('favicon');
            $table->string('logo_white');
            $table->string('logo_dark');
            $table->string('footer');
            $table->string('about_image');
            $table->string('contact_image');
            $table->longText('contact_text');
            $table->longText('about_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_identies');
    }
};
