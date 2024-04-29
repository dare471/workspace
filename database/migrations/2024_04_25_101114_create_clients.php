<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('uuid_generate_v4()'))->primary(); // Assuming ULID is appropriately handled by your database system.
            $table->string('phone', 14)->comment('Номер телефона');
            $table->enum('status', ['interviewed', 'not_interviewed'])->default('interviewed')->comment('Статус');
            $table->enum('client_type', ['Физ.лицо', 'Холдинг','Крестьянское хозяйство'])->default('Крестьянское хозяйство')->comment('Тип клиента');
            $table->string('name')->nullable()->comment('Имя');
            $table->string('last_name')->nullable()->comment('Фамилия');
            $table->string('email')->unique()->nullable()->comment('Email');
            $table->string('bin')->unique()->comment('БИН/ИИН');
            $table->date('birthday')->nullable()->comment('Дата рождения');
            $table->uuid('region_id')->nullable()->comment('Область клиента');
            $table->uuid('district_id')->nullable()->comment('Район клиента');
            $table->mediumText('street')->nullable()->comment('Улица клиента');
            $table->string('building_number')->nullable()->comment('Номер дома');
            $table->uuid('service_id')->comment('Название оказанной услуги');
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('assesment')->nullable()->comment('Оценка качества');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
