<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'angga',
            'last_name' => 'gumilang',
            'email' => 'angga@gmail.com',
            'password' => bcrypt('123'),
            'is_admin' => true,
        ]);
    }
}
