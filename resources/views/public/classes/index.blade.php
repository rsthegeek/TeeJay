@extends('layouts.app')

@section('title', 'لیست کلاس‌ها')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">فیلتر‌ها</div>
                    <div class="panel-body">
                        <form action="" method="get">
                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'courses[]', 'dir' => 'rtl',
                                'list' => $courses,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'درس'
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'teachers[]', 'dir' => 'rtl',
                                'list' => $teachers,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'استاد'
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'venues[]', 'dir' => 'rtl',
                                'list' => $venues,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'مکان برگذاری'
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'first_day[]', 'dir' => 'rtl',
                                'list' => $days,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'روز اول'
                             ])

                             @include('layouts.partials.fields.select-searchable', [
                                'name' => 'first_session[]', 'dir' => 'rtl',
                                'list' => $sessions,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'ساعت اول'
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'second_day[]', 'dir' => 'rtl',
                                'list' => $days,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'روز دوم'
                             ])
                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'second_session[]', 'dir' => 'rtl',
                                'list' => $sessions,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'ساعت دوم'
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'third_day[]', 'dir' => 'rtl',
                                'list' => $days,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'روز سوم'
                             ])
                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'third_session[]', 'dir' => 'rtl',
                                'list' => $sessions,
                                'multi' => true,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'ساعت سوم'
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'orderby', 'dir' => 'rtl',
                                'list' => $orderables,
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'مرتب سازی بر اساس',
                             ])

                            @include('layouts.partials.fields.select-searchable', [
                                'name' => 'sort', 'dir' => 'rtl',
                                'list' => ['ASC' => 'صعودی', 'DESC' => 'نزولی'],
                                'default' => 'DESC',
                                'wrapperClass' => 'col-md-12 col-sm-3',
                                'placeHolder' => 'ترتیب نمایش'
                             ])

                            <button class="btn btn-primary pull-left">اعمال فیلتر</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">لیست کلاس‌ها</div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>کد کلاس</th>
                                    <th>کد درس</th>
                                    <th>عنوان درس</th>
                                    <th>استاد</th>
                                    <th>محل برگزاری</th>
                                    <th>جلیسه اول</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($classes as $class)
                                <tr>
                                    <td><a href="{{ route('public.classes.show', $class->code) }}">{{ faNumerals($class->code) }}</a></td>
                                    <td>{{ faNumerals($class->course->code) }}</td>
                                    <td>{{ $class->course->title }}</td>
                                    <td>{{ $class->teacher->full_name }}</td>
                                    <td>
                                        {{ $class->venue->complex->title }}
                                        {{ faNumerals($class->venue->code) }}
                                    </td>
                                    <td>
                                        {{ $class->first_session_day_title }}
                                        @if($class->firstSession)
                                            {{ $class->firstSession->toString() }}
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="20">--noting--</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $classes->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
