<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'alice',
                'email' => 'alice@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'bob',
                'email' => 'bob@gmail.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
