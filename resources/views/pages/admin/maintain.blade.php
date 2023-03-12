@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 メンテナンス
@endsection

@section('stylesheet')

@endsection

@section('content')

<h3 class="font-black text-xl md:text-2xl mb-10">
    メンテナンススケジュール管理を進めます。
</h3>

<div class="md:flex items-start">
    <div class="pr-3 w-full md:w-96 lg:w-1/2 border-0 border-b-2 md:border-b-0 md:border-r-2 md:border-r-gray-50 md:pb-12 mt-3">

        <form action="{{route('admin.maintain.create')}}" method="post">
            @csrf
            <div class="items-start text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left">開始日時</p>
                <div class="w-full">
                    <input datepicker type="datetime-local" name="start_time" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="02/29/2023">

                    @error('start_time')
                        <span class="mt-2 text-danger font-black text-sm">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left">終了日時</p>
                <div class="w-full">
                    <input datepicker type="datetime-local" name="end_time" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="02/29/2023">

                    @error('end_time')
                        <span class="mt-2 text-danger font-black text-sm">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left">メモ</p>
                <textarea id="memo" name="memo" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
            </div>

            <div class="mb-3">
                <button id="send_pre"
                    type="submit"
                    class="mx-auto rounded-full bg-success px-6 py-2 w-full max-w-xs  text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)]">
                    追加
                </button>
            </div>
        </form>

    </div>
    <div class="w-full lg:flex-grow">
        <p class="text-left px-3 py-10 font-bold">
            WEB情報検索サービスのサイトは[STARTDATE]にサーバーのメンテナンスを実施します。
            <br>
            停止に伴い、下記の通り情報検索サービスを一時休止いたします。
            <br>
            <B>■サービスの休止日時</B><br>
            　開始：[STARTDATETIME]<br>
            　終了：[ENDDATETIME]<br>
            <br>
            ※作業の状況により終了時間が前後することがございますのでご了承ください。
        </p>

        <div class="flex items-center p-4 text-xl font-black text-indigo-800   bg-indigo-100 " role="alert">
            <span class="material-symbols-outlined mr-2 font-black">
                checklist
            </span>
            <span class="font-black"> メンテナンスリスト</span>
        </div>

        @if (count($plans))
            @foreach ($plans as $plan_item)
                <div class="px-6 pt-4 pb-0 border-2 border-gray-100 hover:border-l-red-500 hover:bg-gray-100 cursor-pointer">
                    <p class="text-sm mb-3">
                        <span class="font-black mr-3">開始:</span> <span class="text-xs md:text-sm">{{date('Y年m月d日 h時i分s秒', strtotime($plan_item['from']))}}</span>
                    </p>
                    <p class="text-sm mb-3">
                        <span class="font-black mr-3">終了:</span> <span class="text-xs md:text-sm">{{date('Y年m月d日 h時i分s秒', strtotime($plan_item['to']))}}</span>
                    </p>
                    <p class="text-sm mb-3">
                        <span class="font-black mr-3">メモ:</span> <span class="text-xs md:text-sm">{{$plan_item['memo']}}</span>
                    </p>
                    <p class="text-sm mb-3 flex justify-between items-center">
                        <span>
                            <span class="font-black mr-3">状態:</span>

                            <?php
                                $now = \Carbon\Carbon::now();
                                $from = \Carbon\Carbon::parse($plan_item['from']);
                                $to = \Carbon\Carbon::parse($plan_item['to']);

                                if($now->greaterThan($to)){
                                    echo "
                                        <span class='text-xs md:text-sm px-3 py-1 rounded-full bg-gray-500 text-white '>  終了 </span>
                                        ";
                                }else if($now->lessThan($from)){
                                    echo "
                                        <span class='text-xs md:text-sm px-3 py-1 rounded-full bg-orange-500 text-white '>  計画 </span>
                                        ";
                                }else{
                                    echo "
                                        <span class='text-xs md:text-sm px-3 py-1 rounded-full bg-green-500 text-white '>  進行中 </span>
                                        ";
                                }
                            ?>
                        </span>

                        <span class="p-3 cursor-pointer" onclick="document.getElementById('delete_plan_{{$plan_item['id']}}').click()">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </span>
                    </p>

                    <form action="{{route('admin.maintain.delete', $plan_item['id'])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="hidden" id="delete_plan_{{$plan_item['id']}}"></button>
                    </form>

                </div>
            @endforeach

            <div class="flex justify-center">

                <nav aria-label="Page navigation example" class="mt-5 ">
                    <ul class="inline-flex items-center -space-x-px">
                        @foreach ($links as $key => $item)
                            @if (array_search($key, array_keys($links)) == 0)
                                <li>
                                    <a href="{{$item['url']}}" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </li>
                            @elseif (array_search($key, array_keys($links)) == count($links) - 1)
                                <li>
                                    <a href="{{$item['url']}}" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{$item['url']}}" class="px-3 py-2 leading-tight {{$item['active'] ? 'text-primary bg-gray-300' : 'text-gray-500'}} bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{$item['label']}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        @else
        <div class="px-6 pt-4 pb-0 text-center border-2 border-gray-100  hover:bg-gray-100 cursor-pointer">
            <span class="material-symbols-outlined">
                speaker_notes_off
            </span>
            <p class="mb-2 text-medium">メンテナンススケジュールはありません。</p>

        </div>
        @endif

        <div class="mb-10">

        </div>
    </div>
</div>
@endsection

