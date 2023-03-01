
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
                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel1);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div>
                            <div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel2);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div><div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel3);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div><div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel4);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div><div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel5);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div><div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel6);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div><div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel7);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div><div class="mb-1 col-md-4 col-sm-6 col-lg-3"><i class="dripicons-phone"></i>&nbsp;&nbsp;
                                <?php
                                    try {
                                        $decrypted = Crypt::decryptString($customer->Tel8);
                                        echo $decrypted;
                                    } catch (Illuminate\Contracts\Encryption\DecryptException $e) {
                                        echo "-";
                                    }
                                ?>
                            </div>
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
{{--
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
 --}}

            </div>
        </div>
    </div>
    @endforeach
</div>
