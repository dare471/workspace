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
        Schema::create('contracts_detail', function (Blueprint $table) {
            $table->ulid('id')->default(DB::raw('uuid_generate_v4()'))->primary();
            $table->ulid('contract_id');
            $table->ulid('product_id');
            $table->float('count');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts_detail');
    }
};
