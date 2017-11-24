<?php

namespace App\Http\Controllers;

use App\UniClass;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
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
        ])->paginate(15);

        return view('classes.index', compact('classes'));
    }

    public function show(UniClass $class)
    {
        $class->load('course', 'teacher', 'venue', 'venue.complex');
        return $class;
        return view('classes.show', compact('class'));
    }
}
