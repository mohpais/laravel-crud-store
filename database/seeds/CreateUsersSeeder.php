<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'fullname' => 'Admin',
                'username' => 'admin_store',
                'is_admin' => '1',
                'password' => bcrypt('123456'),
            ],
            [
                'fullname' => 'User',
                'username' => 'user_store',
                'is_admin' => '0',
                'password' => bcrypt('123456'),
            ],
            [
                'fullname' => 'Guest',
                'username' => 'guest_1',
                'is_admin' => '0',
                'password' => bcrypt('12345'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
