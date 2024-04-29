<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Corrected array definition
        $services = [
            ['name' => 'Агро-Сервис', 'description' => 'Услуги в аграрном секторе'],
            ['name' => 'Покупатель', 'description' => 'Сервисы для покупателей'],
            ['name' => 'Трейдинг', 'description' => 'Торговые операции'],
            ['name' => 'Консультация', 'description' => 'Консультационные услуги']
        ];


        foreach ($services as $name) {
            Service::create($name);
        }
    }
}
