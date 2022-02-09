<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'Admin',
                'email' => 'admin@medexbank.com',
                'is_admin' => '1',
                'password' => bcrypt('Admin@#123'),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@medexbank.com',
                'is_admin' => '0',
                'password' => bcrypt('User@#123'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
