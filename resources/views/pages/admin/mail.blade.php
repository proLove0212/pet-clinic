@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 メール連絡

@endsection

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>


<style>
    .select2-container{
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple{
        border-color: #E5E7EB !important;
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;

    }
    .select2-container--default.select2-container--focus .select2-selection--multiple{
        border-color: #1C64F2;
        border-width: 2px;
    }
</style>
@endsection

@section('content')

<div class="block w-full py-6 px-3 md:px-10  rounded-lg bg-white text-center shadow-lg dark:bg-neutral-700">
    <div class="flex justify-between mb-10">
        <a href="{{url('petcrew/admin')}}">
            <h3 class="font-black text-lg flex items-center cursor-pointer">
                <span class="material-symbols-outlined mr-2">
                    arrow_back_ios
                </span>
                メール連絡
            </h3>
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

    <form action="{{url('/petcrew/admin/contact/send')}}" method="post">
        @csrf

        <div class="md:flex items-start text-left mb-3">
            <p class="mt-2 mr-3 font-black  text-left md:text-right w-40">ユーザー番号</p>
            <div class=" md:flex-grow">
                <select class="select2  select2-multiple block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500"
                    multiple="multiple" id="receivers" name="receivers[]">
                    @foreach ($users as $user)
                        <option value="{{$user->MailAddress}}">{{$user->ClinicName}}</option>
                    @endforeach
                </select>
                @error('receivers')
                    <span class="mt-2 text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="md:flex items-start text-left mb-3">
            <p class="mt-3 mr-3 font-black  text-left md:text-right  w-40">主題</p>
            <div class=" md:flex-grow">
                <input type="text" id="subject" name="subject" value="{{old('subject')}}" class="block w-full px-3 py-2 rounded-lg border-2 border-gray-200 peer outline-none focus:border-indigo-500" placeholder="" required >
                @error('subject')
                    <span class="mt-2 text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="md:flex items-start text-left mb-3">
            <p class="mt-3 mr-3 font-black   text-left md:text-right  w-40">コンテンツ</p>
            <div class=" md:flex-grow">
                <textarea id="content" name="content" rows="4" class="block p-2.5 form-control w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..." required>

                </textarea>
                @error('content')
                    <span class="mt-2 text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>



        <div class="md:flex items-start text-left mb-3">
            <p class="mt-3 mr-3 font-black   text-left md:text-right  w-40"></p>
            <div class=" md:flex-grow">
                <div class="w-full px-3 mb-5 flex justify-between">
                    <button id="send_pre"
                        type="button"
                        class="flex items-center rounded-full bg-success px-6  text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)]">
                            <span class="material-symbols-outlined mr-3">
                            send
                            </span>
                        転送
                    </button>
                    <button type="submit" id="send" class="hidden"></button>
                    <i class="text-lg p-3 cursor-pointer hover:text-danger" id="delete_btn">
                        <span class="material-symbols-outlined">
                            delete
                        </span>
                    </i>
                </div>
            </div>
        </div>

    </form>

</div>

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




{{-- @extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 メール連絡
@endsection

@section('stylesheet')
<link href="{{url('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert-->
<link href="{{url('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <div class="me-2">
                    <h5 class="card-title mb-4">メール作成</h5>
                </div>

                <div class="mb-3">
                    <select class="select2 form-control select2-multiple"
                        multiple="multiple" id="receivers">
                        @foreach ($users as $user)
                            <option value="{{$user->MailAddress}}">{{$user->ClinicName}}</option>
                        @endforeach
                    </select>
                    <div class="msg-danger mt-1"  id="receiver_error" > </div>
                </div>

                <div class="mb-3">
                    <input type="text" id="subject" class="form-control" placeholder="Subject">
                    <div class="msg-danger mt-1"  id="subject_error" > </div>
                </div>
                <div class="mb-5">
                    <textarea id="email-editor" name="area"></textarea>
                    <div class="msg-danger mt-1"  id="content_error" > </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button id="submit_btn" class="btn btn-primary waves-effect waves-light">
                        送信
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')

<!--tinymce js-->
<script src="{{url('assets/libs/tinymce/tinymce.min.js')}}"></script>

<!-- Sweet Alerts js -->
<script src="{{url('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- email editor init -->
<script src="{{url('assets/js/pages/email-editor.init.js')}}"></script>
<script src="{{url('assets/libs/select2/js/select2.min.js')}}"></script>

<script>
    $( document ).ready(function() {
        $(".select2").select2()


        $("#submit_btn").click(function () {
            tinyMCE.triggerSave();


            Swal.fire({
                title: 'PetClinic',
                text: '送信しますか？',
                icon: 'info',
                confirmButtonText: 'はい'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('admin/mail/send')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            receivers: $('#receivers').val(),
                            subject: $('#subject').val(),
                            content: $('#email-editor').val()
                        },
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                window.location.href = "{{url('admin/mail')}}"
                            }
                        },
                        error: function (data) {
                            if(data.responseJSON && data.responseJSON.errors){
                                errors = data.responseJSON.errors;

                                if(errors.receivers && typeof errors.receivers[0] == "string"){
                                    $("#receiver_error").html(errors.receivers[0])
                                }else if(errors.receivers && typeof errors.receivers[0] == "object"){
                                    var keys = Object.keys(errors.receivers[0]);

                                    const element = errors.receivers[0][keys[0]];
                                    $("#receiver_error").html(element)
                                }else{
                                    $("#receiver_error").html("")
                                }


                                if(errors.subject && typeof errors.subject[0] == "string"){
                                    $("#subject_error").html(errors.subject[0])
                                }else if(errors.subject && typeof errors.subject[0] == "object"){
                                    var keys = Object.keys(errors.subject[0]);

                                    const element = errors.subject[0][keys[0]];
                                    $("#subject_error").html(element)
                                }else{
                                    $("#subject_error").html("")
                                }


                                if(errors.content && typeof errors.content[0] == "string"){
                                    $("#content_error").html(errors.content[0])
                                }else if(errors.content && typeof errors.content[0] == "object"){
                                    var keys = Object.keys(errors.content[0]);

                                    const element = errors.content[0][keys[0]];
                                    $("#content_error").html(element)
                                }else{
                                    $("#content_error").html("")
                                }
                            }

                        }
                    });
                }
            })
        })
    });
</script>
@endsection --}}
