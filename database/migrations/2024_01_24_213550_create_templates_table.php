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
        Schema::create('templatess', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('csv_file')->nullable();
            $table->string('font_family')->nullable();
            $table->string('text_effect')->nullable();
            $table->longText('template')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
