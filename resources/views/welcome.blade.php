@extends('layouts.app')

@section('css')
    <style>
            .text-itelic{
                font-style: italic;
            }
            .mm-text{
                font-family: 'Padauk', sans-serif;
            }
            .mm-text-bold{
                font-weight: bold;
            }
            .card{
                border-radius: 6px;
                border: 0;
                box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
            }
            .services{
                border-radius: 5px;
                padding:  20px;
                box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
                height: 200px;
            }
            img{
                box-shadow: 5px 5px 25px 0 rgba(46,61,73,.2);
            }
        </style>
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center text-itelic mm-text">
            <h1 class="text-info mm-text-bold">အပြန်အလှန်ချိတ်ဆက်၊ ပူးပေါင်းဆောင်ရွက်ပြီး အောင်မြင်အောင်ဆောင်ရွက်ပါ။</h1><br>
            <p class="lead">
                လုပ်ငန်းအမျိုးအစားအားလုံးအတွက် ရိုးရှင်းထိရောက်သော အဖြေတစ်ခုဟာ သင့်ရှေ့မှောက်မှာပါ။
                <br>
                <strong>TeamCollaborate</strong> နှင့် ယခုပဲစတင်ချိတ်ဆက်လိုက်ပါ။
            </p>
        </div>
    </div>

    <div class="container mt-5 mm-text">
        <div class="row">
            <div class="col-md-6 col-sm-12 mt-5 pt-5">
                <h3 class="mm-text-bold">
                    အဖွဲ့လိုက် ပူးပေါင်းချိတ်ဆက်ဆောင်ရွက်ရန်အတွက် နေရာတစ်ခု
                    <span class="far fa-hand-point-right"></span>
                </h3><br>
                <p>
                    လုပ်ငန်းအသစ်တစ်ခုစတင်တာ၊ ဒါမှမဟုတ် ရုံးခွဲတစ်ခုဖွင့်လှစ်တာမျိုးမှာ သင့်အနေနဲ့ လုပ်စရာတွေအများကြီးရှိနေမှာပါ။<br>
                    အလုပ်သမားအသစ်ခန့်ခြင်း၊ ရုံးခန်းအသစ်ဖွင့်ခြင်းမှသည် အမျိုးမျိုးသောလုပ်ငန်းဆောင်တာတွေကို
                    တစ်စုတစ်စည်းတည်း စီမံခန့်ခွဲနိုင်ဖို့အတွက် အလွယ်တကူလုပ်ဆောင်နိုင်ရန် <strong>TeamCollaborate</strong> က အသင့်ရှိနေပါသည်။
                    </p>
            </div>
            <div class="col-md-6 col-sm-12 text-center">
                <img src="{{ asset('img/teamwork-at-table.jpg') }}" style="width: 100%; height: 400px;">
            </div>
        </div>  
    </div>

    <div class="container mm-text mt-5 pt-5">
       <div class="row">
            <div class="col-md-6 col-sm-12 text-center">
                <img src="{{ asset('img/collaborate.jpg') }}" style="width: 100%; height: 400px;">
            </div>
            <div class="col-md-6 col-sm-12">
                <h3 class="mt-5 mx-auto mm-text-bold">အဖွဲ့လိုက်ပူးပေါင်းဆောင်ရွက်ရန်အတွက် ပြီးပြည့်စုံသောနေရာတစ်ခု</h3>
                <div class="mx-auto mt-3">
                    <p><strong>TeamCollaborate</strong> သည် အဖွဲ့လိုက်ပူးပေါင်းဆောင်ရွက်ရန်အတွက် လိုအပ်သော 
                    <br>
                    <ul>
                        <li>လိုအပ်သောသတင်းအချက်အလက်များကိုမျှဝေနိုင်ခြင်း</li>
                        <li>ခေါင်းစဉ်ခွဲများခွဲကာ အဖွဲ့လိုက်ဆွေးနွေးနိုင်ခြင်း</li>
                        <li>အဖွဲ့ဝင်တစ်ဦးချင်းဆီသို့ သီးသန့်ဆက်သွယ်နိုင်ခြင်း</li>
                        <li>အရေးကြီးအကြာင်းအရာများကို အဖွဲ့ဝင်အားလုံးသို့ အသိပေးနိုင်ခြင်း</li>
                    </ul>
                    စသည့် ဝန်ဆောင်မှုများစွာပါရှိသည့် ပြီးပြည့်စုံသောစုံသော နေရာတစ်ခုဖြစ်ပါသည်။
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mm-text">
        <h3 class="mt-5 text-center mm-text-bold">အမျိုးမျိုးသော လုပ်ငန်းများတွင် အသုံးပြုနိုင်ခြင်း</h3>
        <div class="row mt-5 mm-text-bold">
            <div class="col-md-4 col-sm-6 mt-3 ">
                <div class="card">
                    <div class="card-body text-center m-4">
                        IT Team
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3 ">
                <div class="card">
                    <div class="card-body text-center m-4">
                        HR Management
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3 ">
                <div class="card">
                    <div class="card-body text-center m-4">
                        ကုမ္ပဏီအဖွဲ့အစည်း
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3 ">
                <div class="card">
                    <div class="card-body text-center m-4">
                        အရောင်းမြှင့်တင်ရေး
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3 ">
                <div class="card">
                    <div class="card-body text-center m-4">
                        ပုဂ္ဂလိကအဖွဲ့အစည်း
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-3 ">
                <div class="card">
                    <div class="card-body text-center m-4">
                        အခြားသောအသင်းအဖွဲ့များ
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center mt-5 mm-text">
        <h3 class="pt-5 mm-text-bold">ပါဝင်သော ဝန်ဆောင်မှုများ</h3>
        <div class="row">
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <div class="services">
                    <span class="fas fa-5x fa-users text-gray-dark"></span>
                    <p class="card-text mt-1">
                        မိမိလိုအပ်သလို အဖွဲ့ဖွဲ့နိုင်ခြင်း
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                    <div class="services">
                    <span class="fas fa-5x fa-comment text-success"></span>
                    <p class="card-text mt-1">
                        တစ်ဦးချင်းသီးသန့်ဖြစ်စေ၊ ခေါင်းစဉ်ခွဲများခွဲပြီး အဖွဲ့လိုက်ဖြစ်စေ မက်ဆေ့များ အပြန်အလှန် ပေးပို့နိုင်ခြင်း
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                    <div class="services">
                    <span class="fas fa-5x fa-file text-info"></span>
                    <p class="card-text mt-1">
                        လိုအပ်သော ဖိုင်များ၊ မှတ်စုများ၊ ဓာတ်ပုံများ၊ ဗီဒီယိုဖိုင်များကို Resource Center တွင် တင်ပေးထားခြင်းဖြင့် အဖွဲ့ဝင်များသို့မျှဝေပေးနိုင်ခြင်း
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <div class="services">
                    <span class="fas fa-5x fa-phone text-primary"></span>
                    <p class="card-text mt-1">
                        တစ်ဦးချင်း သီးသန့်ဖြစ်စေ၊ အဖွဲ့လိုက်ဖြစ်စေ ဖုန်းခေါ်ဆိုနိင်ခြင်း
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <div class="services">
                   <span class="fas fa-5x fa-video text-danger"></span>
                   <p class="card-text mt-1">
                       တစ်ဦးချင်း သီးသန့်ဖြစ်စေ၊ အဖွဲ့လိုက်ဖြစ်စေ Video Conference ပြုလုပ်နိုင်ခြင်း
                   </p>
               </div>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <div class="services">
                    <span class="fas fa-5x fa-bullhorn text-warning"></span>
                    <p class="card-text mt-1">
                       အဖွဲ့ဝင်များအားလုံးသို့ သတိပေးချက်များ ပေးပို့နိုင်ခြင်း
                    </p>
                </div>
            </div>
       </div>
   </div>

    <!-- Footer -->
    <footer class="bg-dark pt-4 mt-5">

        <!-- Footer Elements -->
        <div class="container">
            <!-- Social buttons -->
            <ul class="list-unstyled list-inline text-center">
                <li class="list-inline-item">
                    <a class="mx-1 text-primary" href="#">
                        <i class="fab fa-2x fa-facebook-f"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="mx-1 text-danger" href="#">
                        <i class="fab fa-2x fa-google-plus-g"> </i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a class="mx-1 text-info" href="#">
                        <i class="fab fa-2x fa-twitter"> </i>
                    </a>
                </li>
            </ul>
            <!-- Social buttons -->

        </div>
        <!-- Footer Elements -->

        <!-- Copyright -->
        <div class="text-center text-white py-3">© 2018 Copyright:
            <a href="#"> TeamCollaborate.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
@endsection