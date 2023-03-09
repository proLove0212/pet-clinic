@extends('layout.main')

@section('title')
    {{$title}}
@endsection

@section('stylesheet')

@endsection

@section('content')
<div class="flex justify-center mt-5">
    <div
      class="block max-w-xl rounded-lg bg-white text-center shadow-lg dark:bg-neutral-700">
        <div  class="border-b-2 bg-lime-600   border-neutral-100 py-3 px-6 text-xl font-black text-white">
            ペットクルー　Web顧客情報検索
        </div>
        <div class="flex justify-between items-end px-4 pt-4 border-b-4 border-black">
            <h5
            class="mb-2 text-xl font-medium leading-tight text-neutral-800 dark:text-neutral-50">
                {{$auth['name']}}動物病院
            </h5>

            <form action="{{url('/logout')}}" method="POST">
                @csrf
                <button type="submit" class=" text-white bg-yellow-500 hover:bg-yellow-600 font-medium  text-sm px-6 py-1.5 text-center">
                    設定
                </button>
            </form>
        </div>

        <div class="flex justify-start px-4 pt-4 items-center">
            <form action="{{url('/petcrew2/search')}}" method="get">
                @csrf
                <button type="button" class="min-w-40 text-white bg-lime-600 hover:bg-lime-700  font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="material-symbols-outlined block text-4xl">
                        search
                    </span>
                    顧客検索
                </button>

            </form>

            <p class="px-2 pt-2 text-left">
                顧客情報を検索できます
            </p>
        </div>

        <div class="flex justify-start px-4 pt-4 items-center">
            <form action="{{url('/petcrew2/upload')}}" method="get">
                @csrf
                <button type="button" class="min-w-40 text-white bg-lime-600 hover:bg-lime-700  font-medium rounded-lg text-base px-6 py-3.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <span class="material-symbols-outlined block  text-4xl">
                        cloud_upload
                    </span>
                    アップロード
                </button>
            </form>

            <p class="px-2 pt-2 text-left">
                ペットクルーカルテで書き出した顧客情報を一括でアップロードするにはこちらから。
            </p>
        </div>

        <div class="flex justify-end px-4 pt-10 items-center">

            <p class="px-2 pt-2 text-left">
                順番予約の時間設定を行います。
            </p>

            <button type="submit" class=" text-white bg-yellow-500 hover:bg-yellow-600 font-medium  text-sm px-6 py-1.5 text-center">
                設定
            </button>
        </div>

        <div class="flex justify-end px-4 py-4 items-center">

            <p class="px-2 pt-2 text-left">
                順番予約の来院理由の設定を行います。
            </p>

            <button type="submit" class=" text-white bg-yellow-500 hover:bg-yellow-600 font-medium  text-sm px-6 py-1.5 text-center">
                設定
            </button>
        </div>

        <div
            class="border-t-2 border-neutral-100 py-3 px-6 dark:border-neutral-600 dark:text-neutral-50">
            2 days ago
        </div>
    </div>
</div>

{{--
<div class="row">
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">顧客</p>
                        <h4 class="mb-0">{{number_format($customer_cnt, 0, ".", ",")}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bx bx-group font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">ペット</p>
                        <h4 class="mb-0">{{number_format($pet_cnt, 0, ".", ",")}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center ">
                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="mdi mdi-dog-side font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium">順番受付</p>
                        <h4 class="mb-0">{{number_format($reception_cnt, 0, ".", ",")}}</h4>
                    </div>

                    <div class="flex-shrink-0 align-self-center">
                        <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                            <span class="avatar-title rounded-circle bg-primary">
                                <i class="mdi mdi-cash-register font-size-24"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="me-2">
                        <h5 class="card-title mb-4">今日の順番受付({{count($receptions)}}件)</h5>
                    </div>
                </div>
                <div data-simplebar class="mt-2" style="max-height: 280px;">
                    <ul class="verti-timeline list-unstyled">
                        @foreach ($receptions as $reception)
                            <li class="event-list {{$reception->Status == 2 ? 'active' : ''}}">
                                <div class="event-timeline-dot">
                                    <i class="bx bxs-right-arrow-circle font-size-18  {{$reception->Status == 2 ? 'bx-fade-right' : ''}}"></i>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <h5 class="font-size-14">{{date('m月 d日', strtotime($reception->VisitDate))}} <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div>
                                             {{$reception->CustName}}  {{$reception->VisitReason}}
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row --> --}}
@endsection


@section('javascript')

@endsection
