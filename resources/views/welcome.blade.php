@extends('layouts.app')

@section('css')
    <style>
            .text-itelic{
                font-style: italic;
            }
        </style>
@endsection

@section('content')
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center text-itelic">
            <h1 class="display-6">အပြန်အလှန်ချိတ်ဆက်၊ ပူးပေါင်းဆောင်ရွက်ပြီး အောင်မြင်အောင်ဆောင်ရွက်ပါ။</h1><br>
            <p class="lead">
                အလုပ်အမျိုးအစားအားလုံးအတွက် ရိုးရှင်းထိရောက်သော အဖြေတစ်ခုဟာ သင့်ရှေ့မှောက်မှာပါ။
            </p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h3>
                    အဖွဲ့လိုက် ပူးပေါင်းချိတ်ဆက်ဆောင်ရွက်ရန်အတွက် နေရာတစ်ခု
                    <span class="far fa-hand-point-right"></span>
                </h3><br>
                <p>
                    အဖွဲ့လိုက် လုပ်ငန်းဆောင်ရွက်တဲ့နေရာမှာ အချင်းချင်း အချိတ်အဆက်ဆက်မိမိ ရှိနေဖို့ အရေးကြီးပါတယ်။<br>
                    အချင်းချင်း ဘယ်လို ချိတ်ဆက်မလဲ။<br>
                    အဲဒီအတွက်အဖြေကတော့
                </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <img src="{{ asset('img/top1.png') }}" style="width: 100%; height: 100%;">
            </div>
        </div>  
    </div>

    <div class="container text-center">
        <h3 class="mt-5">ပါဝင်သော ဝန်ဆောင်မှုများ</h3>
        <div class="row">
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <span class="fas fa-5x fa-users text-gray-dark"></span>
                <p class="card-text mt-1">
                    မိမိလိုအပ်သလို အဖွဲ့ဖွဲ့နိုင်ခြင်း
                </p>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <span class="fas fa-5x fa-comment text-success"></span>
                <p class="card-text mt-1">
                    တစ်ဉီးချင်း သီးသန့်ဖြစ်စေ၊ အဖွဲ့လိုက်ဖြစ်စေ မက်ဆေ့များ အပြန်အလှန် ပေးပို့နိုင်ခြင်း
                </p>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <span class="fas fa-5x fa-file text-info"></span>
                <p class="card-text mt-1">
                    လိုအပ်သော ဖိုင်များ၊ မှတ်စုများ၊ ဗီဒီယိုဖိုင်များကို Resource Center တွင် တင်ပေးထားခြင်းဖြင့် အဖွဲ့ဝင်များသို့မျှဝေပေးနိုင်ခြင်း
                </p>
            </div>
            <div class="col-md-4 col-sm-6 mt-5 text-center">
                <span class="fas fa-5x fa-phone text-primary"></span>
                <p class="card-text mt-1">
                    တစ်ဉီးချင်း သီးသန့်ဖြစ်စေ၊ အဖွဲ့လိုက်ဖြစ်စေ ဖုန်းခေါ်ဆိုနိင်ခြင်း
                </p>
               </div>
               <div class="col-md-4 col-sm-6 mt-5 text-center">
                   <span class="fas fa-5x fa-video text-danger"></span>
                   <p class="card-text mt-1">
                       တစ်ဉီးချင်း သီးသန့်ဖြစ်စေ၊ အဖွဲ့လိုက်ဖြစ်စေ Video Conference ပြုလုပ်နိုင်ခြင်း
                   </p>
               </div>
               <div class="col-md-4 col-sm-6 mt-5 text-center">
                   <span class="fas fa-5x fa-bell text-warning"></span>
                   <p class="card-text mt-1">
                       အဖွဲ့ဝင်များအားလုံးကို သတိပေးချက်များ ပေးပို့နိုင်ခြင်း
                   </p>
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