@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

@endsection

@section('content')

<a onclick="history.back()"
    class="z-30 fixed bottom-0 right-0 w-full px-3 py-2 text-sm font-medium text-center text-white bg-blue-700  hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    戻る
</a>

<div class="font-black mb-5 mt-4 relative">
    <h3 class="text-2xl mb-4">
        {{$customer['CustFamilyName'].$customer['CustName']}}様の詳細情報
    </h3>

    <h6 class="text-xl font-medium mb-10">
        ({{$customer['CustFamilyName_furigana'].$customer['CustName_furigana']}})
    </h6>


    <p class="text-lg font-black border-b-2  border-b-gray-300 mb-5">
        詳細情報
    </p>


    <div class="font-medium  flex items-center text-left mb-3 px-3">
        <span class=" mr-3 font-black w-16 sm:w-32">顧客番号</span>
        <span class="">
            {{$customer['CustNo']}}
        </span>
    </div>


    <div class="font-medium flex items-center text-left mb-3 px-3">
        <span class=" mr-3  font-black  w-16 sm:w-32">顧客名</span>
        <span class="">
            {{$customer['CustFamilyName']}}{{$customer['CustName']}}
        </span>
    </div>


    <div class="font-medium flex items-center text-left mb-3 px-3">
        <span class=" mr-3  font-black  w-16 sm:w-32">住所</span>
        <span class="">
            {{$customer['Address']}}
        </span>
    </div>

    <div class="font-medium sm:flex items-center text-left mb-3 px-3">
        <span class=" mr-3 mb-3 font-black  w-16 sm:w-32">電話番号</span>

        <div class="grid gap-4 gap-y-2  grid-cols-1 md:grid-cols-12 ml-5 sm:ml-0 mt-3">
            @if ($customer['Tel1'] != "")
                <div class="md:col-span-4 flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;
                    {{$customer['Tel1']}}
                </div>
            @endif
            @if ($customer['Tel2'] != "")
                <div class="md:col-span-4 flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;
                    {{$customer['Tel2']}}
                </div>
            @endif
            @if ($customer['Tel3'] != "")
                <div class="mb-2 mr-2  flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;
                    {{$customer['Tel3']}}
                </div>
            @endif
            @if ($customer['Tel4'] != "")
                <div class="mb-2 mr-2  flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;
                    {{$customer['Tel4']}}
                </div>
            @endif
            @if ($customer['Tel5'] != "")
                <div class="mb-2 mr-2  flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;

                    {{$customer['Tel5'] != ""}}
                </div>
            @endif
            @if ($customer['Tel6'] != "")
                <div class="mb-2 mr-2  flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;

                    {{$customer['Tel6']}}
                </div>
            @endif
            @if ($customer['Tel7'] != "")
                <div class="mb-2 mr-2  flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;

                    {{$customer['Tel7']}}
                </div>
            @endif
            @if ($customer['Tel8'] != "")
                <div class="mb-2 mr-2  flex items-center ">
                    <span class="material-symbols-outlined">
                    phone_enabled
                    </span>&nbsp;&nbsp;

                    {{$customer['Tel8']}}
                </div>
            @endif
        </div>
    </div>

    <div class="font-medium sm:flex items-center text-left mb-3 px-3">
        <span class=" mr-3  font-black w-32">メールアドレス</span>
        <span class="ml-5 sm:ml-0">
            {{$customer['MailAddress']}}
        </span>
    </div>

    <div class="font-medium flex items-center text-left mb-10 px-3">
        <span class=" mr-3  font-black w-16 sm:w-32">最終来院</span>
        <span class="">
            {{date('Y年 m月 d日', strtotime($customer['LastCommingDate']))}}
        </span>
    </div>



    <p class="text-lg font-black border-b-2  border-b-gray-300 mb-5">
        ペット動物の詳細情報
    </p>

    <div id="accordion-flush-{{$customer['id']}}" data-accordion="collapse"  data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
        @foreach ($pets as $pet)
            <h2 id="accordion-flush-heading-{{$pet['id']}}">
                <button type="button" class="flex items-center justify-between w-full py-5 px-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-{{$pet['id']}}" aria-expanded="true" aria-controls="accordion-flush-body-{{$pet['id']}}">
                    @if ($pet['PetDeathType'] == 0)
                        <span>{{$pet['KarteNo']}}   {{$pet['PetName']}}({{$pet['PetKind']}})</span>
                    @elseif ($pet['PetDeathType'] == 1)
                        <span>{{$pet['KarteNo']}}(死亡)   {{$pet['PetName']}}({{$pet['PetKind']}})</span>
                    @elseif ($pet['PetDeathType'] == 2)
                        <span>{{$pet['KarteNo']}}(失踪)   {{$pet['PetName']}}({{$pet['PetKind']}})</span>
                    @else
                        <span>{{$pet['KarteNo']}}(譲渡)   {{$pet['PetName']}}({{$pet['PetKind']}})</span>
                    @endif
                    <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </h2>
            <div id="accordion-flush-body-{{$pet['id']}}" class="hidden" aria-labelledby="accordion-flush-heading-{{$pet['id']}}">
                <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700 px-3">
                    <div class="py-1 bg-success text-center text-white font-medium">
                        ペット情報　カルテ番号：{{$pet['KarteNo']}}
                    </div>

                    <div class="flex flex-col overflow-x-auto mb-3">
                        <div class="sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                              <table class="min-w-full text-left text-sm font-light">
                                <tbody>
                                  <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium" style="width: 100px">ペット名</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$pet['PetName']}} ({{$pet['PetName_furigana']}})</td>
                                  </tr>
                                  <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">種類</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$pet['PetKind']}} ({{$pet['PetSex']}}) {{$pet['PetBreed']}}</td>
                                  </tr>
                                  <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">生年月日</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if ($pet['PetBirthday'])
                                            {{date('Y年 m月 d日', strtotime($pet['PetBirthday']))}}(
                                            @if ($pet['PetDeathType'] == 0)
                                                <?php
                                                    $end = \Carbon\Carbon::parse($pet['PetBirthday']);
                                                    $current = \Carbon\Carbon::now();
                                                    $length = $end->diffInDays($current);

                                                    echo number_format($length/365, 0, ".", ",")."歳".number_format(($length%365)/12, 0, ".", ",")."か月" ;
                                                ?>
                                            @elseif ($pet['PetDeathType'] == 1)
                                                @if ($pet['PetDeathType'])
                                                    死亡時
                                                    <?php
                                                        $end = \Carbon\Carbon::parse($pet['PetBirthday']);
                                                        $current = \Carbon\Carbon::parse($pet['PetDeathDate']);
                                                        $length = $end->diffInDays($current);

                                                        echo number_format($length/365, 0, ".", ",")."歳".number_format(($length%365)/12, 0, ".", ",")."か月" ;
                                                    ?>
                                                @else
                                                    死亡
                                                @endif
                                            @elseif ($pet['PetDeathType'] == 2)
                                                失踪
                                            @elseif ($pet['PetDeathType'] == 3)
                                                譲渡
                                            @else

                                            @endif
                                            )
                                        @else
                                            @if ($pet['PetDeathType'] == 1)
                                                死亡
                                            @elseif ($pet['PetDeathType'] == 2)
                                                失踪
                                            @elseif ($pet['PetDeathType'] == 3)
                                                譲渡
                                            @else

                                            @endif
                                        @endif
                                    </td>
                                  </tr>
                                  <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">メモ</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$pet['Memo']}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>


                    <div class="flex flex-col overflow-x-auto mb-3">
                        <div class="sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                              <table class="min-w-full text-left text-sm font-light">
                                <thead>
                                    <tr class="bg-success-200">
                                        <th class="whitespace-nowrap px-6 py-4 font-medium"> 予防接種名 </th>
                                        <th class="whitespace-nowrap px-6 py-4 font-medium"> 接種日・投薬日</th>
                                        <th class="whitespace-nowrap px-6 py-4 font-medium"> 次回予定日</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (explode(",", $pet['VacInfo']) as $vacInfo)
                                        <tr class="border-b dark:border-neutral-500">
                                            @foreach (explode("\t", $vacInfo) as $item)
                                                <td class="whitespace-nowrap px-6 py-4">{{$item}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection


@section('javascript')
    <script>
        $( document ).ready(function() {

        });
    </script>
@endsection
