<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'      => 'Dev',
            'email'     => 'devkh@gmail.com',
            'password'  => Hash::make('devkh123'),
        ]);

        $donaturs = [
            ['name' => 'muzaki1', 'email' => 'muzaki1@gmail.com', 'password' => Hash::make('muzaki1')],
            ['name' => 'muzaki2', 'email' => 'muzaki2@gmail.com', 'password' => Hash::make('muzaki2')],
            ['name' => 'muzaki3', 'email' => 'muzaki3@gmail.com', 'password' => Hash::make('muzaki3')],
            ['name' => 'muzaki4', 'email' => 'muzaki4@gmail.com', 'password' => Hash::make('muzaki4')],
            ['name' => 'muzaki5', 'email' => 'muzaki5@gmail.com', 'password' => Hash::make('muzaki5')],
            ['name' => 'muzaki6', 'email' => 'muzaki6@gmail.com', 'password' => Hash::make('muzaki6')],
        ];

        foreach ($donaturs as  $value) {
            \App\Models\Donatur::create($value);
        }
    }
}
