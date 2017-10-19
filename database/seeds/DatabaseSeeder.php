<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClassesFirstTimeSeeder::class);
        $this->call(InsertITcourses::class);
        $this->call(FieldsAndFieldCoursessSeeder::class);
        $this->call(CreateTheFirstUser::class);
        $this->call(InsertCoursesTakenForFirstUser::class);
    }
}
