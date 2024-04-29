<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->ulid('id')->default(DB::raw('uuid_generate_v4()'))->primary();
            $table->ulid('contract_id');
            $table->foreign('contract_id')->references('id')->on('contracts')->cascadeOnDelete();
            $table->ulid('route_id');
            $table->ulid('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouse')->cascadeOnDelete();
            $table->float('price');
            $table->ulid('courier_id')->nullable();
            $table->ulid('transport_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
