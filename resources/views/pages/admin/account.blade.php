@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 管理者情報
@endsection

@section('stylesheet')

@endsection

@section('content')

<div class="flex justify-between mb-10">
    <h3 class="font-black text-xl md:text-2xl flex items-center cursor-pointer">
        管理者情報
    </h3>
    <a href="{{url('petcrew/admin')}}" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
        戻る
    </a>
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
<form action="{{url('/petcrew/admin/account/pwd')}}" method="post">
    @csrf

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            以前のパスワード
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="password" name="old_password" value="{{old('old_password')}}"
            required minlength="8"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" requidanger >
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
            <input type="password" name="password" value="{{old('password')}}"
            required minlength="8"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" requidanger >
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
            <input type="password" name="password_confirmdation" value="{{old('password_confirmdation')}}"
            required minlength="8"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" requidanger >
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
<form action="{{url('/petcrew/admin/account/email')}}" method="post">
    @csrf

    <div class="md:flex items-start text-left mb-3">
        <p style="min-width:12rem" class="my-3 mr-3 font-black  text-left w-48 flex items-center">
            メールアドレス
            <span class="bg-danger-100 text-danger text-xs font-medium ml-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-danger-400 border border-danger-400">必須</span>
        </p>
        <div class=" md:flex-grow">
            <input type="email" name="MailAddress" value="{{old('MailAddress')}}"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" requidanger >
            @error('MailAddress')
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
            <input type="password" name="password_email" value="{{old('password_email')}}"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" requidanger >
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


{{--
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-3">パスワード変更</h4>

                <form action="{{url('/admin/account')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">以前のパスワード。                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" value="{{old('old_password')}}" name="old_password">
                            @error('old_password')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">新しいパスワード                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" value="{{old('password')}}" name="password">
                            @error('password')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">パスワード確認                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" value="{{old('password_confirmdation')}}" name="password_confirmdation">
                            @error('password_confirmdation')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-md">パスワード変更</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> --}}
@endsection



@section('javascript')

    <script>
        $( document ).ready(function() {

        });
    </script>
@endsection
