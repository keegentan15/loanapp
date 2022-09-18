<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" size="168x32" href="https://unique4loan.com/assets/images/logo.png">
    <title>Unique4Loan - Loan Service Provider</title>
    <!-- Custom CSS -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/0818482752.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Javascript Here -->
    <script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
  *{
    font-family:Verdana, Geneva, sans-serif;
  }
  html {
    scroll-behavior: smooth;
  }

  .homepage-banner-container {
    height:100vh;
    background: url("../assets/images/homepage/homepage_banner.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-position:center center;
    position:relative;
  }

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.6;
  }

  .homepage-banner-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color:white;
  }
  
  .navbar-brand img {
    width:100%; 
    height:150px;
    margin-top:-40px;
    margin-bottom:-40px;
  }

  .navbar-brand {
    width:200px;
  }

  .container-section {
      background:#1a1a1a;
      padding:100px 0px;
      color:white;
  }
  .advantages-list ul {
    padding: 0;
  }

  .advantages-list li {
    list-style: none;
  }

  .home-section-two i {
    position:absolute;
    font-size:35px;
    top: 50%;
    left: 12%;
    transform: translate(-50%, -50%);
  }

  .steps_list ul {
    padding:0;
  }

  .steps_list li {
    list-style: none;
  }

  .choose_us_section {
    padding:25px 30px;
    border:solid;
    border-radius:20px;
    background-color: #facc6b;
background-image: linear-gradient(315deg, #facc6b 0%, #fabc3c 74%);
color:black;
flex: 1;
  }

  .footer_resources ul {
    margin-top:1rem;
    padding:0;
  }

  .footer_resources li {
    list-style: none;
    margin-bottom:1rem;
  }

  .footer_socials ul {
    margin-top: 1rem;
    padding:0;
  }

  .footer_socials li {
    display: inline;
    padding-right:15px;
  }

  .footer_socials i {
    font-size:25px;
  }

  .homepage-banner-text img {
    transition: all .2s ease-in-out; 
  }

  .homepage-banner-text img:hover {
    transform: scale(1.1);   
  }

  .navbar-light .navbar-nav .nav-link:focus, .navbar-light .navbar-nav {
    color:#b8c3d5;
  }

  .navbar-light .nav-link:hover {
    color:#F9CE30 !important;
  }

  .nav-item {
    padding-left:30px;
    padding-right:30px;
  }

  h1 {
    color:#F9CE30;
    font-weight:bold;
  }

  h2 {
    color:#F9CE30;
    font-weight:bold;
  }

  h3 {
    font-weight:bold;
  }

  .footer_resources li {
    font-size:14px;
  }

  .footer_section hr {
    width:60%;
    text-align:start;
    margin-left:0;
    background:#F9CE30;

  }

  .navbar-light .navbar-nav .nav-link.active {
    color:#F9CE30;
}

.footer_section a,.footer_section a:focus, .footer_section a:active {
  text-decoration: none;
  color: inherit;
}

.footer_section a:hover {
  color:#F9CE30;
}

.card-footer, .card-header {
  padding:0.75rem 5px;
}

.card, .card-header {
  background-color:white !important;
  border:none !important;
  padding:0 !important;
  border-radius:20px;
}

.card {
  box-shadow:0 2px 20px 0 rgb(110,130,208,.18);
  margin-bottom:15px;
}

.btn-link {
  width:100%;
  height:60px;
  color:#000 !important;
  font-weight:bold !important;
  text-align: left !important;
  text-decoration: none !important;
}

.card-body {
  color:black;
}

.btn-link:after {
  content:'\2212';
  width:35px;
  font-size:25px;
  text-align:center;
  border-radius:5px;
  right:15px;
  top:11px;
  position:absolute;
  background:#F9CE30;
}

.btn-link.collapsed:after {
  content:'\002B';
  background:white;
}

.card-header button[aria-expanded="true"] {
    background-image: linear-gradient(315deg, #facc6b 0%, #fabc3c 74%);
    color: black !important;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.footer_section_logo img {
  width:100%;
  height:200px;
  margin-top:-70px;
  margin-bottom:-60px;
  margin-left:-60px;
}

#res {
  margin-top: 1rem;
}

@media only screen and (max-width: 600px) {
  h1 {
    font-size:32px;
  }

  h2 {
    font-size:24px;
  }

  .homepage-banner-container {
    height:80vh;
  }


  .navbar {
    position: sticky;
    position: -webkit-sticky;
    top: 0;
    z-index:999;
  }


  .container-section {
    padding:50px 20px;
  }

  .btn-link {
    font-size:16px;
  }

  .footer_section_logo img {
    height:300px;
    margin:-70px auto -60px auto;
  }

  .footer_section {
    margin-bottom: 2rem;
  }

  .navbar-collapse .navbar-nav .nav-item:last-child {
    padding-left:30px !important;
  }

  .form-inline {
    padding-left:30px;
  }

  .navbar {
    padding:0rem 1rem;
  }

  .btn-link p{
    width:90%;
    font-size:14px;
  }
}

@media only screen and (min-width: 600px) {
  .homepage-banner-container {
    height:80vh;
  }

  .form-inline {
    padding-left:30px;
  }

  .navbar-collapse .navbar-nav .nav-item:last-child {
    padding-left: 30px !important;
  }

  .container-section {
    padding:50px 20px;
  }

  .footer_section_logo img {
    height:300px;
    margin:-70px auto -60px auto;
  }
}

@media only screen and (min-width: 768px) {
  .btn-link p{
    width:90%;
    font-size:14px;
  }

  .footer_section_logo img {
    height:300px;
    width:50%;
    margin:-70px auto -60px auto;
  }

  .footer_section_logo {
      text-align:center;
  }

  .footer_section_logo p {
    text-align:left;
  }
}

@media only screen and (min-width: 992px) {
  .homepage-banner-container {
    height:100vh;
  }

  .container-section {
    padding:100px 0px;
  }

  .nav-item {
    padding-left:15px;
    padding-right:15px;
  }

  .navbar-collapse .navbar-nav .nav-item:last-child {
    padding-left:15px !important;
  }

  .footer_section_logo img {
    width:100%;
    height:200px;
    margin-top:-70px;
    margin-bottom:-60px;
    margin-left:-60px;
  }
}

</style>
<body>

        <nav class="navbar navbar-expand-lg navbar-light sticky-top" style="background:#0d0d0d">
            <a class="navbar-brand" href="/">
                <img src="{{asset('assets/images/logo.png')}}" class="dark-logo img-fluid" alt="hompeage"/>
              </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
              <ul class="navbar-nav m-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#howto">How To</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#whyus">Why Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#download">Download</a>
              </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
              </ul>
              <form class="form-inline" style="margin-bottom:0;">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Get The App</button>
              </form>
            </div>
          </nav>

            <section id="home" class="homepage-banner-container scrollspy">
              <div class="container-fluid">
                <div class="overlay">
                </div>
                <div class="homepage-banner-text text-center">
                    <h1>Get Your Loan Today</h1>
                    <p>Apply for our business loan in minutes, without painful</p>
                    <a href="#">
                      <img src="{{asset('assets/images/homepage/google_play_store.svg')}}" alt="" width="180">
                    </a>
                </div>
              </div>
            </section>

          {{-- <section class="container-fluid container-section">
              <div class="container">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="">
                              <h2>We Gave You Solution For Mobile Banking</h2>
                              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. A quo, maiores sed optio eveniet tempore beatae mollitia illo eius itaque ullam deserunt facilis ab voluptatum, quas quaerat nostrum dolore! Doloremque?</p>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="advantages-list">
                              <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore quo reiciendis atque laudantium consequatur omnis! Modi dolor dignissimos nulla nam sint. Odit deleniti labore nemo impedit minus quisquam, obcaecati provident.</p>
                              <ul>
                                <li><span class="pr-2"><i class="fas fa-check-circle"></i></span>Advantege 1</li>
                                <li><span class="pr-2"><i class="fas fa-check-circle"></i></span>Advantege 2</li>
                                <li><span class="pr-2"><i class="fas fa-check-circle"></i></span>Advantege 3</li>
                                <li><span class="pr-2"><i class="fas fa-check-circle"></i></span>Advantege 4</li>
                                <li><span class="pr-2"><i class="fas fa-check-circle"></i></span>Advantege 5</li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </section>

          <section class="container-fluid container-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <div class="row">
                              <div class="col-md-6 home-section-two" style="padding:10px;">
                                  <div class="" style="border:solid;border-radius:20px;position:relative;padding:10px 15px;">
                                      <i class="fa fa-user"></i>
                                      <div class="pl-5">
                                          <h3>Bank Account</h3>
                                          <p>Cras hendrerit porta arcu in vestibulum Class.</p>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-6 home-section-two" style="padding:10px;">
                                <div class="" style="border:solid;border-radius:20px;position:relative;padding:10px 15px;">
                                  <i class="fa fa-wallet"></i>
                                    <div class="pl-5">
                                        <h3>Payment</h3>
                                        <p>Cras hendrerit porta arcu in vestibulum Class.</p>
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-6 home-section-two" style="padding:10px;">
                                <div class="" style="border:solid;border-radius:20px;position:relative;padding:10px 15px;">
                                  <i class="fa fa-money-check-alt"></i>
                                    <div class="pl-5">
                                        <h3>Transfer</h3>
                                        <p>Cras hendrerit porta arcu in vestibulum Class.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 home-section-two" style="padding:10px;">
                              <div class="" style="border:solid;border-radius:20px;position:relative;padding:10px 15px;">
                                  <i class="fas fa-user"></i>
                                  <div class="pl-5">
                                      <h3>Investment</h3>
                                      <p>Cras hendrerit porta arcu in vestibulum Class.</p>
                                  </div>
                              </div>
                          </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 m-auto">
                        <div class="">
                            <h2>Our App Make Your Daily More Easier</h2>
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. A quo, maiores sed optio eveniet tempore beatae mollitia illo eius itaque ullam deserunt facilis ab voluptatum, quas quaerat nostrum dolore! Doloremque?</p>
                            <input type="button" class="btn btn-primary" value="See All">
                          </div>
                    </div>
                </div>
            </div>
        </section> --}}

        
        <section id="howto" class="container-fluid container-section scrollspy">
          <div class="container">
              <div class="row">
                  <div class="col-md-6 m-auto order-2 order-md-1">
                      <div class="steps_list">
                          <h2 style="color:#F9CE30">Our Easy Steps For Registration</h2>
                          <p>Just follow some simple steps to get your loan after you downloaded the application</p>
                          <ul>
                            <li><span class="pr-2"><i aria-hidden="true" class="fas fa-minus"></i></span>Enter User ID</li>
                            <li><span class="pr-2"><i aria-hidden="true" class="fas fa-minus"></i></span>Input Debit Card Number</li>
                            <li><span class="pr-2"><i aria-hidden="true" class="fas fa-minus"></i></span>Select Location Country</li>
                            <li><span class="pr-2"><i aria-hidden="true" class="fas fa-minus"></i></span>Enter the Transaction</li>
                            <li><span class="pr-2"><i aria-hidden="true" class="fas fa-minus"></i></span>Enter the Transaction Password</li>
                          </ul>
                        </div>
                  </div>
                  <div class="col-md-6 mb-5 mb-md-0 order-1 order-md-2">
                      <div class="advantages-list">
                          <img src="{{asset('assets/images/homepage/steps.svg')}}" alt="" class="img-fluid">
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section id="whyus" class="container-fluid container-section scrollspy">
        <div class="container">
            <div class="text-center">
              <h2>Why Choose Us ?</h2>
              <p class="mt-4 mb-4">Our agency provides high quality services to the customers to achieve their needs.</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 p-2 d-flex">
                  <div class="choose_us_section">
                      <h3>We Secure Your Data Savely</h3>
                      <p>Keeping your information safe is our top priority.</p>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 p-2 d-flex">
                  <div class="choose_us_section">
                      <h3>Easy To Get the Loan</h3>
                      <p>Serve as a bridge between Banks and the borrowers.</p>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 col-md-6 p-2 d-flex">
                  <div class="choose_us_section">
                      <h3>Safe And Secure Payment</h3>
                      <p>All transactions are automatically encrypted from your browser to our website.</p>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 p-2 d-flex">
                  <div class="choose_us_section">
                      <h3>Digital Loan For Any Situation</h3>
                      <p>Go through the entire loan process online, without needing to be involved physically.</p>
                  </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid container-section" id="download">
      <div class="container">
          <div class="row">
              <div class="col-md-6 mb-5 mb-md-0">
                  <div class="">
                      <img src="{{asset('assets/images/homepage/get_started.svg')}}" alt="" class="img-fluid">
                  </div>  
              </div>
              <div class="col-md-6 m-auto">
                  <div class="">
                      <h3>Get Started Today, <br> Create New Account</h3>
                      <p>Download the Unique4Loan app to get more great deals.</p>
                      <a href="#">
                        <img src="{{asset('assets/images/homepage/google_play_store.svg')}}" alt="" width="180">
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section class="container-fluid container-section scrollspy" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="">
                    <h2>The Most <br>Question We Had</h2>
                    <p>These are the frequently asked question by our clients.</p>
                </div>
                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          <p>How to Change my Photo from Admin Dashboard?</p>
                        </button>
                      </h5>
                    </div>
                
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <p>How to Change my Password easily?</p>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <p>How to Change my Subscription Plan using Paypal</p>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6 mt-5 mt-md-0">
                <div class="">
                    <h3>Dont Hesisate To Ask A Question</h3>

                    @if ($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{ $message }}</p>
                      </div>
                  @endif

                    <form action="{{ route('contact.store') }}" method="POST" id="contact_form">
                      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                      <div id="res">

                      </div>
                      <br>
                      <div class="form-group">
                        <input type="text" name="Name" id="Name" class="form-control" placeholder="Your Name">
                      </div>
                      <div class="form-group">
                        <input type="email" name="Email" id="Email" class="form-control" placeholder="Your Email">
                      </div>
                      <div class="form-group">
                        <input type="text" name="Subject" id="Subject" class="form-control"placeholder="Your Subject">
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" name="Message" id="Message" rows="3" placeholder="Your Message"></textarea>
                      </div>
                      <button type="submit" id="btn" class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

  <footer class="container-section" style="background:black;">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 col-md-12 footer_section">
                  <div class="footer_section_logo">
                    <a href="/">
                      <img src="{{asset('assets/images/logo.png')}}" class="dark-logo"alt="hompeage"/>
                    </a>
                    <p>Our agency provides a high quality services to reach customer needs. We offer personal loans, business loan and mortgage to meet your needs. Our professional financial advisors will provide a loan plan that is best for you.</p>
                  </div>
              </div>
              <div class="col-lg-3 col-md-12 footer_section">
                <div class="footer_resources pl-lg-5">
                    <h3>Resources</h3>
                    <hr>
                    <ul>
                      <li><a href="#">App Store</a></li>
                    </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-12 footer_section">
                <div class="footer_socials pl-lg-3">
                    <h3>Socials</h3>
                    <hr>
                    <ul>
                      <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                    </ul> 
                </div>
              </div>
              <div class="col-lg-3 col-md-12 footer_section">
                <div class="">
                    <h3>Download Now And Feel The Experience.</h3>
                    <hr>
                    <a href="#">
                      <img src="{{asset('assets/images/homepage/google_play_store.svg')}}" alt="" width="120">
                    </a>
                </div>
              </div>
          </div>
      </div>
  </footer>

  <footer class="container-fluid" style="background:#333333;color:#F9CE30;">
      <div class="text-center" style="font-weight: 400;">
        <p class="m-0 pt-2 pb-2">Unique4Loan © 2021 All rights reserved</p>
    </div>
  </footer>

    
    <!-- apps -->
    <script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
    <script src="{{asset('dist/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!--This page JavaScript -->
    <script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('dist/js/pages/dashboards/dashboard1.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
         $(document).ready(function () {

            $(document).on("scroll", onScroll);

                $('.nav-link').click(function(e) {
                e.preventDefault();
                var sectionTo = $(this).attr('href');
                    $('html, body').animate({
                          scrollTop: $(sectionTo).offset().top    }, 300); 
                });
          });

          function onScroll(event) {
            var scrollPos = $(document).scrollTop();
            $('.nav-link').each(function () {
                var currLink = $(this);
                var refElement = $(currLink.attr("href"));
                if (refElement.position().top <= scrollPos + 50 && refElement.position().top + refElement.height() > scrollPos + 50) {
                    currLink.addClass("active");
                }
                else {
                    currLink.removeClass("active");
                }
            });
        }

        $(document).ready(function(){
          $("#contact_form").submit(function(e){
            e.preventDefault();
            let url = $(this).attr('action');

            $('#btn').attr('disabled', true);
            $.post(url,
            {
              '_token': $('#token').val(),
              Email: $('#Email').val(),
              Name: $('#Name').val(),
              Subject: $('#Subject').val(),
              Message: $('#Message').val()
            },
            function(response){
              if(response.code == 400) {
                $('#btn').attr('disabled', false);
                let error = '<span class="alert alert-danger">'+response.msg+'</span>';
                $("#res").html(error);
              }else if (response.code == 200) {
                $('#btn').attr('disabled', false);
                let success = '<span class="alert alert-success">'+response.msg+'</span>';
                $('#res').html(success);
              }
            })
            

          })
        })

    </script>
</body>

</html>