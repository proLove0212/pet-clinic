@extends('layout.main')

@section('title')
ペットクルーカルテ　顧客情報検索 メンテナンス
@endsection

@section('stylesheet')

@endsection

@section('content')

<h3 class="font-black text-xl md:text-2xl mb-10">
    メンテナンススケジュール管理を進めます。
</h3>

<div class="md:flex items-start">
    <div class="pr-3 w-full md:w-96 lg:w-1/2 border-0 border-b-2 md:border-b-0 md:border-r-2 md:border-r-gray-50 md:pb-12 mt-3">

        <form action="{{url('/petcrew/admin/maintain')}}" method="post">
            @csrf
            <div class="items-start text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left">開始日時</p>
                <div class="w-full">
                    <input datepicker type="datetime-local" name="start_time" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="02/29/2023">

                    @error('start_time')
                        <span class="mt-4 text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left">終了日時</p>
                <div class="w-full">
                    <input datepicker type="datetime-local" name="end_time" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="02/29/2023">

                    @error('end_time')
                        <span class="mt-4 text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="text-left mb-3">
                <p class="my-3 mr-3 font-black  text-left">メモ</p>
                <textarea id="memo" name="memo" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
            </div>

            <div class="mb-3">
                <button id="send_pre"
                    type="submit"
                    class="mx-auto rounded-full bg-success px-6 py-2 w-full max-w-xs  text-lg font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)]">
                    追加
                </button>
            </div>
        </form>

    </div>
    <div class="w-full lg:flex-grow">
        <p class="text-left px-3 py-10 font-bold">
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

        <div class="flex items-center p-4 text-xl font-black text-indigo-800   bg-indigo-100 " role="alert">
            <span class="material-symbols-outlined mr-2 font-black">
                checklist
            </span>
            <span class="font-black"> メンテナンスリスト</span>
        </div>

        @if (count($plans))
            @foreach ($plans as $plan_item)
                <div class="px-6 pt-4 pb-0 border-2 border-gray-100 hover:border-l-red-500 hover:bg-gray-100 cursor-pointer">
                    <p class="text-sm mb-3">
                        <span class="font-black mr-3">開始:</span> <span class="text-xs md:text-sm">{{date('Y年m月d日 h時i分s秒', strtotime($plan_item['from']))}}</span>
                    </p>
                    <p class="text-sm mb-3">
                        <span class="font-black mr-3">終了:</span> <span class="text-xs md:text-sm">{{date('Y年m月d日 h時i分s秒', strtotime($plan_item['to']))}}</span>
                    </p>
                    <p class="text-sm mb-3">
                        <span class="font-black mr-3">メモ:</span> <span class="text-xs md:text-sm">{{$plan_item['memo']}}</span>
                    </p>
                    <p class="text-sm mb-3 flex justify-between items-center">
                        <span>
                            <span class="font-black mr-3">状態:</span>

                            <?php
                                $now = \Carbon\Carbon::now();
                                $from = \Carbon\Carbon::parse($plan_item['from']);
                                $to = \Carbon\Carbon::parse($plan_item['to']);

                                if($now->greaterThan($to)){
                                    echo "
                                        <span class='text-xs md:text-sm px-3 py-1 rounded-full bg-gray-500 text-white '>  終了 </span>
                                        ";
                                }else if($now->lessThan($from)){
                                    echo "
                                        <span class='text-xs md:text-sm px-3 py-1 rounded-full bg-orange-500 text-white '>  計画 </span>
                                        ";
                                }else{
                                    echo "
                                        <span class='text-xs md:text-sm px-3 py-1 rounded-full bg-green-500 text-white '>  進行中 </span>
                                        ";
                                }
                            ?>
                        </span>

                        <span class="p-3 cursor-pointer" onclick="document.getElementById('delete_plan_{{$plan_item['id']}}').click()">
                            <span class="material-symbols-outlined">
                                delete
                            </span>
                        </span>
                    </p>

                    <form action="{{url('/petcrew/admin/maintain/delete/'.$plan_item['id'])}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="hidden" id="delete_plan_{{$plan_item['id']}}"></button>
                    </form>

                </div>
            @endforeach

            <div class="flex justify-center">

                <nav aria-label="Page navigation example" class="mt-5 ">
                    <ul class="inline-flex items-center -space-x-px">
                        @foreach ($links as $key => $item)
                            @if (array_search($key, array_keys($links)) == 0)
                                <li>
                                    <a href="{{$item['url']}}" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </li>
                            @elseif (array_search($key, array_keys($links)) == count($links) - 1)
                                <li>
                                    <a href="{{$item['url']}}" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{$item['url']}}" class="px-3 py-2 leading-tight {{$item['active'] ? 'text-primary bg-gray-300' : 'text-gray-500'}} bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{$item['label']}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
            </div>
        @else
        <div class="px-6 pt-4 pb-0 text-center border-2 border-gray-100  hover:bg-gray-100 cursor-pointer">
            <span class="material-symbols-outlined">
                speaker_notes_off
            </span>
            <p class="mb-2 text-medium">メンテナンススケジュールはありません。</p>

        </div>
        @endif

        <div class="mb-10">

        </div>
    </div>
</div>
{{--
<div id="delete_dlg" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="my-5 text-lg font-normal text-gray-500 dark:text-gray-400">削除しますか？</h3>
                <form action="{{url('/petcrew/admin/users/delete/'.$user['ClinicID'])}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button data-modal-hide="delete_dlg" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        確認
                    </button>
                    <button data-modal-hide="delete_dlg" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">キャンセル</button>

                </form>
            </div>
        </div>
    </div>
</div>

<div id="pwd_dlg" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="my-5 text-lg font-normal text-gray-500 dark:text-gray-400">パスワードを再発行します。</h3>
                <form action="{{url('/petcrew/admin/users/pwd_reset/'.$user['ClinicID'])}}" method="post">
                    @csrf
                    <button data-modal-hide="pwd_dlg" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        確認
                    </button>
                    <button data-modal-hide="pwd_dlg" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">キャンセル</button>
                </form>
            </div>
        </div>
    </div>
</div> --}}

{{--
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
</div> --}}

@endsection


@section('javascript')
{{--
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
    </script> --}}
@endsection

