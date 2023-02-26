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
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <div class="accordion-button fw-medium collapsed"  data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <div class="flex-grow-1">
                                        <h6 class="card-title mb-2">山田（やまだ）</h6>
                                        <p class="card-title-desc text-muted mb-0">002416</p>
                                    </div>
                                </div>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                <div class="accordion-body text-muted">
                                    <div class="row my-2">
                                        <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-location"></i>&nbsp;&nbsp;住所:</div>
                                        <p class="col-sm-9 col-md-10" style="padding-left:24px">東京都渋谷区富ヶ谷</p>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-phone"></i>&nbsp;&nbsp;電話番号:</div>
                                        <div class="col-sm-9 col-md-10" style="padding-left:24px">
                                            <div class="row">
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                                <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;03-1234-5678</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-mail"></i>&nbsp;&nbsp;E-mail:</div>
                                        <p class="col-sm-9 col-md-10" style="padding-left:24px">abcd@efg.com</p>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-clock"></i>&nbsp;&nbsp;最終来院:</div>
                                        <p class="col-sm-9 col-md-10" style="padding-left:24px">2021/10/05</p>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-md-2 mb-1"><i class="mdi mdi-dog-side"></i>&nbsp;&nbsp;ペット:</div>
                                        <div class="col-sm-9 col-md-10" style="padding-left:24px">
                                            <div class="accordion accordion-flush" id="pet_accordion">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="pet-headingOne">
                                                        <div class="accordion-button fw-medium collapsed"  data-bs-toggle="collapse" data-bs-target="#pet-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-2">小太郎（犬）</h6>
                                                                <p class="text-muted mb-0">00123-01 </p>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                    <div id="pet-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#pet_accordion" style="">
                                                        <div class="accordion-body text-muted">
                                                            <div class="table-responsive">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row" style="min-width:100px">ペット名</th>
                                                                            <td style="min-width:200px">小太郎（こたろう）</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">種類</th>
                                                                            <td>犬(M)ミニチュアダップクフント</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">生年月日</th>
                                                                            <td>2018/03/15(4歳1か月)</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">メモ</th>
                                                                            <td>あいうえおかきくけこさしすせそ</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table mb-0">
                                                                    <thead>
                                                                        <tr>
                                                                            <th style="min-width:100px">予防接種名</th>
                                                                            <th style="min-width:100px">接種日・投薬日</th>
                                                                            <th style="min-width:100px">次回予定日</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">８種混合ワクチン</th>
                                                                            <td>2021/08/21(土)</td>
                                                                            <td>2022/08/21(日)</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">狂犬病</th>
                                                                            <td>2021/04/16(金)</td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                </div>
                            </div>
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
