<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name' => 'Admin',
            'last_name' => '123',
            'phone' => '1234567',
            'email' => 'admin@justhalaal.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
