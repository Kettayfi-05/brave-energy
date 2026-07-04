<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();

            $table->string('site_name');

            $table->string('logo')->nullable();

            $table->string('favicon')->nullable();

            $table->string('email');

            $table->string('phone');

            $table->text('address');

            $table->string('facebook')->nullable();

            $table->string('instagram')->nullable();

            $table->string('linkedin')->nullable();

            $table->string('youtube')->nullable();

            $table->string('whatsapp')->nullable();

            $table->longText('about')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};