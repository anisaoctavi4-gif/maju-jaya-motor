<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@majujayamotor.com',
            ],
            [
                'name' => 'Admin Maju Jaya Motor',
                'password' => Hash::make('admin12345'),
            ]
        );
    }
}