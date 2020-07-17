<?php

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\ClientEmail;
use App\Models\ClientPhone;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Client::truncate();
        ClientEmail::truncate();
        ClientPhone::truncate();
        DB::statement("SET foreign_key_checks=1");
        $count_clients = 15;
        $faker = Faker\Factory::create('ru_RU');

        for ($i = 0; $i < $count_clients; $i++) {
            $gender = rand(0, 1) ? 'male' : 'female';
            $client = Client::create(['name' => $faker->firstName($gender), 'last_name' => $faker->lastName($gender)]);
            $client_emails_count = rand(0, 3);
            $client_phones_count = rand(0, 3);

            if($client_emails_count) {
                $insertValues = [];
                for ($j = 0; $j < $client_emails_count; $j++) {
                    $insertValues[] = ['email' => $faker->freeEmail()];
                }
                $client->emails()->createMany($insertValues);
            }

            if($client_phones_count) {
                $insertValues = [];
                for ($k = 0; $k < $client_phones_count; $k++) {
                    $insertValues[] = ['phone' => $faker->phoneNumber];
                }
                $client->phones()->createMany($insertValues);
            }
        }
    }
}
