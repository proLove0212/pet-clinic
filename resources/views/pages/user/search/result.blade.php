@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索
@endsection

@section('stylesheet')

@endsection

@section('content')

<a href="{{route('user.search')}}"
    class="z-30 fixed bottom-0 right-0 w-full px-3 py-2 text-sm font-medium text-center text-white bg-blue-700  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    戻る
</a>


<div class="font-black mb-5 mt-4 relative">
    <h3 class="text-2xl mb-4">
        ペットクルーカルテ 顧客情報検索
    </h3>
    <p class="text-md font-black">
        {{number_format(count($data), 0, ".", ",")}}人の顧客が検索されました。
    </p>
</div>

<div class="block w-full rounded-xs bg-white text-center ">

    @if (count($data) != 0)
        @foreach ($data as $customer)
            <a href="{{url('/petcrew/customer/info/'.$customer['CustNo'])}}" class="w-full relative block bg-white hover:bg-gray-100 px-6 pt-6 pb-2 text-left border-2 border-gray-100 hover:border-l-red-400">
                <h5 class="text-blue-800 sm:text-base md:text-2xl font-black mb-2" >
                    {{$customer['CustFamilyName']}}{{$customer['CustName']}}（{{$customer['CustFamilyName_furigana']}} {{$customer['CustName_furigana']}}）
                </h5>

                <p class="text-sm mb-4"><span class="font-bold">顧客番号 : </span> {{$customer['CustNo']}}</p>

                <div class="flex mb-3 text-sm font-medium">
                    <span >
                        <span class="font-bold">住所 : </span>
                        <span class="">{{$customer['Address']}}</span>
                    </span>
                </div>

                <div class="md:absolute bottom-0 right-0 md:flex items-center">

                    <span class="text-black font-black mr-5 flex items-center  mb-3">
                        <span class="material-symbols-outlined mr-2 text-blue-800">
                            pets
                        </span>
                        <span class="text-blue-800">{{count($customer['pets'])}} 匹</span>
                    </span>

                    <span class="text-black font-black mr-5 flex items-center mb-3">
                        <span class="material-symbols-outlined mr-2 text-blue-800">
                            mail
                        </span>
                        <span class="text-sm text-blue-400 underline">{{$customer['email']}}</span>
                    </span>

                </div>
{{--
                <div class="absolute top-5 right-2 sm:top-10 sm:right-10  text-white font-black text-xs md:text-base">
                    @if ($user_item['CustStatus'] == 0)
                        <span class="bg-danger-600 hover:bg-danger-500 px-3 py-2 rounded-full drop-shadow-2xl">システム利用停止</span>
                    @elseif ($user_item['CustStatus'] == 1)
                        <span class="bg-indigo-600 hover:bg-indigo-500 px-3 py-2 rounded-full drop-shadow-2xl">新規</span>
                    @elseif ($user_item['CustStatus'] == 2)
                        <span class="bg-warning-600 hover:bg-warning-500 px-3 py-2 rounded-full drop-shadow-2xl">パスワード再発行</span>
                    @else
                        <span class="bg-success-600 hover:bg-success-500 px-3 py-2 rounded-full drop-shadow-2xl">通常利用</span>
                    @endif
                </div> --}}

            </a>
        @endforeach

    @else
        <div href="" class="w-full block bg-white  px-3 py-6 pt=10 text-center">
            <span class="material-symbols-outlined block mb-4">
                person_off
            </span>
            <p class="mb-2 text-medium"><span class="u-sp-break">条件を満たすユーザーが</span>見つかりませんでした</p>
            <p class="mb-2 text-medium">条件を見直して再検索してください。</p>
        </div>
    @endif
</div>

@endsection


@section('javascript')
    <script>
        $( document ).ready(function() {

        });
    </script>
@endsection
