@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

@endsection

@section('content')


<div class="flex justify-between mb-10">
    <h3 class="font-black text-xl md:text-2xl flex items-center cursor-pointer">
        ピークス動物病院　ファイルアップロード
    </h3>
    <a href="{{url('petcrew/home')}}" class="text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900">
        戻る
    </a>
</div>


<div id="alert_danger" class="hidden flex p-4 mb-4 text-sm text-danger rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <span>
        ファイルの形式が正確ではありません。
    </span>
</div>

<div id="alert_success" class="hidden flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
    <span>
        アップロードされました。
    </span>
</div>

<div class="my-3 text-left px-5 font-black text-lg">
    ID : {{$auth['ClinicID']}}
</div>

<div class="mb-3 text-left px-5 font-black text-lg">
    病院名 : {{$auth['name']}}
</div>

<div class="mb-3 text-left text-warning px-5 flex items-start font-black">
    <span class="material-symbols-outlined mr-3">
        warning
    </span>
    ファイルのアップロードはPCから行ってください。　スマートホンやタブレットからのアップロードは行わないでください。
</div>

<div class="mb-3 text-left  px-5">
    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="uploadFileSelector" type="file">
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">アップロードするファイルを指定します。</p>
</div>

<div class="mb-3 text-left px-5">
    <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
        <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
            <label for="rslt_content" class="sr-only">プレビュー</label>
            <textarea id="rslt_content" rows="7" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="" required></textarea>
        </div>
        <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
            <button type="button" id="submit_btn" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                アップロード開始
            </button>
        </div>
    </div>

</div>

<hr class="my-6 h-0.5 border-t-0 bg-neutral-200 opacity-100 dark:opacity-30" />

<div class="mb-10 px-5 ">
    <p class="mb-2 text-left font-black">データファイルのアップロード：</p>
    <p class="mb-2 px-4 text-left flex items-start">
        <span class="mr-2">1. </span>
        <span>
            ボタンをクリックしてアップロードするファイルを指定します。<br/>
            このファイルは、｢ペットクルーカルテ６ Web検索用データ出力｣から書き出されたファイルです。
        </span>
    </p>
    <p class="mb-2 px-4 text-left flex items-start">
        <span class="mr-2">2. </span>
        <span>
            [アップロード開始]ボタンをクリックしてアップロードします。
        </span>
    </p>
    <p class="mb-2 px-4 text-left flex items-start">
        <span class="mr-2">3. </span>
        <span>
            [データの更新]ボタンをクリックしてアップロードしたファイルのデータに更新します。
        </span>
    </p>
</div>
@endsection


@section('javascript')
    <script>
        $( document ).ready(function() {

            $("#uploadFileSelector").change(function(event){
                var input = event.target;

                var reader = new FileReader();
                reader.onload = function() {
                    $("#rslt_content").val(reader.result)
                };
                reader.readAsText(input.files[0]);
            })

            $("#submit_btn").click(function(){
                try{
                    data = JSON.parse($("#rslt_content").val());
                    $.ajax({
                        type: "POST",
                        url: "{{url('/petcrew/upload')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            cust_data: data
                        },
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                $("#alert_success").show()
                                $("#alert_danger").hide()
                            }
                        },
                        error: function (data) {
                            if(data.responseJSON && data.responseJSON.msg){
                                $("#alert_danger>span").html(data.responseJSON.msg)
                                $("#alert_success").hide()
                                $("#alert_danger").show()
                            }
                        }
                    });
                }catch (e){
                    $("#alert_success").hide()
                    $("#alert_danger>span").html("ファイルの形式が正確ではありません。")
                    $("#alert_danger").show()
                }

            })

        });
    </script>
@endsection
