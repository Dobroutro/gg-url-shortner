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
        DB::table('users')->insert([
            'name' => 'Tester',
            'email' => 'tester@test.com',
            'password' => '$2y$10$e3xrC9ynnfMQkNghPKW8b.bRw5LgjKeoL2rS5BdWdf47myL/8NrkC',
            'api_token' => 'aRVIU4E6JQ1cDK2YCJjiUzEwu5QvTsXmELTHgZqzR6qJ1esyHWX7FMKc8pm1',
        ]);
    }
}
