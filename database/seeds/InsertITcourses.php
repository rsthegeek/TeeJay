<?php

use App\Course;
use Illuminate\Database\Seeder;

class InsertITcourses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ITcourses = json_decode(file_get_contents(
            database_path('seeds/data/it_course_full_data.json')
        ));

//        $ITcourses = array_map(function ($course) {
//            $course->title = perentesisFix(ar2fa($course->title));
//            return (array) $course;
//        }, $ITcourses);

        // Find Or Create Course
        foreach ($ITcourses as $course) {
            $course->title = perentesisFix(ar2fa($course->title));
            if (!Course::whereCode($course->code)->value('id')) {
                Course::create((array)$course);
            }
        }
    }
}
