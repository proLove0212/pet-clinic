@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 新規追加
@endsection

@section('stylesheet')

@endsection

@section('content')

<div class="flex justify-between mb-10">
    <h3 class="font-black text-xl md:text-2xl flex items-center cursor-pointer">
        新規追加
    </h3>
    <a href="{{url('petcrew/admin')}}" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
        戻る
    </a>
</div>

@if (old('failed'))
    <div class="mb-3">
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
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
<form action="{{url('/petcrew/admin/users/add')}}" method="post">
    @csrf

    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right w-40">ユーザー番号</p>
        <div class=" md:flex-grow">
            <input type="text" name="PeaksUserNo" value="{{old('PeaksUserNo')}}"
              required pattern="00[0-9][0-9][0-9][0-9]"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="00xxxx" required >
            @error('PeaksUserNo')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">病院名</p>
        <div class=" md:flex-grow">
            <input type="text" name="ClinicName" value="{{old('ClinicName')}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
            @error('ClinicName')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black   text-left md:text-right  w-40">電話番号</p>
        <div class=" md:flex-grow">
            <input type="tel" id="phone" name="TelNo" value="{{old('TelNo')}}" required
            required pattern="[0-9]{2,3}-[0-9]{3}-[0-9]{4}"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="xx-xxx-xxxx, xxx-xxx-xxxx" >
            @error('TelNo')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror

            <div class="alert alert-info" style="display: none"></div>
            <div class="alert alert-error" style="display: none"></div>
        </div>
    </div>


    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">メールアドレス</p>
        <div class=" md:flex-grow">
            <input type="email" name="MailAddress" value="{{old('MailAddress')}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
            @error('MailAddress')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>


    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">オプション</p>
        <div class=" md:flex-grow">
            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center pl-3">
                        @if (old('PatientRegOpt'))
                            <input id="vue-checkbox-list" type="checkbox" value="PatientRegOpt" name="PatientRegOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                        @else
                            <input id="vue-checkbox-list" type="checkbox" value="PatientRegOpt" name="PatientRegOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        @endif
                        <label for="vue-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">診察券</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center pl-3">
                        @if (old('ReceptionOpt'))
                            <input id="react-checkbox-list" type="checkbox" value="ReceptionOpt" name="ReceptionOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                        @else
                            <input id="react-checkbox-list" type="checkbox" value="ReceptionOpt" name="ReceptionOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        @endif
                        <label for="react-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">順番</label>
                    </div>
                </li>
                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                    <div class="flex items-center pl-3">
                        @if (old('ReserveOpt'))
                            <input id="angular-checkbox-list" type="checkbox" value="ReserveOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                        @else
                            <input id="angular-checkbox-list" type="checkbox" value="ReserveOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        @endif
                        <label for="angular-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">予約</label>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">ライセンスの</p>
        <div class=" md:flex-grow relative max-w-sm">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
            </div>
            <input datepicker type="text" name="License" value="{{old('License')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">

            @error('License')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>


    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">データベースの番号</p>
        <div class=" md:flex-grow">
            <input type="text" name="DBNo" value="{{old('DBNo')}}"
            required pattern="[1-9]|10"
            class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="1〜10" required >
            @error('DBNo')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>


    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">メモ情報</p>
        <div class=" md:flex-grow">
            <input type="text" name="Memo" value="{{old('Memo')}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
            @error('Memo')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>


    <div class="flex mb-3">
        <div class="w-full px-3 mb-5">
            <button class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">追加</button>
        </div>
    </div>

</form>

@endsection


@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/datepicker.min.js"></script>

    <script type="text/javascript">
        $( document ).ready(function() {

        });
    </script>

@endsection


