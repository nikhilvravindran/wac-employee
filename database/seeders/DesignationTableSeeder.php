<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;
use Illuminate\Support\Facades\Schema;


class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Designation::truncate();

        $designation =  [
            [
              'designation' => 'Computer Scientist',
            ],
            [
              'designation' => 'UX Designer & UI Developer',
            ],
            [
              'designation' => 'Project Admin',
            ],
            [
              'designation' => 'Web Developer',
            ],
            [
              'designation' => 'Web Designer',
            ],
            [
              'designation' => 'DevOps Engineer',
            ],
            [
              'designation' => 'Cloud Architect',
            ],
            [
              'designation' => 'Data Entry',
            ],
          ];

          Designation::insert($designation);
    }
}
