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

                <h4 class="card-title mb-3">パスワード変更</h4>

                <form action="{{url('/admin/account')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">以前のパスワード。                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" value="{{old('old_password')}}" name="old_password">
                            @error('old_password')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">新しいパスワード                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" value="{{old('password')}}" name="password">
                            @error('password')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="example-text-input" class="col-md-2 col-form-label">パスワード確認                        </label>
                        <div class="col-md-10">
                            <input class="form-control" type="password" value="{{old('password_confirmdation')}}" name="password_confirmdation">
                            @error('password_confirmdation')
                                <div class="msg-danger"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-md">パスワード変更</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>
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
