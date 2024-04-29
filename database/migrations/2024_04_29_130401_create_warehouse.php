<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->ulid('id')->default(DB::raw('uuid_generate_v4()'))->primary();
            $table->string('name');
            $table->ulid('region_id');
            $table->ulid('district_id');
            $table->ulid('city_id');
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->longText('description')->nullable();
            $table->json('directions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse');
    }
};
