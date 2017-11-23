<?php

use App\Venue;
use App\Course;
use App\Complex;
use App\Session;
use App\Teacher;
use App\UniClass;
use App\Helpers\Parse;
use App\Helpers\DaysOfWeek;
use Illuminate\Database\Seeder;
use App\Crawlers\ClassListCrawler;

class ClassesFirstTimeSeeder extends Seeder
{
    const SPACE = '    ';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $classes = json_decode(file_get_contents(
        //     database_path('seeds/data/classes.json')
        // ));
        $crawler = new ClassListCrawler();
        foreach (ClassListCrawler::$eduGroups as $id => $name) {
            $this->command->comment(self::SPACE. "EduGroup {$id} ({$name})");

            $this->command->info(self::SPACE.self::SPACE. 'Getting classes...');
            $classes = $crawler->crawl($id);

            $this->command->info(self::SPACE.self::SPACE. 'Inserting Data...');
            foreach ($classes as $class) {
                // Find Or Create Course
                $course = Course::firstOrCreate([
                    'code' => $class->courseCode,
                    'title' => perentesisFix(pureFa($class->name)),
                    'practical_unit_count' => $class->practical_unit_count,
                    'theoretical_unit_count' => $class->theoretical_unit_count,
                ]);

                // Find Or Create Teacher
                $teacherNameArray = explode('-', $class->teacherName);
                $teacherNameArray[0] = ar2fa($teacherNameArray[0]);
                $teacherNameArray[1] = ar2fa($teacherNameArray[1]);
                $teacher = Teacher::firstOrCreate([
                    'first_name' => $teacherNameArray[1],
                    'last_name' => $teacherNameArray[0],
                ]);

                // Find or Create Venue
                $venueDataArray = explode('-', $class->place);
                $venueDataArray[1] = pureFa($venueDataArray[1]);
                //Find or Create Complex
                $complex = Complex::firstOrCreate([
                    'title' => $venueDataArray[1],
                ]);
                $venue = Venue::firstOrCreate([
                    'complex_id' => $complex->id,
                    'code' => $venueDataArray[0] == '' ?
                        null : $venueDataArray[0],
                ]);

                // Create the f#$%!ng Class
                UniClass::create([
                    'course_id' => $course->id,
                    'teacher_id' => $teacher->id,
                    'code' => $class->code,

                    // 'first_session' => Parse::session2json($class->firstTime),
                    // 'second_session' => Parse::session2json($class->secondTime),
                    // 'third_session' => Parse::session2json($class->thirdTime),
                    'first_session_id' => $this->findOrCreateSession($class->firstTime),
                    'first_session_day' => $this->getDayNumber($class->firstTime),
                    'second_session_id' => $this->findOrCreateSession($class->secondTime),
                    'second_session_day' => $this->getDayNumber($class->secondTime),
                    'third_session_id' => $this->findOrCreateSession($class->thirdTime),
                    'third_session_day' => $this->getDayNumber($class->thirdTime),

                    'exam_time' => Parse::examTime($class->examTime),
                    'exam_date' => Parse::examDate($class->examDate),
                    'remainingCap' => $class->remainingCap,
                    'boysCount' => $class->boysCount,
                    'girlsCount' => $class->girlsCount,
                    'allowedGender' => Parse::allowedGender($class->allowedGender),
                    'status15' => $class->status15,
                    'status17' => $class->status17,
                    'venue_id' => $venue->id,
                    'fromYear' => $class->fromYear,
                    'toYear' => $class->toYear,
                    'field' => $class->field == '' ? null : $class->field,
                ]);
            }
        }
    }


    protected function findOrCreateSession($nthSession)
    {
        if ($nthSession == '') {
            return null;
        }

        $sessionArray = explode('-', str_replace('تا', '-', $nthSession));
        /*        $dayMapper = [
                    'ش' => 0, 'ي' => 1, 'د' => 2,
                    'س' => 3, 'چ' => 4, 'پ' => 5, 'جم        ' => 6,
                ];*/

        // Find or create session
        $session = Session::firstOrCreate([
//            'day' => $dayMapper[$sessionArray[0]],
            'starts_at' => $sessionArray[1],
            'ends_at' => $sessionArray[2]
        ]);

        return $session->id;
    }

    protected function getDayNumber($string)
    {
        if ($string == '') {
            return null;
        }
        $dayShortName = explode('-', $string)[0];

        $dayMapper = DaysOfWeek::collection()
            ->pluck('index', 'shortName')->all();

        return $dayMapper[ar2fa($dayShortName)];
    }
}
