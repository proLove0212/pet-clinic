@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

@endsection

@section('content')
<div class="flex justify-center mt-5">
    <div style="width:100%; max-width: 768px"
      class="block rounded-lg bg-white text-center shadow-lg dark:bg-neutral-700">

        <div  class="border-b-2 bg-success   border-neutral-100 py-3 px-6 text-xl font-black text-white">
            顧客情報検索結果（{{count($data)}}件）
        </div>
        <div class="flex justify-between items-end px-4 pt-4 border-b-4 border-black">
            <h5
            class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                {{$auth['name']}}動物病院
            </h5>

            <a href="{{url('/petcrew/search')}}" class=" text-white bg-yellow-400 hover:bg-yellow-500 font-medium  text-sm px-6 py-1.5 text-center">
                基本ペジロ
            </a>
        </div>
    </div>
</div>

<div class="flex justify-center" >

    <div class="mt-5" style="width:100%; max-width: 768px">

        @foreach ($data as $customer)

            <div class="block w-full mb-3 rounded-lg bg-white shadow-lg dark:bg-neutral-700">

                <div class="p-6">
                    <h5 class="mb-2 text-xl  font-black font-lg leading-tight text-neutral-800 dark:text-neutral-50">
                        {{$customer['CustFamilyName']}}{{$customer['CustName']}}（{{$customer['CustFamilyName_furigana']}} {{$customer['CustName_furigana']}}）
                    </h5>

                    <div class="flex flex-col overflow-x-auto mb-3">
                        <div class="sm:-mx-6 lg:-mx-8">
                          <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                              <table class="min-w-full text-left text-sm font-light">
                                <tbody>
                                  <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium" style="width: 100px">顧客番号</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$customer['id']}}</td>
                                  </tr>
                                  <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">顧客名</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$customer['CustFamilyName']}}{{$customer['CustName']}}（{{$customer['CustFamilyName_furigana']}} {{$customer['CustName_furigana']}}）</td>
                                  </tr>
                                  <tr class="border-b ">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">住所</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$customer['Address']}}</td>
                                  </tr>
                                  <tr class="border-b ">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">電話番号</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($customer['Tel1'] != "")
                                                <div class="mb-2 mr-2 flex items-center ">
                                                    <span class="material-symbols-outlined">
                                                    phone_enabled
                                                    </span>&nbsp;&nbsp;
                                                    {{$customer['Tel1']}}
                                                </div>
                                            @endif
                                            @if ($customer['Tel2'] != "")
                                                <div class="mb-2 mr-2  flex items-center ">
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
                                    </td>
                                  </tr>
                                  <tr class="border-b ">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">メールアドレス</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{$customer['MailAddress']}}</td>
                                  </tr>
                                  <tr class="border-b ">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium ">最終来院</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{date('Y年 m月 d日', strtotime($customer['LastCommingDate']))}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                    </div>


                    <div class="mb-3 font-black font-lg px-3 flex items-end">
                        <span class="material-symbols-outlined mr-2">
                            pets
                        </span>
                        ペットのリスト({{count($customer['pets'])}}匹)
                    </div>

                    <div id="accordion-flush-{{$customer['id']}}" data-accordion="collapse" class="px-4" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                        @foreach ($customer['pets'] as $pet)
                            <h2 id="accordion-flush-heading-{{$pet['id']}}">
                                <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" data-accordion-target="#accordion-flush-body-{{$pet['id']}}" aria-expanded="true" aria-controls="accordion-flush-body-{{$pet['id']}}">
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
                                <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
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
