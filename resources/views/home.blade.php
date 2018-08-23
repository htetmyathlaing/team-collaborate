<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> --}}
    
    <style type="text/css" media="screen">
        a:hover{
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand mx-auto" href="#">Team Collaborate</a>
    </nav>

    <div id="home">
        <div class="container mt-3">
            <div class="row">
                @foreach($groups as $group)
                    <a href="/group/{!! $group->id !!}" class="col-4">
                        <div class="card">
                            <div class="body">
                                {!! $group->description !!}
                            </div>
                            <div class="footer">
                            <h6 class="ml-auto">{!! $group->name !!}</h6>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>