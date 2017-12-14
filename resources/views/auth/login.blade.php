@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ورود</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        @include('layouts.partials.fields.email', [
                            'name' => 'email', 'title' => 'ایمیل',
                            'required' => true, 'autofocus' => true,
                        ])

                        @include('layouts.partials.fields.password', [
                            'name' => 'password', 'title' => 'پسورد',
                            'required' => true,
                        ])

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به یاد بسپار
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">ورود
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">یادت رفته پسوردت رو ؟
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
