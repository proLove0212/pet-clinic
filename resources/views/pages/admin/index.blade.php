@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 管理者トップページ
@endsection

@section('stylesheet')

@endsection

@section('content')

<div class="font-black mb-5">
    <h3 class="text-2xl mb-4">
        ペットクルーカルテ　顧客情報検索 管理者トップページ
    </h3>
    <p class="text-md font-black">
        {{number_format($cnt, 0, ".", ",")}}人のユーザーが検索されました。
    </p>
</div>

<div class="block w-full py-6 rounded-lg bg-white text-center shadow-lg dark:bg-neutral-700">

    <form class="flex items-center  px-3" action="{{url('/petcrew/admin/')}}" method="GET" >
        @csrf

        <div class="relative flex-grow">
            <input type="search" id="key" name="key" value="{{$key}}" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
            <button type="submit"class="text-white absolute right-2.5 bottom-2.5 bg-none hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-none font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </div>

        <a href="{{url('/petcrew/admin/users/add')}}" class="inline-flex items-center py-2.5 px-3 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <span class="material-symbols-outlined w-5 h-5 mr-2 -ml-1">
                person_add
            </span>
            追加
        </a>
    </form>

    <hr class="my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />

    @if (count($users) != 0)
        @foreach ($users as $key => $user_item)
            <a href="{{url('/petcrew/admin/users/edit/'.$user_item['id'])}}" class="w-full relative block bg-white hover:bg-gray-100 px-6 pt-6 pb-2 text-left border-2 border-gray-100 hover:border-l-red-400">
                <h5 class="text-blue-800 sm:text-base md:text-2xl font-black mb-2" style="font-family: 'Helvetica Neue',Helvetica,Arial,'Noto Sans JP',sans-serif" >{{$user_item['ClinicName']}}</h5>
                <p class="text-black text-sm mb-4"><span class="font-black">病院ID  </span> {{$user_item['ClinicID']}}</p>

                <div class="flex mb-3">
                    <span class="text-black font-black mr-5"> <span class="">顧客数</span> <span class="text-blue-800">{{$user_item['customer_cnt']}}</span> 人</span>
                    <span class="text-black font-black"> <span class="">ペット数</span> <span class="text-blue-800">{{$user_item['pet_cnt']}}</span> 匹</span>
                </div>

                <div class="md:absolute bottom-0 right-0 md:flex items-center">
                    <span class="text-black font-black mr-5 flex items-center mb-3">
                        <span class="material-symbols-outlined mr-2 text-blue-800">
                            mail
                        </span>
                        <span class="text-sm text-blue-400 underline">{{$user_item['MailAddress']}}</span>
                    </span>

                    <span class="text-black font-black mr-5 flex items-center">
                        <span class="material-symbols-outlined mr-2 text-blue-800">
                            call
                        </span>
                        <span class="text-sm">{{$user_item['TelNo']}}</span>
                    </span>

                </div>

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
                </div>

            </a>
        @endforeach

        <nav aria-label="Page navigation example" class="mt-5">
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
     <script type="text/javascript">

    </script>
@endsection
