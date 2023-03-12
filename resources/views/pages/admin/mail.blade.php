@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 メール連絡

@endsection

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


<style>

</style>
@endsection

@section('content')

<h3 class="font-black text-xl md:text-2xl mb-10">
    ユーザーへの一斉メール。
</h3>

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

<form action="{{route('admin.mail')}}" method="post">
@csrf

    <div class="md:flex items-start text-left mb-3">
        <p class="mt-2 mr-3 font-black  text-left md:text-right w-40">ユーザー番号</p>
        <div class=" md:flex-grow">
            <select class="select2  select2-multiple block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500"
                multiple="multiple" id="receivers" name="receivers[]">
                @foreach ($users as $user)
                    <option value="{{$user->email}}">{{$user->ClinicName}}</option>
                @endforeach
            </select>
            @error('receivers')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black  text-left md:text-right  w-40">主題</p>
        <div class=" md:flex-grow">
            <input type="text" id="subject" name="subject" value="{{old('subject')}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
            @error('subject')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>

    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black   text-left md:text-right  w-40">コンテンツ</p>
        <div class=" md:flex-grow">
            <textarea id="content" name="content" rows="4" class="block p-2.5 form-control w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required>

            </textarea>
            @error('content')
                <span class="mt-2 text-danger text-sm font-black">{{$message}}</span>
            @enderror
        </div>
    </div>



    <div class="md:flex items-start text-left mb-3">
        <p class="my-3 mr-3 font-black   text-left md:text-right  w-40"></p>
        <div class=" md:flex-grow">
            <div class="w-full px-3 mb-5 flex justify-center">
                <button id="send_pre"
                    type="button"
                    class="flex  max-w-xs items-center rounded-full bg-success px-6 py-2  text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)]">
                        <span class="material-symbols-outlined mr-3">
                        send
                        </span>
                    転送
                </button>
                <button type="submit" id="send" class="hidden"></button>
            </div>
        </div>
    </div>

</form>


@endsection


@section('javascript')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.2/tinymce.min.js"></script>

    <script type="text/javascript">
        $( document ).ready(function() {

            $(".select2").select2()


            tinymce.init({
                selector: '#content',
                setup: function (editor) {
                    editor.on('init', function (e) {
                        editor.setContent('<p>Hello!</p>');
                    });
                }
            });


            $("#send_pre").click(function(){
                tinyMCE.triggerSave();
                console.log($("#receivers").val())
                $("#send").click();
            })

            $("#delete_btn").click(function(){
                $("#receivers").val(null).trigger('change');
                $("#subject").val("");
                $("content").val("")
                tinymce.get("content").setContent('<p>Hello!</p>');
            })
        });
    </script>

@endsection

