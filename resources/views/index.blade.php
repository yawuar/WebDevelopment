<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" />
        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div style="background: url('{{ $contest['photo_path'] }}') no-repeat center center; background-size: cover;" class="flex-center position-ref full-height">
        @include('includes.header')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="logo"></div>
                        <div class="title m-b-md">{{ $contest['title'] }}</div>
                        <div class="description">{!! $contest['content'] !!}</div>
                        <a href="{{ route('contest.index') }}">Contest</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>