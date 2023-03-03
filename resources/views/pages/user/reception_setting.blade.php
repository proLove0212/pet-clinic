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
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-3">順番予約を行う時間帯の設定を行います</h4>

                <div class="mb-3 row">
                    <label for="start_time1" class="col-md-3 col-form-label">午前のWeb予約開始時間                    </label>
                    <div class="col-md-9">
                        <input class="form-control" type="time" value="{{$setting->StartTime1}}" name="start_time1"
                            id="start_time1">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="end_time1" class="col-md-3 col-form-label">午前の診察終了時間                    </label>
                    <div class="col-md-9">
                        <input class="form-control" type="time" value="{{$setting->EndTime1}}" name="end_time1"
                            id="end_time1">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="start_time2" class="col-md-3 col-form-label">午後のWeb予約開始時間                    </label>
                    <div class="col-md-9">
                        <input class="form-control" type="time" value="{{$setting->StartTime2}}" name="start_time2"
                            id="start_time2">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="end_time2" class="col-md-3 col-form-label">午後の診察終了時間                    </label>
                    <div class="col-md-9">
                        <input class="form-control" type="time" value="{{$setting->EndTime2}}" name="end_time2"
                            id="end_time2">
                    </div>
                </div>


                <div class="mb-3">
                    <button id="submit_btn" class="btn btn-primary w-md">設定を保存</button>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-3">開始時間と終了時間の説明</h4>

                <div class="my-1 row">
                    <p>開始時間は、病院に直接来院した人を優先するために診察開始時間より30分ほど遅らせることをお勧めします。</p>
                </div>
                <div class="mb-1 row">
                    <p>終了時間は実際の診察終了時間を登録します。診察待ち人数から求めた終了予測時間が診察終了時間を過ぎてしまう場合はWebでの順番待ちが停止されます。</p>
                </div>
                <div class="mb-1 row">
                    <p>Webからの順番予約を行うかどうかはペットクルーカルテの起動時に毎朝行う。</p>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection


@section('javascript')

    <!-- Sweet Alerts js -->
    <script src="{{url('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js-->
    <script src="{{url('assets/js/pages/sweet-alerts.init.js')}}"></script>

    <script>
        $( document ).ready(function() {

            $("#submit_btn").click(function(){
                $.ajax({
                    type: "POST",
                    url: "{{url('/reception/settings')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        "start_time1": $("#start_time1").val(),
                        "end_time1": $("#end_time1").val(),
                        "start_time2": $("#start_time2").val(),
                        "end_time2": $("#end_time2").val(),
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            Swal.fire({
                                title: 'PetClinic',
                                text: data.msg,
                                icon: 'success',
                                confirmButtonText: 'はい'
                            })
                        }else{
                            Swal.fire({
                                title: 'PetClinic',
                                text: data.msg,
                                icon: 'info',
                                confirmButtonText: 'はい'
                            })
                            .then(()=>{
                                window.location.href = "{{url('/reception/settings')}}"
                            })
                        }
                    },
                    error: function (data) {
                        if(data.responseJSON && data.responseJSON.errors){

                        }
                    }
                });
            })
        });
    </script>
@endsection
