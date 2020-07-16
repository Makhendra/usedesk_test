<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    private $passLength = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'test', 'email' => 'test@test.com']
        ];
        foreach ($users as $user) {
            $randomPassword = bin2hex(random_bytes($this->passLength));
            $user['password'] = Hash::make($randomPassword);
            User::create($user);
            echo "{$user['email']} - $randomPassword". PHP_EOL;
        }
    }
}
