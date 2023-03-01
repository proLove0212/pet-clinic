@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

    <!-- Sweet Alert-->
    <link href="{{url('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">ユーザーの変更</h4>
                <p class="card-title-desc">

                </p>
                <div class="row my-3">
                    <label class="col-sm-3 col-form-label">ユーザーの変更</label>
                    <div class="col-sm-9">
                      <input type="text range" id="PeaksUserNo_input" value="{{$user->PeaksUserNo}}" class="form-control" placeholder="Eピークス内のユーザー番号 (000000)">
                      <div class="msg-danger" id="PeaksUserNo_error"> </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">病院名</label>
                    <div class="col-sm-9">
                      <input type="text" id="ClinicName_input" value="{{$user->ClinicName}}" class="form-control" placeholder="病院の名前を入力してください。">
                      <div class="msg-danger" id="ClinicName_error" > </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">電話番号</label>
                    <div class="col-sm-9">
                      <input type="text" id="TelNo_input" value="{{$user->TelNo}}" class="form-control"  placeholder="ハイフンあり">
                      <div class="msg-danger" id="TelNo_error"> </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">メール</label>
                    <div class="col-sm-9">
                        <input type="email" id="MailAddress_input" value="{{$user->MailAddress}}" class="form-control"  placeholder="メールアドレスを入力。">
                        <div class="msg-danger"  id="MailAddress_error" > </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">オプション</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    @if ($user->PatientRegOpt)
                                        <input class="form-check-input" type="checkbox" id="PatientRegOpt"  checked>
                                    @else
                                        <input class="form-check-input" type="checkbox" id="PatientRegOpt">
                                    @endif
                                    <label class="form-check-label" for="PatientRegOpt">診察券オプション</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                    @if ($user->ReceptionOpt)
                                        <input class="form-check-input" type="checkbox"  id="ReceptionOpt" checked>
                                    @else
                                        <input class="form-check-input" type="checkbox"  id="ReceptionOpt">
                                    @endif
                                    <label class="form-check-label" for="ReceptionOpt">順番予約オプション</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">メモ情報</label>
                    <div class="col-sm-9">
                        <textarea id="Memo" cols="30" rows="5" class="form-control">{{$user->Memo}}</textarea>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button id="submit_btn" class="btn btn-primary waves-effect waves-light">
                        変更
                    </button>
                    <button id="clear_btn" class="btn btn-secondary waves-effect">
                        キャンセル
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">顧客</p>
                        <h4 class="mb-0">{{number_format($cust_cnt, 0, ".", ",")}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bx bx-group font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">ペット</p>
                        <h4 class="mb-0">{{number_format($pet_cnt, 0, ".", ",")}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center ">
                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="mdi mdi-dog-side font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">順番受付</p>
                        <h4 class="mb-0">{{number_format($recept_cnt, 0, ".", ",")}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="mdi mdi-cash-register font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection


@section('javascript')
    <!-- Sweet Alerts js -->
    <script src="{{url('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js-->
    <script src="{{url('assets/js/pages/sweet-alerts.init.js')}}"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $("#submit_btn").click(function(){
                Swal.fire({
                    title: 'PetClinic',
                    text: '新規登録',
                    icon: 'info',
                    confirmButtonText: 'はい'
                }).then((result) => {
                    if (result.value) {

                        $.ajax({
                            type: "POST",
                            url: "{{url('/admin/users/edit/'.$user->id)}}",
                            data: {
                                _token: "{{ csrf_token() }}",
                                PeaksUserNo: $("#PeaksUserNo_input").val(),
                                ClinicName: $("#ClinicName_input").val(),
                                TelNo: $("#TelNo_input").val(),
                                MailAddress: $("#MailAddress_input").val(),
                                PatientRegOpt:  $('#PatientRegOpt').is(":checked"),
                                ReceptionOpt:  $('#ReceptionOpt').is(":checked"),
                                Memo: $("Memo_input").val(),
                            },
                            dataType: 'json',
                            success: function (data) {
                                if(data.success){
                                    Swal.fire({
                                        title: 'PetClinic',
                                        text: '変更されました。',
                                        icon: 'success',
                                    }).then((result) => {
                                        if (result.value) {
                                            $("#clear_btn").click();
                                        }
                                    })
                                }
                            },
                            error: function (data) {
                                if(data.responseJSON && data.responseJSON.errors){
                                    var errors = data.responseJSON.errors;

                                    if(errors.PeaksUserNo && typeof errors.PeaksUserNo[0] == "string"){
                                        $("#PeaksUserNo_error").html(errors.PeaksUserNo[0])
                                    }else if(errors.PeaksUserNo && typeof errors.PeaksUserNo[0] == "object"){
                                        var keys = Object.keys(errors.PeaksUserNo[0]);

                                        const element = errors.PeaksUserNo[0][keys[0]];
                                        $("#PeaksUserNo_error").html(element)
                                    }else{
                                        $("#PeaksUserNo_error").html("")
                                    }

                                    if(errors.ClinicName && typeof errors.ClinicName[0] == "string"){
                                        $("#ClinicName_error").html(errors.ClinicName[0])
                                    }else if(errors.ClinicName && typeof errors.ClinicName[0] == "object"){
                                        var keys = Object.keys(errors.ClinicName[0]);

                                        const element = errors.ClinicName[0][keys[0]];
                                        $("#ClinicName_error").html(element)
                                    }else{
                                        $("#ClinicName_error").html("")
                                    }

                                    if(errors.TelNo && typeof errors.TelNo[0] == "string"){
                                        $("#TelNo_error").html(errors.TelNo[0])
                                    }else if(errors.TelNo && typeof errors.TelNo[0] == "object"){
                                        var keys = Object.keys(errors.TelNo[0]);

                                        const element = errors.TelNo[0][keys[0]];
                                        $("#TelNo_error").html(element)
                                    }else{
                                        $("#TelNo_error").html("")
                                    }

                                    if(errors.MailAddress && typeof errors.MailAddress[0] == "string"){
                                        $("#MailAddress_error").html(errors.MailAddress[0])
                                    }else if(errors.MailAddress && typeof errors.MailAddress[0] == "object"){
                                        var keys = Object.keys(errors.MailAddress[0]);

                                        const element = errors.MailAddress[0][keys[0]];
                                        $("#MailAddress_error").html(element)
                                    }else{
                                        $("#MailAddress_error").html("")
                                    }
                                }
                            }
                        });
                    }
                })
            })


            $("#clear_btn").click(function(){
                window.location.href = "{{url('admin/users')}}"
            })


        });

    </script>
@endsection
