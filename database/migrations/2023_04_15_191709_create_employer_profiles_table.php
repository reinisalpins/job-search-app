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
        Schema::create('employer_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auth_id');
            $table->string('company_name');
            $table->string('company_website')->nullable();
            $table->string('company_logo')->nullable();
            $table->text('company_description')->nullable();
            $table->timestamps();

            $table->foreign('auth_id')
                ->references('id')
                ->on('employers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_profiles');
    }
};
