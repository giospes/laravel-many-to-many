<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Type A'],
            ['name' => 'Type B'],
            ['name' => 'Type C'],
            // Add more type data as needed
        ];

        DB::table('types')->insert($types);
    }
}
