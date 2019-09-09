@extends('layouts.app')

@section('title', 'لیست درس‌ها')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">فیلتر‌ها</div>
                    <div class="panel-body">
                        <form action="" method="get">

                            <button class="btn btn-primary pull-left">اعمال فیلتر</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">لیست درس‌ها</div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>عنوان</th>
                                    <th>کلاس‌های ارائه شده</th>
                                    <th>واحد نظری</th>
                                    <th>واحد عملی</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($courses as $course)
                                <tr>
                                    <td><a href="{{ route('public.courses.show', $course->code) }}">{{ $course->code }}</a></td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->classes_count }}</td>
                                    <td>{{ $course->theoretical_unit_count }}</td>
                                    <td>{{ $course->practical_unit_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="20">--noting--</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $courses->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection