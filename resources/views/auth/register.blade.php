@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ثبت نام</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        @include('layouts.partials.fields.text', [
                            'name' => 'name',
                            'title' => 'نام و نام‌خانوادگی',
                            'required' => true,
                            'autofocus' => true,
                        ])

                        @include('layouts.partials.fields.email', [
                            'name' => 'email',
                            'title' => 'آدرس ایمیل',
                            'required' => true,
                        ])

                        @include('layouts.partials.fields.password', [
                            'name' => 'password',
                            'title' => 'کلمه عبور',
                            'required' => true,
                        ])

                        @include('layouts.partials.fields.password', [
                            'name' => 'password_confirmation',
                            'id' => 'password-confirm',
                            'title' => 'تکرار کلمه عبور',
                            'required' => true,
                        ])

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">ثبت نام</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
