<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            'XII-RPL', 'XI-PPGL1', 'XI-PPLG2', 'X-PPLG1', 'X-PPLG2',
            'XII-MM', 'XI-DKV1', 'XI-DKV2', 'X-DKV1', 'X-DKV2',
            'XII-PFTV', 'XI-BCF1', 'XI-BCF2', 'X-BCF1', 'X-BCF2',
        ];

        foreach ($classes as $class) {
            DB::table('kelas')->insert([
                'name' => $class,
            ]);
        }
    }
}
