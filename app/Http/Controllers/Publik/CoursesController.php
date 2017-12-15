<?php

namespace App\Http\Controllers\Publik;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\UniClass;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::orderBy(
            $request->get('orderBy', 'created_at'),
            $request->get('sort', 'DESC')
        )->paginate(15);

        return view('public.courses.index',
            compact('courses')
        );
    }

    public function show(Course $course)
    {
        return view('public.courses.show', compact('course'));
    }
}
