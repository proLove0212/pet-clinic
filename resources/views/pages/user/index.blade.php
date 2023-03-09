@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

@endsection

@section('content')
<div class="flex justify-center mt-5">
    <div style="width:100%; max-width: 768px"
      class="block max-w-xl rounded-lg bg-white text-center shadow-lg dark:bg-neutral-700">
        <div  class="border-b-2 bg-success   border-neutral-100 py-3 px-6 text-xl font-black text-white">
            ペットクルー　Web顧客情報検索
        </div>
        <div class="flex justify-between items-end px-4 pt-4 border-b-4 border-black">
            <h5
            class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                {{$auth['name']}}動物病院
            </h5>

            <form action="{{url('/logout')}}" method="POST">
                @csrf
                <button type="submit" class=" text-white bg-yellow-400 hover:bg-yellow-500 font-medium  text-sm px-6 py-1.5 text-center">
                    ログアウト
                </button>
            </form>
        </div>

        <form action="{{url('/petcrew/search')}}" method="get">
            @csrf
            <div class="flex justify-start px-4 pt-4 items-center">
                <button type="submit" style="width: 120px" class="text-white bg-lime-600 hover:bg-lime-700  font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="material-symbols-outlined block text-4xl">
                        search
                    </span>
                    顧客検索
                </button>
                <p class="px-2 pt-2 text-left">
                    顧客情報を検索できます
                </p>
            </div>
        </form>

        <form action="{{url('/petcrew/upload')}}" method="get">
            @csrf
            <div class="flex justify-start px-4 pt-4 items-center">
                <button type="submit" style="width: 120px" class="min-w-40 text-white bg-lime-600 hover:bg-lime-700  font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="material-symbols-outlined block  text-4xl">
                        cloud_upload
                    </span>
                    アップロード
                </button>
                <p class="px-2 pt-2 text-left">
                    ペットクルーカルテで書き出した顧客情報を一括でアップロードするにはこちらから。
                </p>
            </div>
        </form>

        <div class="flex justify-end px-4 pt-10 items-center">

            <p class="px-2 pt-2 text-left">
                順番予約の時間設定を行います。
            </p>

            <button type="submit" class="whitespace-nowrap text-white bg-yellow-400 hover:bg-yellow-500 font-medium  text-sm px-6 py-1.5 text-center">
                設定
            </button>
        </div>

        <div class="flex justify-end px-4 py-4 items-center mb-10">

            <p class="px-2 pt-2 text-left">
                順番予約の来院理由の設定を行います。
            </p>

            <button type="submit" class="whitespace-nowrap text-white bg-yellow-400 hover:bg-yellow-500 font-medium  text-sm px-6 py-1.5 text-center">
                設定
            </button>
        </div>


    </div>
</div>
@endsection


@section('javascript')

@endsection
