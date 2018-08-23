<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ mix('/js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ mix('/css/app.css') }}"> --}}
    
    <style type="text/css" media="screen">
        hr {
          margin-top: 0.5em;
          margin-bottom: 0.5em;
          border: 0;
          border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        .fade-enter-active, .fade-leave-active {
            transition: all 1s;
          }
        .fade-enter, .fade-leave-to{
            opacity: 0;
            transform: translateY(-5px);
        }
    </style>
    <script>
        var groupId = {!! $group_id !!}    </script>
</head>
<body>
    <div id="app">
        <nav-bar></nav-bar>
        <div class="container-fluid">
            <div class="row">
                <left-colum></left-colum>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                        @csrf
                </form>
                <hr>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
                {{-- <right-colum></right-colum> --}}
            </div>      
        </div>
        <create-channel-modal></create-channel-modal>
        <create-group-modal></create-group-modal>
        <add-member-modal></add-member-modal> 
    </div>
</body>
</html>