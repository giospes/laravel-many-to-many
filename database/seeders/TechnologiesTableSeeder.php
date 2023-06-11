<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'JavaScript',
            ],
           
        ];

        foreach ($technologies as $technology) {
            $newTech = new Technology();
            $newTech->name = $technology['name'];
            $newTech->save();
        }
    }
}
