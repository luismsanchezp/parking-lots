<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
        'name' => 'Luis',
        'surname' => 'Sanchez',
        'email' => 'fuzzyj@gmail.com',
        'password' => Hash::make('vienna22*'),
        'id_type' => 'C.C.',
        'gov_id' => '1005027212',
        'phone_number' => '3148381987'
        ]);
    }
}
