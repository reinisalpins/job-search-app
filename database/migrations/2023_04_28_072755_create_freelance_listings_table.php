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
        Schema::create('freelance_listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id');
            $table->string('project_type');
            $table->string('budget');
            $table->text('description');
            $table->timestamps();

            $table->foreign('listing_id')->references('id')->on('listings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelance_listings');
    }
};
