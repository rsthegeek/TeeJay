<?php

namespace App\Http\Controllers\Publik;

use App\Complex;
use App\Course;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\UniClass;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplexesController extends Controller
{
    public function index(Request $request)
    {
        $complexes = Complex::withCount('venues')
            ->orderBy(
                $request->get('orderBy', 'created_at'),
                $request->get('sort', 'DESC')
            )->paginate(15);

        return view('public.complexes.index',
            compact('complexes')
        );
    }

    public function show(Complex $complex)
    {
        return view('public.complexes.show', compact('complex'));
    }
}
