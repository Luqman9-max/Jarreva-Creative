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
                'password' => Hash::make('luqman'),
            ],
            [
                'name' => 'Fajar',
                'email' => 'fajar@jarreva.com',
                'password' => Hash::make('fajar'),
            ],
            [
                'name' => 'Indra',
                'email' => 'indra@jarreva.com',
                'password' => Hash::make('indra'),
            ],
            [
                'name' => 'Renu',
                'email' => 'renu@jarreva.com',
                'password' => Hash::make('renu'),
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}
