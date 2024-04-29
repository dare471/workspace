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
        Schema::create('products_catedory', function (Blueprint $table) {
            $table->ulid('id')->default(DB::raw('uuid_generate_v4()'))->primary();
            $table->string('name');
            $table->ulid('created_by');
            $table->ulid('updated_by');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_catedory');
    }
};
