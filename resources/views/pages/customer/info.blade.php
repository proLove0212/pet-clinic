@extends('layout.main')

@section('title')
    {{$title}}
@endsection


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap table-hover">
                        <tbody>
                            <tr>
                                <td style="width: 100px">顧客番号</td>
                                <td style="text-align: left">{{$customer->CustNo}}</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">顧客名</td>
                                <td style="text-align: left">{{$customer->CustFamilyName}}{{$customer->CustName}}（{{$customer->CustFamilyName_furigana}} {{$customer->CustName_furigana}}）</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">住所</td>
                                <td style="text-align: left">{{$customer->Address}}</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">電話番号</td>
                                <td style="text-align: left">
                                    <div class="row">
                                        @if ($customer->Tel1 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel1}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel2 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel2}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel3 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel3}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel4 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel4}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel5 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel5 != ""}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel6 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel6}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel7 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel7}}
                                            </div>
                                        @endif
                                        @if ($customer->Tel8 != "")
                                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                                {{$customer->Tel8}}
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 100px">メールアドレス</td>
                                <td style="text-align: left">{{$customer->MailAddress}}</td>
                            </tr>
                            <tr>
                                <td style="width: 100px">最終来院</td>
                                <td style="text-align: left">{{date('Y年 m月 d日', strtotime($customer->LastCommingDate))}}</td>
                            </tr>
                        </tbody>
                    </table>
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

                <h4 class="card-title mb-3">ペット情報</h4>

                <div class="accordion accordion-flush" id="pet_accordion">
                    @foreach ($pets as $pet)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="pet-heading-{{$pet->id}}">
                                <div class="accordion-button fw-medium collapsed"  data-bs-toggle="collapse" data-bs-target="#pet-collapse-{{$pet->id}}" aria-expanded="false" aria-controls="flush-collapse-{{$pet->id}}">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2">小太郎（犬）</h6>
                                        <p class="text-muted mb-0">00123-01 </p>
                                    </div>
                                </div>
                            </h2>
                            <div id="pet-collapse-{{$pet->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading-{{$pet->id}}" data-bs-parent="#pet_accordion" style="">
                                <div class="accordion-body text-muted">

                                    <div class="table-responsive">
                                        <table class="table mb-3">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" style="width:100px">ペット名</th>
                                                    <td style="min-width:200px">{{$pet->PetName}} ({{$pet->PetName_furigana}})</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">種類</th>
                                                    <td>{{$pet->PetKind}} ({{$pet->PetSex}}) {{$pet->PetBreed}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">生年月日</th>
                                                    <td>
                                                        @if ($pet->PetBirthday)
                                                            {{date('Y年 m月 d日', strtotime($pet->PetBirthday))}}(
                                                            @if ($pet->PetDeathType == 0)
                                                                <?php
                                                                    $end = \Carbon\Carbon::parse($pet->PetBirthday);
                                                                    $current = \Carbon\Carbon::now();
                                                                    $length = $end->diffInDays($current);

                                                                    echo number_format($length/365, 0, ".", ",")."歳".number_format(($length%365)/12, 0, ".", ",")."か月" ;
                                                                ?>
                                                            @elseif ($pet->PetDeathType == 1)
                                                                @if ($pet->PetDeathDate)
                                                                    死亡時
                                                                    <?php
                                                                        $end = \Carbon\Carbon::parse($pet->PetBirthday);
                                                                        $current = \Carbon\Carbon::parse($pet->PetDeathDate);
                                                                        $length = $end->diffInDays($current);

                                                                        echo number_format($length/365, 0, ".", ",")."歳".number_format(($length%365)/12, 0, ".", ",")."か月" ;
                                                                    ?>
                                                                @else
                                                                    死亡
                                                                @endif
                                                            @elseif ($pet->PetDeathType == 2)
                                                                失踪
                                                            @elseif ($pet->PetDeathType == 3)
                                                                譲渡
                                                            @else

                                                            @endif
                                                            )
                                                        @else
                                                            @if ($pet->PetDeathType == 1)
                                                                死亡
                                                            @elseif ($pet->PetDeathType == 2)
                                                                失踪
                                                            @elseif ($pet->PetDeathType == 3)
                                                                譲渡
                                                            @else

                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">メモ</th>
                                                    <td>{{$pet->Memo}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table mb-3">
                                            <thead>
                                                <tr>
                                                    <th style="min-width:100px">予防接種名</th>
                                                    <th style="min-width:100px">接種日・投薬日</th>
                                                    <th style="min-width:100px">次回予定日</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (explode(",", $pet->VacInfo) as $vacInfo)
                                                    <tr>
                                                        @foreach (explode("\t", $vacInfo) as $item)
                                                        <td>{{$item}}</td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

        });
    </script>
@endsection

