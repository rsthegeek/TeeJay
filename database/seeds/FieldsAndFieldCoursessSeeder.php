<?php

use Illuminate\Database\Seeder;
use App\Course;
use App\Field;

class FieldsAndFieldCoursessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create or retrive it field
        $field = Field::firstOrCreate([
            'slug' => 'IT',
            'title' => 'مهندسی فناوری اطلاعات',
        ]);

        $itCourseCodes = json_decode(file_get_contents(
            database_path('seeds/data/itCourses.json')
        ));;
        $itCourseCodes = array_unique($itCourseCodes);

        $courseIds = Course::whereIn('code', $itCourseCodes)->pluck('id');

        if ($diff = sizeof($itCourseCodes) - sizeof($courseIds) !== 0) {
            echo "\t Suplied couses has diffrenece with existings by " . $diff . "\n";
        }

        $field->courses()->sync($courseIds);
    }
}
