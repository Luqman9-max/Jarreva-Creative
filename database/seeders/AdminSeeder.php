<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    // Data admin untuk development
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Luqman',
                'email' => 'luqman@jarreva.com',
                'password' => 'luqman',
            ],
            [
                'name' => 'Fajar',
                'email' => 'fajar@jarreva.com',
                'password' => 'fajar',
            ],
            [
                'name' => 'Indra',
                'email' => 'indra@jarreva.com',
                'password' => 'indra',
            ],
            [
                'name' => 'Renu',
                'email' => 'renu@jarreva.com',
                'password' => 'renu',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(['email' => $admin['email']], $admin);
        }
    }
}
