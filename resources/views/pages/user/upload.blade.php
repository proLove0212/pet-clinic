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

                <h4 class="card-title mb-3">ファイルアップロード（一括データアップロード）</h4>

                <div class="input-group mb-2">
                    <input type="file" class="form-control" id="uploadFileSelector">
                    <label class="input-group-text" for="inputGroupFile02">ファイル選択</label>
                </div>

                <div class="mb-3 text-warning">
                    <i class="dripicons-warning"></i>
                    ファイルのアップロードはPCから行ってください。スマートホンやタブレットからのアップロードは行わないでください。
                </div>

                <div class="mb-3">
                    データファイルのアップロード：
                    <ul>
                        <li>ボタンをクリックしてアップロードするファイルを指定します。このファイルは、｢ペットクルーカルテ６ Web検索用データ出力｣から書き出されたファイルです。</li>
                        <li>[アップロード開始]ボタンをクリックしてアップロードします。</li>
                        <li>[データの更新]ボタンをクリックしてアップロードしたファイルのデータに更新します。</li>
                    </ul>
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

                <h4 class="card-title mb-3">アップロードデータ</h4>

                <div class="mb-3">
                    <textarea class="form-control" id="rslt_content" cols="30" rows="10"></textarea>
                </div>

                <div class="mb-3" id="btn_content">
                    <button id="submit_btn" class="btn btn-primary w-md">アップロード開始</button>
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

            $("#uploadFileSelector").change(function(event){
                var input = event.target;

                var reader = new FileReader();
                reader.onload = function() {
                    $("#rslt_content").val(reader.result)
                };
                reader.readAsText(input.files[0]);
            })

            $("#submit_btn").click(function(){
                try{
                    data = JSON.parse($("#rslt_content").val());
                    $.ajax({
                        type: "POST",
                        url: "{{url('/upload')}}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            cust_data: data
                        },
                        dataType: 'json',
                        success: function (data) {
                            if(data.success){
                                Swal.fire({
                                    title: 'PetClinic',
                                    text:  "登録されました。",
                                    icon: 'success',
                                    confirmButtonText: 'はい'
                                })
                            }
                        },
                        error: function (data) {
                            if(data.responseJSON){
                                var errors = data.responseJSON;

                                Swal.fire({
                                    title: 'PetClinic',
                                    text:  errors.msg,
                                    icon: 'info',
                                    confirmButtonText: 'はい'
                                })
                            }
                        }
                    });
                }catch (e){
                    Swal.fire({
                        title: 'PetClinic',
                        text:  "JSONファイルではありません。",
                        icon: 'info',
                        confirmButtonText: 'はい'
                    })
                }

            })

        });
    </script>
@endsection


