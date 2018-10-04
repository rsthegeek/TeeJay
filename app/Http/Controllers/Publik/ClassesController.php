<?php

namespace App\Http\Controllers\Publik;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\UniClass;
use App\Venue;
use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            ['requestParam' => 'teachers', 'column' => 'teacher_id', 'method' => 'whereIn'],
            ['requestParam' => 'venues', 'column' => 'venue_id', 'method' => 'whereIn'],
            ['requestParam' => 'first_day', 'column' => 'first_session_day', 'method' => 'whereIn'],
            ['requestParam' => 'first_session', 'column' => 'first_session_id', 'method' => 'whereIn'],
            ['requestParam' => 'second_day', 'column' => 'second_session_day', 'method' => 'whereIn'],
            ['requestParam' => 'second_session', 'column' => 'second_session_id', 'method' => 'whereIn'],
            ['requestParam' => 'third_day', 'column' => 'third_session_day', 'method' => 'whereIn'],
            ['requestParam' => 'third_session', 'column' => 'third_session_id', 'method' => 'whereIn'],
        ];
        $classes = UniClass::with([
            'course' => function ($q) {
                $q->select('id', 'code', 'title');
            },
            'venue' => function ($q) {
                $q->select('id', 'code', 'complex_id');
            },
            'venue.complex' => function ($q) {
                $q->select('id', 'title');
            },
            'teacher' => function ($q) {
                $q->select('id', 'first_name', 'last_name');
            },
            'firstSession'
        ])->when(!empty($request->courses), function ($query) {
            $query->whereHas('course', function ($q) {
                $q->whereIn('code', (array) \Request::get('courses'));
            });
        })->when(true, function ($query) use ($filters) {
            foreach ($filters as $filter) {
                $query->when(!empty(\Request::get($filter['requestParam'])), function ($q) use ($filter) {
                    $filterValue = $filter['method'] == 'whereIn'
                        ? (array) \Request::get($filter['requestParam'])
                        : \Request::get($filter['requestParam']);
                    $q->{$filter['method']}($filter['column'], $filterValue);
                });
            }
        })->orderBy(
            isset(UniClass::$orderables[$request->order_by]) ? UniClass::$orderables[$request->order_by]['column'] : 'created_at',
            in_array($request->sort, ['ASC', 'DESC']) ? $request->order_by : 'DESC'
        )->paginate(15);

        $courses = Course::pluck('title', 'code');
        $teachers = Teacher::select(
                DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'id'
            )->pluck('name', 'id');
        $venues = Venue::pluck('code', 'id');
        $days = UniClass::$dayNames;
        $sessions = Session::select(
            DB::raw("CONCAT(DATE_FORMAT(starts_at, '%H:%i'),' تا ', DATE_FORMAT(ends_at, '%H:%i')) AS time"),
            'id'
        )->pluck('time', 'id');
        $orderables = array_map(function ($orderable) {
            return $orderable['name'];
        }, UniClass::$orderables);

        return view(
            'public.classes.index',
            compact('classes', 'courses', 'teachers', 'venues', 'days', 'sessions', 'orderables')
        );
    }

    public function show(UniClass $class)
    {
        $class->load('course', 'teacher', 'venue', 'venue.complex');
        return $class;
        return view('classes.show', compact('class'));
    }
}
