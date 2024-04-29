<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ref\region\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Schema\Schema;
use Faker\Factory;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create('ru_RU');  // Используем российский локаль для данных
        $contacts = [];

        for ($i = 0; $i < 14; $i++) {
            $contacts[] = [
                'phone' => '+7' . $faker->numerify('##########'), // Генерация телефонного номера
                'last_name' => $faker->lastName, // Генерация фамилии
                'name' => $faker->firstName, // Генерация имени
                'email' => $faker->email, // Генерация электронной почты
                'bin' => $faker->numerify('############'), // Генерация BIN (12 цифр)
                'service_id' => '5d383bcf-19c8-495a-8d7e-9611127c3d34',
                'birthday' => $faker->date('Y-m-d', '2000-01-01') // Генерация даты рождения (до 2000 года)
            ];
        }
        foreach ($contacts as $user){
            Client::create($user);
        }

    }
}
