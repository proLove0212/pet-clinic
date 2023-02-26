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

                <form action="{{url('')}}">

                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">来院理由の                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="text" value="" id="example-text-input">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="example-number-input" class="col-md-2 col-form-label">1枠時間                   </label>
                        <div class="col-md-10">
                            <input class="form-control" type="number" value="10"  placeholder="Enter Number" id="example-number-input">
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
                                <th>#</th>
                                <th style="min-width:150px">来院理由</th>
                                <th style="min-width:75px">枠時間</th>
                                <th style="min-width:100px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>ワクチン接種 </td>
                                <td>15分</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-secondary">上に移動</button>
                                        <button type="button" class="btn btn-outline-secondary">下に移動</button>
                                        <button type="button" class="btn btn-danger">削除</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>健康診断</td>
                                <td>20分</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-secondary">上に移動</button>
                                        <button type="button" class="btn btn-outline-secondary">下に移動</button>
                                        <button type="button" class="btn btn-danger">削除</button>
                                    </div>
                                </td>
                            </tr>
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

        });
    </script>
@endsection
