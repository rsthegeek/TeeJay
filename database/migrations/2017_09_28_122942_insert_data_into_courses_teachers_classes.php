<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataIntoCoursesTeachersClasses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $classes = json_decode(file_get_contents(
            database_path('migrations/data/classes.json')
        ));

        foreach ($classes as $class) {
            // check if course exist or not
            // check if teacher exist or not


            Course::create([
                'course_id' => $courseId,
                'teacher_id' => $teacherId,
                'code' => $class->code,
                'first_session' => $class->firstTime,
                'second_session' => $class->secondTime,
                'third_session' => $class->thirdTime,
                'exam_time' => $examTimeNo,
                'exam_date' => ,
                'remainingCap' => ,
                'boysCount' => ,
                'girlsCount' => ,
                'allowedGender' => ,
                'status15' => ,
                'status17' => ,
                'place' => ,
                'fromYear' => ,
                'toYear' => ,
                'field' => ,
            ]);
        }
        // jDateTime::toGregorian(1394, 2, 18) === [2015, 5, 7]
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
