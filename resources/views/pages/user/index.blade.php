@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索
@endsection

@section('stylesheet')

@endsection

@section('content')

<div class="user-home-container ">
    <img id="dog_img" src="{{url('assets/images/qq.png')}}" class="" alt="">

    <h2 class="text-2xl sm:3xl md:text-4xl lg:text-5xl text-white font-black ml-5 mt-32 sm:mt-40">
        {{Auth::user()&&Auth::user()->name}} 動物病院
    </h2>


    <div class="mb-3 px-3 mt-20">

        <button class="learn-more flex items-center">
            <span class="circle " aria-hidden="true">
            <span class="icon arrow"></span>
            </span>
            <span class="button-text font-black text-2xl">顧客検索</span>
        </button>

    </div>

</div>
@endsection


@section('javascript')

@endsection
