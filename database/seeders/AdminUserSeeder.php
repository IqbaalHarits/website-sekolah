<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Change this password immediately in production.
        User::updateOrCreate(
            ['email' => 'admin@sekolah.test'],
            ['name' => 'Administrator', 'password' => 'password'],
        );
    }
}
