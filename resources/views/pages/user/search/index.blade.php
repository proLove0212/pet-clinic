@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

@endsection

@section('content')

<div class="flex justify-between mb-10">
    <h3 class="font-black text-xl md:text-2xl flex items-center cursor-pointer">
        ペットクルー　Web顧客情報検索
    </h3>
</div>

<h5 class="mb-5 bg-gray-300 py-3 px-6 text-xl font-black leading-tight text-neutral-800 dark:text-neutral-50">
    {{$auth['name']}}動物病院 様
</h5>

<div class="mb-4 border-b border-gray-200">
    <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg xs:flex "  id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="">
            <a href="#" class="inline-block p-4 font-black border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"  id="no-tab" data-tabs-target="#no" role="tab" aria-controls="no" aria-selected="true">番号検索</a>
        </li>
        <li class="">
            <a href="#" class="inline-block p-4 font-black border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"  data-tabs-target="#name" role="tab" aria-controls="name" aria-selected="false">名前検索</a>
        </li>
    </ul>
</div>

<div id="myTabContent">
    <div class="hidden text-left p-4 rounded-lg bg-gray-50 " id="no" role="tabpanel" aria-labelledby="no-tab">
        <form action="{{url('petcrew/search')}}" method="post">
            @csrf
            <input type="hidden" name="search_mode" value="number">


            <div class="md:flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <div class="flex items-center h-5 w-30 mb-3">
                    <input id="radio_cust_no" name="mode" type="radio" value="cust" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                    <label for="radio_cust_no" class="ml-3 font-medium text-gray-900 dark:text-gray-300">
                        顧客番号
                    </label>
                </div>
                <div class="md:ml-2 grow ">
                  <input type="text" name="cust-no" id="cust-no-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                </div>
            </div>

            <div class="md:flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                <div class="flex items-center h-5 w-30 mb-3">
                    <input id="radio_tel_no" name="mode" type="radio" value="tel" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" checked>
                    <label for="radio_tel_no" class="ml-3 font-medium text-gray-900 dark:text-gray-300">
                        電話番号
                    </label>
                </div>
                <div class="ml-2 grow ">
                    <input type="text" name="tel-no" id="tel-no-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" />
                </div>
            </div>

            <div class="mt-3 px-2">
                <div class="inline-flex items-center">
                  <input type="checkbox" name="pet_mode[]" id="pet_mode" class="form-checkbox" value="all" />
                  <label for="pet_mode" class="ml-2">死亡、失踪、譲渡のペットも検索</label>
                </div>
            </div>

            <p class="px-2 flex justify-center">
                <button
                type="submit"
                class="inline-block rounded-full bg-success px-16 pt-2.5 pb-2 text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)]">
                検索
              </button>
            </p>


            <hr class="my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />
            <p class="mb-4">
                <p class="mb-2 font-black text-lg">検索時の注意：</p>
                <p class="mb-2 px-4">
                    顧客番号もしくは電話番号を入力して検索してください。
                </p>
                <p class="mb-2 px-4">
                    電話番号での検索はハイフンをつけてもつけなくてもOKです。
                </p>
                <p class="mb-2 px-4">
                    電話番号での検索は登録されている全桁もしくは末尾4桁での検索のみ可能です。
                </p>
                <p class="mb-2 px-4">
                    例：登録されている電話番号が03-1234-5678の場合
                </p>
                <p class="mb-2 px-12">
                    031234-5678 で検索　=> 検索OK
                </p>
                <p class="mb-2 px-12">
                    1234-5678 で検索　 => 検索NG
                </p>
                <p class="mb-2 px-12">
                    5678 で検索　 => 検索OK
                </p>
            </p>
        </form>
    </div>
    <div class="hidden text-left p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="name" role="tabpanel" aria-labelledby="name-tab">

        <form action="{{url('/petcrew/search')}}" method="post">
            @csrf
            <input type="hidden" name="search_mode" value="name">
            <div class="grid gap-4 gap-y-2  grid-cols-1 md:grid-cols-12">
                <div class="md:col-span-6">
                    <label for="address" class="font-medium text-gray-900">顧客姓</label>
                    <input type="text" name="cust_family_name" id="cust_family_name-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                </div>

                <div class="md:col-span-6">
                    <label for="city" class="font-medium text-gray-900">顧客名</label>
                    <input type="text" name="cust_name" id="cust_name-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                </div>
                <div class="md:col-span-6">
                    <label for="address" class="font-medium text-gray-900">顧客姓ふりがな</label>
                    <input type="text" name="cust_family_name_furigana" id="cust_family_name_furigana-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                </div>

                <div class="md:col-span-6">
                    <label for="city" class="font-medium text-gray-900">顧客名ふりがな</label>
                    <input type="text" name="cust_name_furigana" id="cust_name_furigana-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                </div>
                <div class="md:col-span-12">
                    <label for="address" class="font-medium text-gray-900">住所</label>
                    <input type="text" name="address" id="address-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                </div>

                <div class="md:col-span-6">
                    <label for="city" class="font-medium text-gray-900">ペット名</label>
                    <input type="text" name="pet_name" id="pet_name-input" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                </div>
            </div>
            <div class="mt-3 px-2">
                <div class="inline-flex items-center">
                  <input type="checkbox" name="include_dead" id="include_dead_tel" class="form-checkbox" />
                  <label for="include_dead_tel" class="ml-2">死亡、失踪、譲渡のペットも検索</label>
                </div>
            </div>

            <p class="px-2 flex justify-around">
                <button
                type="submit"
                class="inline-block rounded-full bg-success px-8 sm:px-16 pt-2.5 pb-2 text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)]">
                検索
              </button>

              <button
                type="button" id="clear_btn"
                class=" inline-block rounded-full bg-warning  px-5 sm:px-16 pt-2.5 pb-2 text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)]">
                全てｸﾘｱ
                </button>
            </p>


            <hr class="my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />
            <p class="mb-4">
                <p class="mb-2 font-black text-lg">検索時の注意：</p>
                <p class="mb-2 px-4">
                    顧客姓名での検索は各検索枠毎に完全一致検索です。
                </p>
                <p class="mb-2 px-4">
                    住所とペット名での検索に限りあいまい検索（住所の一部やペット名の一部があっていると検索）されます。
                </p>
                <p class="mb-2 px-4">
                    検索条件を入力する際はスペースを入れないでください。
                </p>
                <p class="mb-2 px-4">
                    複数の検索条件を入力した場合はANDで絞り込み検索が行われます。
                </p>
                <p class="mb-2 px-4">
                    例：
                </p>
                <p class="mb-2 px-12">
                    顧客姓が「林原」の場合「林」や「原」で検索してもNG
                </p>
                <p class="mb-2 px-12">
                    ペット名が「小太郎」の場合、「太郎」で検索してもOK
                </p>
            </p>

        </form>
    </div>
</div>

@endsection


@section('javascript')
    <script>
        $( document ).ready(function() {

            $("#radio_cust_no").click(function(){
                $("#tel-no-input").val("")
                $("#cust-no-input").attr("disabled", false)
                $("#tel-no-input").attr("disabled", true)
            })

            $("#radio_tel_no").click(function(){
                $("#cust-no-input").val("")
                $("#cust-no-input").attr("disabled", true)
                $("#tel-no-input").attr("disabled", false)
            })

            $("#clear_btn").click(function(){
                $("#cust_family_name-input").val("")
                $("#cust_name-input").val("")
                $("#cust_family_name_furigana-input").val("")
                $("#cust_name_furigana-input").val("")
                $("#address-input").val("")
                $("#pet_name-input").val("")
            })
        });
    </script>
@endsection
