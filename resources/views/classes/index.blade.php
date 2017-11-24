@extends('layouts.app')

@section('title', 'لیست کلاس ها')

@section('content')
    <table>
        <thead>
            <tr>
                <th>کد کلاس</th>
                <th>کد درس</th>
                <th>عنوان درس</th>
            </tr>
        </thead>
        <tbody>
        @forelse($classes as $class)
            <tr>
                <td>{{ $class->code }}</td>
                <td>{{ $class->course->code }}</td>
                <td>{{ $class->course->title }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="20">--noting--</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $classes->links() }}
@endsection