<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeamCollaborate') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Padauk:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Padauk:400,700" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <style type="text/css" media="screen">
        hr {
          margin-top: 1em;
          margin-bottom: 1em;
          border: 0;
          border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        .card{
            /*height: 100px;*/
            border-radius: 0;
            border: 0;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);
            /*box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);*/
        }
        .btn-circle{
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.55;
            border-radius: 25px;
            /*box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);*/
            box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
        }
        .btn-circle:hover{
            box-shadow: 2px 4px 8px 0 rgba(46,61,73,.3);
            transition: box-shadow .2s ease-in-out;
        }
        .mm-text{
            font-family: 'Padauk', sans-serif;
        }

        @media only screen  and (max-width : 1224px) {
        /* Styles */
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
        {{-- <create-group-modal></create-group-modal> --}}
        <add-member-modal></add-member-modal>
        <delete-channel-modal></delete-channel-modal>
        <voice-call-modal></voice-call-modal>
        <video-call-modal></video-call-modal>
    </div>
</body>
</html>