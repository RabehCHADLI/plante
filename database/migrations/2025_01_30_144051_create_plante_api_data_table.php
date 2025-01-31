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
        Schema::create('plante_api_data', function (Blueprint $table) {
            $table->id();
            $table->string('common_name');
            $table->json('scientific_name');
            $table->json('other_name')->nullable();
            $table->string('cycle');
            $table->string('watering');
            $table->json('sunlight');
            $table->json('default_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plante_api_data');
    }
};
