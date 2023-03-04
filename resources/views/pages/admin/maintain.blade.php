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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">メンテナンス  </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 row">
                            <label for="example-datetime-local-input" class="col-md-3 col-form-label">開始日時</label>
                            <div class="col-md-9">
                                <input class="form-control" id="start_time" type="datetime-local" >

                                <div class="msg-danger" id="start_time_msg"></div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-datetime-local-input" class="col-md-3 col-form-label">終了日時</label>
                            <div class="col-md-9">
                                <input class="form-control" id="end_time" type="datetime-local">

                                <div class="msg-danger" id="end_time_msg"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">メモ</label>
                            <div class="col-md-9">
                                <input type="text range" id="memo" class="form-control" value="" placeholder="">
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <button type="button" id='btn_save' class="btn btn-primary">保存</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="">
                            WEB情報検索サービスのサイトは[STARTDATE]にサーバーのメンテナンスを実施します。
                            <br>
                            停止に伴い、下記の通り情報検索サービスを一時休止いたします。
                            <br>
                            <B>■サービスの休止日時</B><br>
                            　開始：[STARTDATETIME]<br>
                            　終了：[ENDDATETIME]<br>
                            <br>
                            ※作業の状況により終了時間が前後することがございますのでご了承ください。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start mb-3">
                    <div class="me-2">
                        <h5 class="card-title mb-4">メンテナンスリスト  </h5>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="text-muted font-size-16" role="button" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                            <i class="mdi mdi-lock-plus-outline"></i>
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;"></th>
                                <th scope="col">開始</th>
                                <th scope="col">終了</th>
                                <th scope="col">メモ</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($plans) != 0)
                                @foreach ($plans as $key => $plan_item)
                                    <tr>
                                        <td>
                                            <?php
                                                $now = \Carbon\Carbon::now();
                                                $from = \Carbon\Carbon::parse($plan_item->from);
                                                $to = \Carbon\Carbon::parse($plan_item->to);

                                                if($now->greaterThan($to)){
                                                    echo "
                                                        <div class='flex-shrink-0 align-self-center me-3'>
                                                            <i class='mdi mdi-check-all text-success font-size-20'></i>
                                                        </div>
                                                        ";
                                                }else if($now->lessThan($from)){
                                                    echo "
                                                        <div class='flex-shrink-0 align-self-center me-3'>
                                                            <i class='mdi mdi-progress-wrench text-warning font-size-20'></i>
                                                        </div>
                                                        ";
                                                }else{
                                                    echo "
                                                        <div class='flex-shrink-0 align-self-center me-3'>
                                                            <i class='mdi mdi-tools text-primary font-size-20'></i>
                                                        </div>
                                                        ";
                                                }
                                            ?>
                                        </td>
                                        <td>

                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{date('Y-m-d', strtotime($plan_item->from))}}</a></h5>
                                            <p class="text-muted mb-0">{{date('h:i:s', strtotime($plan_item->from))}}</p>

                                        </td>
                                        <td>
                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{date('Y-m-d', strtotime($plan_item->to))}}</a></h5>
                                            <p class="text-muted mb-0">{{date('h:i:s', strtotime($plan_item->to))}}</p>
                                        </td>
                                        <td>
                                            {!! $plan_item->memo !!}
                                        </td>
                                        <td>
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                <li class="list-inline-item px-2">
                                                    <form action="{{url('admin/maintain/delete/'.$plan_item->id)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a onclick="deletePlan('{{$plan_item->id}}')" ><i class="bx bx-trash-alt text-danger"></i></a>
                                                        <button type="submit" class="d-none" id="delete_plan_{{$plan_item->id}}" ></button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center mt-3" style="font-size: 24px"> <span class="bx bx-data"></span> データなし </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if (count($plans) != 0)
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="pagination pagination-rounded justify-content-center mt-4">
                                @foreach ($links as $key => $item)
                                    @if (array_search($key, array_keys($links)) == 0)
                                        <li class="page-item {{$item->active ? '' : ''}}">
                                            <a href="{{$item->url}}" class="page-link"><i class="bx bx-chevron-left"></i></a>
                                        </li>
                                    @elseif (array_search($key, array_keys($links)) == count($links) - 1)
                                        <li class="page-item {{$item->active ? '' : ''}}">
                                            <a href="{{$item->url}}" class="page-link"><i class="bx bx-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item {{$item->active ? 'active' : ''}}">
                                            <a href="{{$item->url}}" class="page-link">{{$item->label}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
    <!-- Sweet Alerts js -->
    <script src="{{url('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js-->
    <script src="{{url('assets/js/pages/sweet-alerts.init.js')}}"></script>

    <script>

        function deletePlan(id) {
            Swal.fire({
                title: 'PetClinic',
                text: '続行しますか？',
                icon: 'info',
                confirmButtonText: 'はい'
            }).then((result) => {
                if (result.value) {
                    $("#delete_plan_"+id).click();
                }
            })
        }

        $( document ).ready(function() {
            $("#btn_close").click(function(){
                $("#exampleModalScrollable").modal('toggle');
            })
            $("#btn_save").click(function (e) {

                $.ajax({
                    type: "POST",
                    url: "{{url('admin/maintain')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        start_time: jQuery('#start_time').val(),
                        end_time: jQuery('#end_time').val(),
                        memo: jQuery('#memo').val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            window.location.href = "{{url('admin/maintain')}}"
                            $("#btn_close").click();
                        }
                    },
                    error: function (data) {
                        console.log(data)
                        if(data.responseJSON && data.responseJSON.errors){
                            if(data.responseJSON.errors.start_time)
                                document.getElementById("start_time_msg").innerHTML = data.responseJSON.errors.start_time[0];

                            if(data.responseJSON.errors.end_time)
                                document.getElementById("end_time_msg").innerHTML = data.responseJSON.errors.end_time[0];
                        }

                    }
                });
            });
        });
    </script>
@endsection

