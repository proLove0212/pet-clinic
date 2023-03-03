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

                <h4 class="card-title mb-3">番号検索 </h4>

                <div class="row collapse show" id = 'search_dlg_acc'>
                    <div class="col-md-6">

                        <div class="my-3 row">
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="radio" name="no_radio" id="radio_cust_no" checked>
                                <label class="form-check-label" for="radio_cust_no">
                                    顧客番号
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value="" id="cust-no-input">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="form-check col-md-3">
                                <input class="form-check-input" type="radio" name="no_radio" id="radio_tel_no">
                                <label class="form-check-label" for="radio_tel_no">
                                    電話番号
                                </label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" value=""  placeholder="" id="tel-no-input" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-md waves-effect" id="search_btn">検索</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>検索時の注意</h6>
                        顧客番号もしくは電話番号を入力して検索してください。<br>
                        電話番号での検索はハイフンをつけてもつけなくてもOKです。<br>
                        電話番号での検索は登録されている全桁もしくは末尾4桁での検索のみ可能です。<br>
                        例：登録されている電話番号が03-1234-5678の場合<br>
                        <ul>
                            <li>031234-5678 で検索　=> 検索OK</li>
                            <li>1234-5678 で検索　 => 検索NG</li>
                            <li>5678 で検索　 => 検索OK</li>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div>

<!-- end row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">検索結果</h4>
                <p class="card-title-desc">

                </p>

                <div class="row collapse show" id = 'search_rslt_acc'>
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
                    url: "{{url('/search/phone')}}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        mode: $('#radio_cust_no').is(":checked") ? "cust" : "tel",
                        key: $('#radio_cust_no').is(":checked") ? $("#cust-no-input").val() : $("#tel-no-input").val()
                    },
                    dataType: 'json',
                    success: function (data) {
                        if(data.success){
                            $("#search_rslt_acc").html(data.html)

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

                        }
                    }
                });
            })
        });
    </script>
@endsection
