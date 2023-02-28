@extends('layout.main')

@section('title')
    {{$title}}
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

<!-- Sweet alert init js-->
<script src="{{url('assets/js/pages/sweet-alerts.init.js')}}"></script>

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
                            console.log(data)
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
@endsection
