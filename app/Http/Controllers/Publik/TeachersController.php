<?php

namespace App\Http\Controllers\Publik;

use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\UniClass;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeachersController extends Controller
{
    public function index(Request $request)
    {
        $teachers = Teacher::orderBy(
            $request->get('orderBy', 'created_at'),
            $request->get('sort', 'DESC')
        )->paginate(15);

        return view('public.teachers.index',
            compact('teachers')
        );
    }

    public function show(Teacher $teacher)
    {
        return view('public.teachers.show', compact('teacher'));
    }
}
