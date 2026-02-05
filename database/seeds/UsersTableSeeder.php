<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        user::create([
         'name' => 'ユーザー１',
         'email' => 'user1@email.com',
         'password' => Hash::make('password1'),
        ]);
    }
}
