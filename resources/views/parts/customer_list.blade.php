
<div class="accordion accordion-flush" id="accordionFlushExample">
    @foreach ($customers as $customer)
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading_{{$customer->id}}">
            <div class="accordion-button fw-medium collapsed"  data-bs-toggle="collapse" data-bs-target="#flush-collapse_{{$customer->id}}" aria-expanded="false" aria-controls="flush-collapse_{{$customer->id}}">
                <div class="flex-grow-1">
                    <h6 class="card-title mb-2">{{$customer->CustFamilyName}}{{$customer->CustName}}（{{$customer->CustFamilyName_furigana}} {{$customer->CustName_furigana}}）</h6>
                    <p class="card-title-desc text-muted mb-0">{{$customer->CustNo}}</p>
                </div>
            </div>
        </h2>
        <div id="flush-collapse_{{$customer->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading_{{$customer->id}}" data-bs-parent="#accordionFlushExample" style="">
            <div class="accordion-body text-muted">
                <div class="row my-2">
                    <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-location"></i>&nbsp;&nbsp;住所:</div>
                    <p class="col-sm-9 col-md-10" style="padding-left:24px">{{$customer->Address}}</p>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-phone"></i>&nbsp;&nbsp;電話番号:</div>
                    <div class="col-sm-9 col-md-10" style="padding-left:24px">
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
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-mail"></i>&nbsp;&nbsp;E-mail:</div>
                    <p class="col-sm-9 col-md-10" style="padding-left:24px">{{$customer->MailAddress}}</p>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-3 col-md-2 mb-1"><i class="dripicons-clock"></i>&nbsp;&nbsp;最終来院:</div>
                    <p class="col-sm-9 col-md-10" style="padding-left:24px">{{date('Y年 m月 d日', strtotime($customer->LastCommingDate))}}</p>
                </div>

                <div class="row mb-2 d-flex justify-content-end">
                    <a href="{{url("/customer/view/".$customer->CustNo)}}" class="btn btn-link waves-effect waves-light">
                        <i class="dripicons-arrow-thin-right font-size-16 align-middle me-2"></i> もっと
                    </a>
                </div>


            </div>
        </div>
    </div>
    @endforeach
</div>
