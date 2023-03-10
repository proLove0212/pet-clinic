@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 ユーザー情報
@endsection

@section('stylesheet')

@endsection

@section('content')

<a href="{{route('user.search')}}"
    class="z-30 fixed bottom-0 right-0 w-full px-3 py-2 text-sm font-medium text-center text-white bg-blue-700  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    戻る
</a>

<div class="flex justify-between mb-10">
    <h3 class="font-black text-xl md:text-2xl flex items-center cursor-pointer">
        ユーザー情報
    </h3>
</div>

@if (old('failed'))
    <div class="mb-3">
        <div class="flex p-4 mb-4 text-sm text-danger-800 rounded-lg bg-danger-50 dark:bg-gray-800 dark:text-danger-400" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{old('message')}}</span>
            </div>
        </div>
    </div>
@endif

@if (old('success'))
    <div class="mb-3">
        <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">{{old('message')}}</span>
        </div>
        </div>
    </div>
@endif

<p class=" text-lg font-black border-b-2 border-b-black-600 mt-5 mb-5 pb-2">
    パスワード変更
</p>
<form action="{{route('user.account.password')}}" method="post">
    @csrf

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            以前のパスワード
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="password" name="old_password" value=""
            required minlength="8"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" autocomplete="new-password" required minlength="8" >
            @error('old_password')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            新規パスワード
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="password" name="password" value=""
            required minlength="8"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" autocomplete="new-password" required minlength="8" >
            @error('password')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            パスワード確認用
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="password" name="password_confirmdation" value=""
            required minlength="8"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" autocomplete="new-password" required minlength="8" >
            @error('password_confirmdation')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="flex mb-3">
        <div class="w-full px-3 mb-5">
            <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">パスワード変更</button>
        </div>
    </div>

</form>



<p class=" text-lg font-black border-b-2 border-b-black-600 mt-5 mb-5 pb-2">
    メールアドレス変更
</p>
<form action="{{route('user.account.email')}}" method="post">
    @csrf

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            メールアドレス
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="email" name="email" value="{{old('email')}}"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" autocomplete="nope" required >
            @error('email')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            パスワード
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="password" name="password_email" value=""
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" autocomplete="new-password" required minlength="8" >
            @error('password_email')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="flex mb-3">
        <div class="w-full px-3 mb-5">
            <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">メールアドレス変更</button>
        </div>
    </div>

</form>

@endsection



@section('javascript')

    <script>
        $( document ).ready(function() {

        });
    </script>
@endsection
