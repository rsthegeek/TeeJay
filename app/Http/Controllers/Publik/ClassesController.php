<?php

namespace App\Http\Controllers\Publik;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\UniClass;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
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
            }
        ])->when(!empty($request->courses), function ($query) {
            $query->whereHas('course', function ($q) {
                $q->whereIn('code', \Request::get('courses'));
            });
        })->orderBy(
            $request->get('orderBy', 'created_at'),
            $request->get('sort', 'DESC')
        )->paginate(15);

        $courses = Course::pluck('title', 'code');
        $teachers = Teacher::pluck(
//            DB::raw('CONCAT(first_name, " ", last_name) as full_name'),
            'last_name',
            'id'
        );
        $venues = Venue::pluck('code', 'id');

        return view('public.classes.index',
            compact('classes', 'courses', 'teachers', 'venues')
        );
    }

    public function show(UniClass $class)
    {
        $class->load('course', 'teacher', 'venue', 'venue.complex');
        return $class;
        return view('classes.show', compact('class'));
    }
}
