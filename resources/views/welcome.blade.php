<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{url('assets/images/favicon.ico')}}">

  <title> Web顧客情報検索サービス </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{url('landing/css/bootstrap.css')}}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- Custom styles for this template -->
  <link href="{{url('landing/css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{url('landing/css/responsive.css')}}" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">

    <div class="hero_bg_box">
      <img src="{{url('landing/images/hero-bg.png')}}" alt="">
    </div>

    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="">
            <span>
                ペットクルーカルテ
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{url('/user/login')}}">ユーザーログイン</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">顧客ログイン</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                        Web顧客情報検索サービス
                    </h1>
                    <p style="line-height:2; font-size:20px">
                        夜間や病院の休診日など、病院への電話を携帯電話に転送して応対している病院様向けに、外出先でも簡単な顧客情報が検索・確認できるWeb顧客情報検索サービスです。

                        これにより、外出先においてもWeb接続が可能な携帯端末(iPhoneやAndroidなどのスマートフォン)やタブレットPC、ノートPCなどがあればどこでもアクセス可能です。

                        利用できる端末：
                        携帯電話（iPhoneやAndroidなどのスマートホン）、タブレット、ノートPCなど、インターネットに接続できる端末から利用可能
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item ">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                        SSLによる通信
                    </h1>
                    <p style="line-height:2; font-size:20px">
                        このサービス内の通信は全てSSLという通信方式によって行われています。

                        SSLとはインターネット上で情報を暗号化して送受信できる仕組みで、ネットワーク上に流れる通信を暗号化しているため、個人情報などの大切なデータを安全にやりとりできます。
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                        デモで操作の確認をしたい
                    </h1>
                    <p style="line-height:2; font-size:20px">
                        まずは、実際の使い勝手を知るためにデモログイン用のIDとPWも用意してあります。
                        メール本文に病院名と住所・電話番号明記の上ご連絡ください。
                        お問い合わせ先メール：　
                    </p>
                    <div class="">
                        <a href="mailto:support@petcrew.jp?subject=Ｗｅｂ顧客検索のデモが見たい">Web顧客検索デモが見たい</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-7">
                  <div class="detail-box">
                    <h1>
                        サービスの利用をご希望の場合
                    </h1>
                    <p style="line-height:2; font-size:20px">
                        実際にサービスのご利用を希望されるユーザー様は、以下のメールにご連絡ください。　専用のIDとパスワードを発行いたします。　
                        メール本文に病院名と住所・電話番号明記の上ご連絡ください。
                        お問い合わせ先メール：　
                    </p>
                    <div class="">
                        <a href="mailto:order@petcrew.jp?subject=Web顧客検索のサービスを利用したい">Web顧客検索のサービスを利用したい</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
          <li data-target="#customCarousel1" data-slide-to="3"></li>
        </ol>
      </div>

    </section>
    <!-- end slider section -->
  </div>


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved</span>

        </p>

      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script type="text/javascript" src="{{url('landing/js/jquery-3.4.1.min.js')}}"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script type="text/javascript" src="{{url('landing/js/bootstrap.js')}}"></script>
  <!-- owl slider -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- custom js -->
  <script type="text/javascript" src="{{url('landing/js/custom.js')}}"></script>
  <!-- Google Map -->

</body>

</html>
