<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Core\Uuid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_id' => Str::uuid(),
                'name' => 'admin',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'phone_number' => '086969696969',
                'role' => 'ADMIN',
                'password' => bcrypt('admin1234'),
                'profile_picture' => 'https://via.placeholder.com/800x600',
                'id_photo' => 'ktp.jpg',
                'status' => 'ACTIVE',
                'about' => 'I am human'
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Joko',
                'email' => 'joko@gmail.com',
                'username' => 'Joko Kendil',
                'phone_number' => '081234567869',
                'role' => 'BUYER',
                'password' => bcrypt('joko1234'),
                'profile_picture' => 'https://via.placeholder.com/800x600',
                'id_photo' => 'ktp.jpg',
                'status' => 'ACTIVE',
                'about' => 'I am handsome'
            ],
            [
                'user_id' => Str::uuid(),
                'name' => 'Monyet',
                'email' => 'monyet@gmail.com',
                'username' => 'Monyet Kendil',
                'phone_number' => '08123712312',
                'role' => 'ARTIST',
                'password' => bcrypt('monyet1234'),
                'profile_picture' => 'https://via.placeholder.com/800x600',
                'id_photo' => 'ktp.jpg',
                'status' => 'ACTIVE',
                'about' => 'I am handsome'
            ],
        ]);
    }
}
