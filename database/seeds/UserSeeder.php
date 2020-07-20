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
        User::truncate();
        $users = [
            ['name' => 'test1', 'email' => 'test@test1.com'],
            ['name' => 'test2', 'email' => 'test@test2.com'],
            ['name' => 'test3', 'email' => 'test@test3.com'],
        ];
        foreach ($users as $user) {
            $randomPassword = bin2hex(random_bytes($this->passLength));
            $user['password'] = Hash::make($randomPassword);
            User::create($user);
            echo "{$user['email']} - $randomPassword". PHP_EOL;
        }
    }
}
