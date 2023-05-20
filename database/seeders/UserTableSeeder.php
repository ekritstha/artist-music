<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@admin.com')->first();
        if(!$user) {
            User::create([
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('secret'),
                'phone' => 1,
                'gender' => 'm',
                'dob' => Carbon::createFromFormat('Y-m-d', '2000-01-01'),
                'address' => 'a'
            ]);
        }
    }
}
