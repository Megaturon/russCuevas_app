<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@russcuevas.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('adminpassword123'),
                'is_admin' => true,
                'contact' => 'N/A',
                'address' => 'N/A'
            ]
        );
    }
}
