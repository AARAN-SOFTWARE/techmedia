<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'SUNDAR', 'email' => 'sundar@sundar.com', 'password' => 'kalarani'],
            ['name' => 'Vijay', 'email' => 'vijay@techmedia.in', 'password' => '123456789'],
            ['name' => 'tmuser', 'email' => 'tmuser@techmedia.in', 'password' => '123456789'],
        ];

        foreach ($users as $row) {
            $user = User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => bcrypt($row['password']),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
