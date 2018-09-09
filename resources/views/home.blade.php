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
        .container {
            font-family: Helvetica;
            padding: 1px;
            margin-bottom: 5px;
        }

        .loader-text:after {
            content: "အဖွဲ့ကို ဖန်တီးနေသည်";
            font-weight: bold;
            font-style: italic;
            color: #28a745;
            animation-name: loading-text;
            animation-duration: 1s;
            animation-iteration-count: infinite;
        }

         @keyframes loading-text {
            0% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည်";
            }
            10% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် .";
            }
            20% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . .";
            }
            30% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . ";
            }
            40% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . .";
            }
            50% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . .";
            }
            60% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . .";
            }
            70% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . .";
            }
            80% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . . .";
            }
            90% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . . . .";
            }
            100% {
              content: "အဖွဲ့ကို ဖန်တီးနေသည် . . . . . . . . . .";
            }
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
                data-target="#createGroupModal"
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
                                <div class="text-muted ml-3 py-3">
                                    <p class="ml-3">
                                        {!! $group->description !!}
                                        <br>
                                        {!! sizeof($group->users).__(' Members') !!}
                                        <br>
                                        {!! __('Created at ').$group->created_at->toFormattedDateString() !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade mt-5" id="createGroupModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">အဖွဲ့အသစ်တစ်ခု ဖန်တီးမည်</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label">အမည်</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputName" placeholder="အဖွဲ့အမည် ထည့်သွင်းပါ။" required autofocus>
                            <span class="invalid-feedback" role="alert">
                                <strong>အမည်ကို ရိုက်ထည့်ပေးရမည်။</strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDescription" class="col-sm-3 col-form-label">အချက်အလက်</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputDescription" placeholder="ဤအဖွဲ့နှင့် ပတ်သက်သော အကြောင်းအရာဖော်ပြချက်ထည့်ပါ။">
                            <span class="invalid-feedback" role="alert">
                                <strong>အဖွဲ့နှင့်ပတ်သက်သော​ဖော်ပြချက် ထည့်ပေးရမည်။</strong>
                            </span>
                        </div>
                    </div>
                    <div class='container' id="creating" style="display: none;">
                        <div class='loader'>
                            <div class='loader-text'></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn-cancel" data-dismiss="modal">မလုပ်တော့ပါ</button>
                    <button type="button" class="btn btn-primary" id="btn-create">ဖန်တီးမည်</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        let groupName = "Test"
        let groupDescription = "Test"

        $(document).ready(function(){
            $(document).keypress(function(e) {
                if(e.which == 13) {
                    create()
                }
            }),
            $("#btn-create").click(function(){
                create()
            });
            $("#btn-cancel").click(function(){
                $('#inputName,#inputDescription').removeClass('is-invalid')
                $('#inputName,#inputDescription').val('')
            });
        });

        function create(){
            $('#inputName,#inputDescription').removeClass('is-invalid')
            groupName =  $('#inputName').val()
            groupDescription =  $('#inputDescription').val()

            if(groupName == '')
                $('#inputName').addClass('is-invalid');
            if(groupDescription == '')
                $('#inputDescription').addClass('is-invalid');

            if(groupName  && groupDescription){
                $('#inputName,#inputDescription').removeClass('is-invalid')
                $('#inputName,#inputDescription').addClass('is-valid')
                $('#btn-create').prop('disabled', true)
                $('#btn-cancel').prop('disabled', true)
                $('#creating').css('display','block')
                $.ajax({ 
                    url: '/groups',
                    type: 'POST',
                    data:{
                        name: groupName,
                        description: groupDescription
                    },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(result){
                        console.log(result);
                        $('#btn-create, #btn-cancel').prop('disabled', true);
                        $('#creating').css('display', 'block');
                        $("#groups").append(`
                            <a href="/group/${result.id}" class="col-4 nav-link">
                                <div class="card">
                                    <div class="body mt-3">
                                        <div class="text-center">${result.name}</div>
                                        <hr>
                                        <div class="text-muted ml-3 py-3">
                                            <p ml-3>
                                                ${result.description}
                                                <br>
                                                1 Member
                                                <br>
                                                Created at ${result.created_at.slice(0, 10)}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `)
                        $('#btn-create, #btn-cancel').prop('disabled', false);
                        $('#inputName,#inputDescription').val('')
                        $('#createGroupModal').modal("hide")
                    }
                })
            }
        }
    </script>
@endsection