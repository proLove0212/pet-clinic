@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 ユーザー変更
@endsection

@section('stylesheet')

@endsection


@section('content')

<a href="{{route('admin.users')}}"
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

<div class="md:flex items-start">
    <div class="w-full md:w-64 border-2 border-gray-100 md:pb-12">
        <div class="flex items-center p-4 text-xl font-black text-indigo-800   bg-indigo-100 " role="alert">
            <span class="material-symbols-outlined mr-2">
                settings_account_box
                </span>
            <span class="font-black"> {{$user['ClinicName']}}</span>
        </div>
        <p class="my-3 mb-3 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">病院ID : </span>{{$user['ClinicID']}}
        </p>
        <p class="mb-3 mb-3 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">DB No : </span>{{$user['DBNo']}}
        </p>
        <p class="mb-3 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">登録日時 : </span>
            {{date('Y-m-d h:i:s', strtotime($user['created_at']))}}
        </p>
        <p class="mb-3 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">更新日時 : </span>
            {{date('Y-m-d h:i:s', strtotime($user['updated_at']))}}
        </p>
        <p class="mb-3 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">最後の加入日時 : </span>
            @if ($user['LoginDateTime'])
                {{date('Y-m-d h:i:s', strtotime($user['LoginDateTime']))}}
            @else
                ----
            @endif
        </p>
        <p class="mb-3 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">顧客数 : </span>
            {{$cust_cnt}} 人
        </p>
        <p class="mb-3 px-3 text-left   md:text-sm">
            <span class="w-32 font-black ">ペット数 : </span>
            {{$pet_cnt}} 匹
        </p>
        <p class="mb-5 px-3 text-left  md:text-sm">
            <span class="w-32 font-black ">サービスの利用状況 : </span>
            @if ($user['CustStatus'] == 0)
                システム利用停止
            @elseif ($user['CustStatus'] == 1)
                新規
            @elseif ($user['CustStatus'] == 2)
                パスワード再発行
            @else
                通常利用
            @endif
        </p>

        <p class="mb-3 flex justify-center px-3">
            <button type="button"
            data-modal-target="pwd_dlg" data-modal-toggle="pwd_dlg"
            class="block  max-w-xs w-full bg-success-600 hover:bg-success-700 focus:bg-success-700 text-white rounded-lg px-3 py-3 font-semibold">仮PW発行</button>

        </p>

    </div>

    <hr class="md:hidden my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />

    <div class="flex-grow">
        <form action="{{route('admin.user.edit', $user['id'])}}" method="post">
            @csrf
            <div class="md:flex items-start text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left md:text-right w-40">ユーザー番号</p>
                <div class=" md:flex-grow">
                    <input type="text" name="PeaksUserNo" value="{{$user['PeaksUserNo']}}"
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
                    <input type="text" name="ClinicName" value="{{$user['ClinicName']}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
                    @error('ClinicName')
                        <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="md:flex items-start text-left mb-3">
                <p class="my-3 mr-3 font-black   text-left md:text-right  w-40">電話番号</p>
                <div class=" md:flex-grow">
                    <input type="tel" id="phone" name="TelNo" value="{{$user['TelNo']}}" required
                    required pattern="[0-9]{2,3}-[0-9]{3}-[0-9]{4}"
                    class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="xx-xxx-xxxx, xxx-xxx-xxxx" >
                    @error('TelNo')
                        <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
                    @enderror
                </div>
            </div>


            <div class="md:flex items-start text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">メールアドレス</p>
                <div class=" md:flex-grow">
                    <input type="email" name="email" value="{{$user['email']}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
                    @error('email')
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
                                @if ($user['PatientRegOpt'])
                                    <input id="vue-checkbox-list" type="checkbox" value="PatientRegOpt" name="PatientRegOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                                @else
                                    <input id="vue-checkbox-list" type="checkbox" value="PatientRegOpt" name="PatientRegOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                @endif
                                <label for="vue-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">診察券</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                @if ($user['ReceptionOpt'])
                                    <input id="react-checkbox-list" type="checkbox" value="ReceptionOpt" name="ReceptionOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                                @else
                                    <input id="react-checkbox-list" type="checkbox" value="ReceptionOpt" name="ReceptionOpt" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                @endif
                                <label for="react-checkbox-list" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">順番</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                @if ($user['ReserveOpt'])
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
                    <input datepicker type="text" name="License" value="{{date('m/d/Y', strtotime($user['License']))}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="02/29/2023">

                    @error('License')
                        <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="md:flex items-start text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">メモ情報</p>
                <div class=" md:flex-grow">
                    <input type="text" name="Memo" value="{{$user['Memo']}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" >
                    @error('Memo')
                        <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
                    @enderror
                </div>
            </div>

            @if ($user['CustStatus'] == 5 || $user['CustStatus'] == 0)
                <div class="md:flex items-center text-left mb-5">
                    <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">メモ情報</p>
                    <div class="flex md:flex-grow">
                        <div class="flex items-center mr-4">
                            @if ($user['CustStatus'] == 5)
                                <input id="inline-radio" type="radio" value="active" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked >
                            @else
                                <input id="inline-radio" type="radio" value="active" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @endif
                            <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">有効化</label>
                        </div>
                        <div class="flex items-center mr-4">
                            @if ($user['CustStatus'] == 0)
                                <input id="inline-2-radio" type="radio" value="deactive" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" checked>
                            @else
                                <input id="inline-2-radio" type="radio" value="deactive" name="active" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            @endif

                            <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">無効化</label>
                        </div>
                    </div>
                </div>

            @endif

            <div class="flex mb-3 justify-between text-left">
                <button type="button"
                data-modal-target="delete_dlg" data-modal-toggle="delete_dlg"
                class="block  max-w-xs ml-2 md:ml-20 px-6 bg-danger-500 hover:bg-danger-700 focus:bg-danger-700 text-white rounded-lg px-3 py-3 font-semibold">削除         </button>

                <div class="flex">
                    <button class="block  max-w-xs  px-6 bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">修正</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div id="delete_dlg" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="my-5 text-lg font-normal text-gray-500 dark:text-gray-400">削除しますか？</h3>
                <form action="{{route('admin.user.delete', $user['ClinicID'])}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button data-modal-hide="delete_dlg" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        確認
                    </button>
                    <button data-modal-hide="delete_dlg" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">キャンセル</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div id="pwd_dlg" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="my-5 text-lg font-normal text-gray-500 dark:text-gray-400">パスワードを再発行します。</h3>
                <form action="{{route('admin.user.password', $user['ClinicID'])}}" method="post">
                    @csrf
                    <button data-modal-hide="pwd_dlg" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        確認
                    </button>
                    <button data-modal-hide="pwd_dlg" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">キャンセル</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/datepicker.min.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {

        });

    </script>
@endsection
