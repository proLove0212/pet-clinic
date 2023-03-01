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

                <h4 class="card-title mb-3">名前検索 </h4>

                <div class="row collapse show" id = 'search_dlg_acc'>
                    <div class="col-md-6">

                        <div class="my-3 row">
                            <label for="example-text-input" class="col-md-4 col-form-label">顧客姓</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="" id="cust_family_name-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-4 col-form-label">顧客名</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="" id="cust_name-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-4 col-form-label">顧客姓ふりがな</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="" id="cust_family_name_furigana-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-4 col-form-label">顧客名ふりがな</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="" id="cust_name_furigana-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-4 col-form-label">住所</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="" id="address-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-4 col-form-label">ペット名</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" value="" id="pet_name-input">
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-md waves-effect" id="search_btn">検索</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>検索時の注意</h6>
                        顧客姓名での検索は各検索枠毎に完全一致検索です。<br>
                        住所とペット名での検索に限りあいまい検索（住所の一部やペット名の一部があっていると検索）されます。<br>
                        検索条件を入力する際はスペースを入れないでください。<br>
                        複数の検索条件を入力した場合はANDで絞り込み検索が行われます。<br>
                        例：<br>
                        <ul>
                            <li>顧客姓が「林原」の場合「林」や「原」で検索してもNG</li>
                            <li>ペット名が「小太郎」の場合、「太郎」で検索してもOK</li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>

<div class="text-center">
    <i class="dripicons-chevron-up font-size-20 waves-effect" id="toggler"></i>
</div>

<!-- end row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">検索結果</h4>
                <p class="card-title-desc">

                </p>

                <div class="row collapse" id = 'search_rslt_acc'>
                    <div class="text-center mt-3" style="font-size: 24px"> <span class="bx bx-data"></span> データなし </div>
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

            $("#radio_cust_no").click(function(){
                $("#tel-no-input").val("")
                $("#cust-no-input").attr("disabled", false)
                $("#tel-no-input").attr("disabled", true)
            })

            $("#radio_tel_no").click(function(){
                $("#cust-no-input").val("")
                $("#cust-no-input").attr("disabled", true)
                $("#tel-no-input").attr("disabled", false)
            })

            $("#search_btn").click(function(){
                $.ajax({
                    type: "POST",
                    url: "{{url('/search/name')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        cust_family_name: $("#cust_family_name").val(),
                        cust_name: $("#cust_name").val(),
                        cust_family_name_furigana: $("#cust_family_name_furigana").val(),
                        cust_name_furigana: $("#cust_name_furigana").val(),
                        address: $("#address").val(),
                        pet_name: $("#pet_name").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            $("#search_rslt_acc").html(data.html)
                            $("#toggler").click()
                        }else{
                            Swal.fire({
                                title: 'PetClinic',
                                text: 'データなし',
                                icon: 'info',
                                confirmButtonText: 'はい'
                            })

                            $("#search_rslt_acc").html("<div class='text-center mt-3' style='font-size: 24px'> <span class='bx bx-data'></span> データなし </div>")
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

            $("#toggler").click(function(){
                $("#toggler").toggleClass("dripicons-chevron-up")
                $("#toggler").toggleClass("dripicons-chevron-down")
                $("#search_dlg_acc").collapse("toggle")
                $("#search_rslt_acc").collapse("toggle")
            })
        });
    </script>
@endsection
