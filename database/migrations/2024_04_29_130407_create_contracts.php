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
        Schema::create('contracts', function (Blueprint $table) {
            $table->ulid('id')->default(DB::raw('uuid_generate_v4()'))->primary();
            $table->string('contract_number');
            $table->ulid('contract_type_id');
            $table->string('contract_name');
            $table->dateTime('contract_date');
            $table->dateTime('contract_due_date')->nullable();
            $table->string('contract_status');
            $table->ulid('contract_client_id');
            $table->ulid('contract_created_by');
            $table->ulid('contract_updated_by');
            $table->float('contract_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
