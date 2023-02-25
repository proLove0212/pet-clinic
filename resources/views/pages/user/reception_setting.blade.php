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

                <h4 class="card-title mb-3">順番予約を行う時間帯の設定を行います</h4>

                <form action="{{url('')}}">

                    <div class="mb-3 row">
                        <label for="example-time-input" class="col-md-3 col-form-label">午前のWeb予約開始時間                    </label>
                        <div class="col-md-9">
                            <input class="form-control" type="time" value="09:30:00" name="start_time1"
                                id="example-time-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-time-input" class="col-md-3 col-form-label">午前の診察終了時間                    </label>
                        <div class="col-md-9">
                            <input class="form-control" type="time" value="12:00:00" name="end_time1"
                                id="example-time-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-time-input" class="col-md-3 col-form-label">午後のWeb予約開始時間                    </label>
                        <div class="col-md-9">
                            <input class="form-control" type="time" value="16:30:00" name="start_time2"
                                id="example-time-input">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-time-input" class="col-md-3 col-form-label">午後の診察終了時間                    </label>
                        <div class="col-md-9">
                            <input class="form-control" type="time" value="19:00:00" name="end_time2"
                                id="example-time-input">
                        </div>
                    </div>


                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-md">設定を保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-3">開始時間と終了時間の説明</h4>

                <form action="{{url('')}}" method="POST">
                    @csrf
                    <div class="my-1 row">
                        <p>開始時間は、病院に直接来院した人を優先するために診察開始時間より30分ほど遅らせることをお勧めします。</p>
                    </div>
                    <div class="mb-1 row">
                        <p>終了時間は実際の診察終了時間を登録します。診察待ち人数から求めた終了予測時間が診察終了時間を過ぎてしまう場合はWebでの順番待ちが停止されます。</p>
                    </div>
                    <div class="mb-1 row">
                        <p>Webからの順番予約を行うかどうかはペットクルーカルテの起動時に毎朝行う。</p>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->
@endsection


@section('javascript')

@endsection
