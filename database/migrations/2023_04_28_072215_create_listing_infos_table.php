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
        Schema::create('listing_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->enum('employment_type', ['full_time', 'part_time']);
            $table->string('salary_range');
            $table->longText('description');
            $table->timestamps();

            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_infos');
    }
};
