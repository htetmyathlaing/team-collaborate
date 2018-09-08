@extends('layouts.app')

@section('css')
    <style type="text/css" media="screen">
        .card{
            /*height: 100px;*/
            border-radius: 6px;
            border: 0;
            /*box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);*/
            box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
            /*box-shadow: 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12), 0 2px 4px -1px rgba(0,0,0,.2);*/
        }
        .card:hover, .btn-circle:hover{
            /*box-shadow: 2px 4px 8px 0 rgba(46,61,73,.3);*/
            /*transition: box-shadow .2s ease-in-out;*/
            transform: scale(1.02, 1.02);
            transition: transform .1s;
        }
        hr {
            margin-top: 1em;
            margin-bottom: 1em;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        .btn-circle{
            width: 50px;
            height: 50px;
            padding: 10px 16px;
            font-size: 18px;
            line-height: 1.33;
            border-radius: 25px;
            background: white;
            /*box-shadow: 0 2px 12px 0 rgba(0,0,0,.1);*/
            box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
        }
    </style>
@endsection

@section('content')
    <div id="home">
        <div class="container mt-3">
            <button type="button"
                id="create-group" 
                class="btn btn-default btn-circle m-3"
                data-toggle="modal"
                data-placement="right" 
                title="အဖွဲ့အသစ်တစ်ခု ဖန်တီးမည်">
                <span class="fas fa-plus"></span>
            </button>

            <div class="row" id="groups">
                @foreach($groups as $group)
                    <a href="/group/{!! $group->id !!}" class="col-4 nav-link">
                        <div class="card">
                            <div class="body mt-3">
                                <div class="text-center">{!! $group->name !!}</div>
                                <hr>
                                <div class="ml-3 py-3">
                                    <p class="ml-3">
                                        {!! $group->description !!}
                                        <br>
                                        {!! $group->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
    </script>
    <script type="text/javascript">
        let groupName = "Test"
        let groupId = ''
        let groupDescription = "Test"

        $("#create-group").click(function(){
            $("#groups").append(`
                <a href="/group/${groupId}" class="col-4 nav-link">
                    <div class="card">
                        <div class="body mt-3">
                            <div class="text-center">${groupName}</div>
                            <hr>
                            <div class="ml-3 py-3">
                                <p ml-3>
                                    ${groupName}
                                    <br>
                                    ${groupDescription}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            `)
        })
    </script>
@endsection