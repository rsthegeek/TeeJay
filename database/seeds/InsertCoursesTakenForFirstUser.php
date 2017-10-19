<?php

use App\Course;
use Illuminate\Database\Seeder;

class InsertCoursesTakenForFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coursesTaken = json_decode(file_get_contents(
            database_path('seeds/data/coursesTaken.json')
        ));

//        dd($coursesTaken);
        foreach ($coursesTaken as $taken) {
            // Find Or Create Course
            $course = Course::whereCode($taken->course_code)->first();
            if (!$course) {
                echo $taken->course_code;
            } else {
                $course->studentsTakenThis()->attach(
                    1,
                    [
                        'score' => $taken->score,
                        'description' => $taken->description,
                    ]
                );
            }
        }
    }
}
