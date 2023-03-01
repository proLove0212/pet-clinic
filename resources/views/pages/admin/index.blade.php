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

                <div class="me-2">
                    <h5 class="card-title mb-4">ユーザーリスト</h5>
                </div>
                <div class="row ms-auto">
                    <!-- App Search-->
                    <form class="app-search d-lg-block">
                        <div class="position-relative">
                            <input type="text" id="search" class="form-control" placeholder="Search..." value = "{{$key}}">
                            <span class="bx bx-search-alt"></span>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 70px;"></th>
                                <th scope="col">病院名</th>
                                <th scope="col" style="min-width: 100px">メールアドレス</th>
                                <th scope="col">電話番号</th>
                                <th scope="col">顧客</th>
                                <th scope="col">ペット</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($users) != 0)
                                @foreach ($users as $key => $user_item)
                                    <tr>
                                        <td>
                                            <img src="{{url('/assets/images/avatar_m.png')}}" alt="" class="rounded-circle header-profile-user">
                                        </td>
                                        <td>
                                            <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{$user_item->ClinicName}}</a></h5>
                                            <p class="text-muted mb-0">{{$user_item->ClinicID}}</p>
                                        </td>
                                        <td>{{$user_item->MailAddress}}</td>
                                        <td>
                                            <?php

                                                try {
                                                    $decrypted = Crypt::decryptString($user_item->TelNo);
                                                    echo $decrypted;
                                                } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                                    echo "Error";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            {{$user_item->customer_cnt}}
                                        </td>
                                        <td>
                                            {{$user_item->pet_cnt}}
                                        </td>
                                        <td>
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                <li class="list-inline-item px-2">
                                                    <a href="{{url('admin/users/edit?uid='.$user_item->ClinicID)}}" title="Message"><i class="bx bx-edit-alt text-primary"></i></a>
                                                </li>
                                                <li class="list-inline-item px-2">
                                                    <a onclick="deleteUser('{{$user_item->ClinicID}}')" ><i class="bx bx-trash-alt text-danger"></i></a>
                                                </li>

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center mt-3" style="font-size: 24px"> <span class="bx bx-data"></span> データなし</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if (count($users) != 0)
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
        function deleteUser(id) {
            Swal.fire({
                title: 'PetClinic',
                text: '続行しますか？',
                icon: 'info',
                confirmButtonText: 'はい'
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{url('/admin/users/delete?uid=')}}"+id,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                Swal.fire({
                                    title: 'PetClinic',
                                    text: 'ユーザーが削除されました。',
                                    icon: 'success',
                                }).then((result)=>{
                                    if(result.value){
                                        window.location.href = "{{url('/admin/users')}}"
                                    }
                                })
                            }
                        },
                        error: function (data) {
                            if(data.responseJSON && data.responseJSON.errors){
                                var errors = data.responseJSON.errors;

                                if(typeof errors.PeaksUserNo[0] == "string"){
                                    $("#PeaksUserNo_error").html(errors.PeaksUserNo[0])
                                }else if(typeof errors.PeaksUserNo[0] == "object"){
                                    var keys = Object.keys(errors.PeaksUserNo[0]);

                                    const element = errors.PeaksUserNo[0][keys[0]];
                                    $("#PeaksUserNo_error").html(element)
                                }else{
                                    $("#PeaksUserNo_error").html("")
                                }

                                if(typeof errors.ClinicName[0] == "string"){
                                    $("#ClinicName_error").html(errors.ClinicName[0])
                                }else if(typeof errors.ClinicName[0] == "object"){
                                    var keys = Object.keys(errors.ClinicName[0]);

                                    const element = errors.ClinicName[0][keys[0]];
                                    $("#ClinicName_error").html(element)
                                }else{
                                    $("#ClinicName_error").html("")
                                }

                                if(typeof errors.TelNo[0] == "string"){
                                    $("#TelNo_error").html(errors.TelNo[0])
                                }else if(typeof errors.TelNo[0] == "object"){
                                    var keys = Object.keys(errors.TelNo[0]);

                                    const element = errors.TelNo[0][keys[0]];
                                    $("#TelNo_error").html(element)
                                }else{
                                    $("#TelNo_error").html("")
                                }

                                if(typeof errors.MailAddress[0] == "string"){
                                    $("#MailAddress_error").html(errors.MailAddress[0])
                                }else if(typeof errors.MailAddress[0] == "object"){
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
