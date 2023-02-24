@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('content')
<div class="d-flex justify-content-end">
    <!-- Scrollable modal button -->
    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"> 追加</button>

    <!-- Scrollable modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">サーバーメンテナンス</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{url('admin/maintain')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3 row">
                            <label for="example-datetime-local-input" class="col-md-3 col-form-label">開始日時</label>
                            <div class="col-md-9">
                                <input class="form-control" name="start_time" type="datetime-local" id="example-datetime-local-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-datetime-local-input" class="col-md-3 col-form-label">終了日時</label>
                            <div class="col-md-9">
                                <input class="form-control" name="end_time" type="datetime-local" id="example-datetime-local-input">
                            </div>
                        </div>

                        <p class="p-3 mt-3">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" >キャンセル</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;"></th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($plans) != 0)
                                @foreach ($plans as $key => $plan_item)
                                    <tr>
                                        <td>
                                            <img src="{{url('/assets/images/avatar_m.png')}}" alt="" class="rounded-circle header-profile-user">
                                        </td>
                                        <td>
                                            {{$plan_item->from}}
                                        </td>
                                        <td>{{$plan_item->to}}</td>
                                        <td>
                                            Progress
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
                                        <div class="alert alert-secondary text-center mt-3" style="font-size: 24px"> <span class="bx bx-data"></span> データなし </div>
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

    <script type="text/javascript">
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
            var input = document.getElementById("search");
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    window.location.href = "{{url('/admin/users?key=')}}"+document.getElementById("search").value
                }
            });
        });

    </script>
@endsection
