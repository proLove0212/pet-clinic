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

                <h4 class="card-title mb-3">順番予約の来院理由の設定を行います</h4>

                <form action="{{url('/reception/reason')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">来院理由の                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="{{old('reason_name')}}" name="reason_name">
                            @error('reason_name')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-number-input" class="col-md-2 col-form-label">1枠時間                   </label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" value="{{old('reason_time')}}"  placeholder="Enter Number" name="reason_time">
                            @error('reason_time')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                            <p class="mt-1">Webからの順番予約を行うかどうかはペットクルーカルテの起動時に毎朝行う。</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-md">来院理由の追加</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>

<!-- end row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">来院理由</h4>
                <p class="card-title-desc">

                </p>

                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th style="min-width:150px">来院理由</th>
                                <th style="min-width:75px">枠時間</th>
                                <th style="min-width:100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ( count($reasons) == 0 )
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center" style="font-size: 16px"> <span class="bx bx-data"></span> データなし </div>
                                    </td>
                                </tr>
                            @else
                                @foreach ($reasons as $key => $reason)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td> {{$reason->VisitReason}}</td>
                                        <td>{{$reason->TakeTime}}分</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                @if (--$key == 0)
                                                    <button type="submit" class="btn btn-outline-secondary">上に移動</button>
                                                @else
                                                    <form action="{{url('/reception/reason/order')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cur_id" value="{{$reason->id}}">
                                                        <input type="hidden" name="target_id" value="{{$reasons[$key-1]->id}}">
                                                        <button type="submit" class="btn btn-outline-secondary">上に移動</button>
                                                    </form>

                                                @endif
                                                @if ($key == count($reasons) - 1 )
                                                    <form action="" method="post">
                                                        <button type="submit" class="btn btn-outline-secondary">下に移動</button>
                                                    </form>
                                                @else
                                                    <form action="{{url('/reception/reason/order')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="cur_id" value="{{$reason->id}}">
                                                        <input type="hidden" name="target_id" value="{{$reasons[$key+1]->id}}">
                                                        <button type="submit" class="btn btn-outline-secondary">下に移動</button>
                                                    </form>
                                                @endif
                                                <form action="{{url('/reception/reason/'.$reason->id)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger">削除</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
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

    <script>
        $( document ).ready(function() {

            $("#submit_btn").click(function(){
                $.ajax({
                    type: "POST",
                    url: "{{url('/reception/reason')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: $("#name_input").val(),
                        time: $("#time_input").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){

                        }else{
                            Swal.fire({
                                title: 'PetClinic',
                                text: 'データなし',
                                icon: 'info',
                                confirmButtonText: 'はい'
                            })


                        }
                    },
                    error: function (data) {
                        if(data.responseJSON && data.responseJSON.errors){
                            var errors = data.responseJSON.errors;
                            console.log(errors)
                        }
                    }
                });
            })
        });
    </script>
@endsection
