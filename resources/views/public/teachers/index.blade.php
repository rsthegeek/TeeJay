@extends('layouts.app')

@section('title', 'لیست استاد‌ها')

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
                    <div class="panel-heading">لیست استاد‌ها</div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>کد</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>تعداد درس های ارائه شده</th>
                                    <th>تعداد کلاس های ارائه شده</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($teachers as $teacher)
                                <tr>
                                    <td><a href="{{ route('public.teachers.show', $teacher->id) }}">{{ $teacher->id }}</a></td>
                                    <td>{{ $teacher->first_name }}</td>
                                    <td>{{ $teacher->last_name }}</td>
                                    <td>{{ $teacher->course_count }}</td>
                                    <td>{{ $teacher->classes_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="20">--noting--</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $teachers->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection