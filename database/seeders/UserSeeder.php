<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'admin',
            'name' => 'Alan Pratama Rusfi',
            'nis' => '02219',
            'telephone' => '085817000942',
            'email' => 'alan@gmail.com',
            'password' => bcrypt('lanlan'),
            'class' => 'XII-RPL',
            'photo' => null,
        ]);
    }
}
