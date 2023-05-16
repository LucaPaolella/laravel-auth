<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'title' => 'Project 1',
            'description' => 'Description of Project 1'
        ]);
    
        Project::create([
            'title' => 'Project 2',
            'description' => 'Description of Project 2'
        ]);
    }
}
