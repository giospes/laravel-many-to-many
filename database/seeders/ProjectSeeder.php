<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\User;

class ProjectSeeder extends Seeder
{
   
    public function run()
    {
        $userIds = User::pluck('id');

        $projects = config('projects.projects');
        foreach($projects as $project){
            $newProject = new Project();   
            $newProject->name = $project['name'];
            $newProject->description = $project['description'];
            $newProject->user_id = $userIds->random();
            $newProject->created_at = $project['created_at'];
            $newProject->updated_at = $project['updated_at'];
            $newProject->slug = Str::slug($project['name']);
            $newProject->save();
        }
    }
}
