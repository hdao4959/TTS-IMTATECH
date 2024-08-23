<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert(
            [
                [
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => '11111111',
                    'description' => fake()->sentence(),
                    'role_id' => 5,
                    'is_active' => true
                ],
                [
                    'name' => 'client1',
                    'email' => 'client1@gmail.com',
                    'password' => '11111111',
                    'description' => fake()->sentence(),
                    'role_id' => 1,
                    'is_active' => true
                ],
                [
                    'name' => 'client2',
                    'email' => 'client2@gmail.com',
                    'password' => '11111111',
                    'description' => fake()->sentence(),
                    'role_id' => 1,
                    'is_active' => true
                ],
            ]
        );
    }
}
