<!DOCTYPE html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Blaze | Bootstrap 5 SaaS Landing Page</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="assets_home/images/favicon.svg"/>
    <!-- Place favicon.ico in the root directory -->

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="assets_home/css/bootstrap-5.0.0-beta2.min.css" />
    <link rel="stylesheet" href="assets_home/css/LineIcons.2.0.css"/>
    <link rel="stylesheet" href="assets_home/css/tiny-slider.css"/>
    <link rel="stylesheet" href="assets_home/css/animate.css"/>
    <link rel="stylesheet" href="assets_home/css/main.css"/>
  </head>
  <body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- ========================= preloader start ========================= -->
    <div class="preloader">
      <div class="loader">
        <div class="spinner">
          <div class="spinner-container">
            <div class="spinner-rotator">
              <div class="spinner-left">
                <div class="spinner-circle"></div>
              </div>
              <div class="spinner-right">
                <div class="spinner-circle"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
		<!-- preloader end -->
		
		
    <!-- ========================= header start ========================= -->
    <header class="header">
      <div class="navbar-area">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="index.html">
                  <img src="assets_home/images/logo/logo.svg" alt="Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
								</button>
								
                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
									<div class="ms-auto">
										<ul id="nav" class="navbar-nav ms-auto">
											<li class="nav-item">
												<a class="page-scroll active" href="#home">{{ $translations['home'] }}</a>
											</li>
											<li class="nav-item">
												<a class="page-scroll" href="#features">{{ $translations['features'] }}</a>
											</li>
											<li class="nav-item">
												<a class="" href="#0">{{ $translations['team'] }}</a>
											</li>
											<li class="nav-item">
												<a class="" href="#0">{{ $translations['testimonial'] }}</a>
											</li>
											<li class="nav-item">
												<a class="" href="#0">{{ $translations['pricing'] }}</a>
											</li>
										</ul>
									</div>
                </div>
								<div class="header-btn">
									<a href="#0" class="main-btn btn-hover">{{ $translations['login'] }}</a>
								</div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ========================= header end ========================= -->

    <!-- ========================= hero-section start ========================= -->
    <section id="home" class="hero-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xxl-5 col-xl-6 col-lg-6 col-md-10">
            <div class="hero-content">
							<h1>{{ $translations['title1'] }}</h1>
							<p>{{ $translations['title2'] }}</p>
							
							<a href="#0" class="main-btn btn-hover"><strong>{{ $translations['title3'] }}</strong></a>
            </div>
					</div>
					<div class="col-xxl-6 col-xl-6 col-lg-6 offset-xxl-1">
						<div class="hero-image text-center text-lg-start">
							<img src="assets_home/images/hero/hero-image.svg" alt="">
						</div>
					</div>
        </div>
			</div>
    </section>
		<!-- ========================= hero-section end ========================= -->

		<!-- ========================= brands-section start ========================= -->
		<section class="brands-section pt-120">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="single-brands">
							<img src="assets_home/images/brands/graygrids.svg" alt="">
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="single-brands">
							<img src="assets_home/images/brands/lineicons.svg" alt="">
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="single-brands">
							<img src="assets_home/images/brands/uideck.svg" alt="">
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6">
						<div class="single-brands">
							<img src="assets_home/images/brands/pagebulb.svg" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ========================= brands-section end ========================= -->

		<!-- ========================= feature-section start ========================= -->
		<section id="features" class="feature-section">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xxl-6 col-xl-7 col-lg-8 col-md-11">
						<div class="section-title text-center mb-60">
							<h2>{{ $translations['title4'] }}<br class="d-block">{{ $translations['title5'] }}</h2>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="single-feature">
							<div class="feature-icon color-1">
								<i class="lni lni-display"></i>
							</div>
							<div class="feature-content">
								<h4>{{ $translations['step1'] }}</h4>
								<p>{{ $translations['step1_text'] }}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-feature">
							<div class="feature-icon color-2">
								<i class="lni lni-layers"></i>
							</div>
							<div class="feature-content">
								<h4>{{ $translations['step2'] }}</h4>
								<p>{{ $translations['step2_text'] }}</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="single-feature">
							<div class="feature-icon color-3">
								<i class="lni lni-package"></i>
							</div>
							<div class="feature-content">
								<h4>{{ $translations['step3'] }}y</h4>
								<p>{{ $translations['step3_text'] }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ========================= feature-section end ========================= -->

		<!-- ========================= feature-section-1 start ========================= -->
		<section id="feature-1" class="feature-section-1">
			<div class="shape-image">
				<img src="assets_home/images/feature/shape.svg" alt="">
			</div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 order-last order-lg-first">
						<div class="feature-image text-center text-lg-start">
							<img src="assets_home/images/feature/feature-image-1.svg" alt="">
						</div>
					</div>
					<div class="col-lg-6 col-xxl-5 col-md-10 offset-xxl-1">
						<div class="feature-content-wrapper">
							<div class="section-title">
								<h2 class="mb-20">{{ $translations['Feature1_title'] }}</h2>
								<p class="mb-30">{{ $translations['Feature1_text'] }}</p>
								<a href="#0" class="main-btn btn-hover border-btn">Discover More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ========================= feature-section-1 end ========================= -->

		<!-- ========================= feature-section-2 start ========================= -->
		<section id="feature-2" class="feature-section-2">
			<div class="shape-image">
				<img src="assets_home/images/feature/shape.svg" alt="">
			</div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-10">
						<div class="feature-content-wrapper">
							<div class="section-title">
							<h2 class="mb-20">{{ $translations['Feature2_title'] }}</h2>
								
								<p class="mb-30">{{ $translations['Feature2_text'] }}</p>
								<a href="#0" class="main-btn btn-hover border-btn">Discover More</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="feature-image text-lg-end">
							<img src="assets_home/images/feature/feature-image-2.svg" alt="">
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ========================= feature-section-2 end ========================= -->


			<!-- ========================= feature-section-1 start ========================= -->
			<section id="feature-1" class="feature-section-1">
			<div class="shape-image">
				<img src="assets_home/images/feature/shape.svg" alt="">
			</div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 order-last order-lg-first">
						<div class="feature-image text-center text-lg-start">
							<img src="assets_home/images/feature/feature-image-1.svg" alt="">
						</div>
					</div>
					<div class="col-lg-6 col-xxl-5 col-md-10 offset-xxl-1">
						<div class="feature-content-wrapper">
							<div class="section-title">
								<h2 class="mb-20">{{ $translations['Feature3_title'] }}</h2>
								<p class="mb-30">{{ $translations['Feature3_text'] }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- ========================= feature-section-1 end ========================= -->


		<!-- ========================= footer start ========================= -->
		<footer class="footer">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-6 col-lg-7">
						<div class="section-title">
							<h2>Subscribe Newsletter</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Facilisis nulla placerat amet amet congue.</p>
						</div>
						<div class="newsletter-form-wrapper">
							<form action="#">
								<input type="email" placeholder="Email Address">
								<button class="main-btn btn-hover">Subscribe Now</button>
							</form>
						</div>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-8">
						<div class="footer-menu">
							<ul>
								<li><a href="#0">Home</a></li>
								<li><a href="#0">About</a></li>
								<li><a href="#0">Service</a></li>
								<li><a href="#0">Testimonial</a></li>
								<li><a href="#0">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-4">
						<div class="footer-social">
							<ul>
								<li><a href="#0"><i class="lni lni-facebook"></i></a></li>
								<li><a href="#0"><i class="lni lni-linkedin"></i></a></li>
								<li><a href="#0"><i class="lni lni-instagram"></i></a></li>
								<li><a href="#0"><i class="lni lni-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- ========================= footer end ========================= -->


    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top btn-hover">
      <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script src="assets_home/js/bootstrap-5.0.0-beta2.min.js"></script>
    <script src="assets_home/js/tiny-slider.js"></script>
    <script src="assets_home/js/wow.min.js"></script>
    <script src="assets_home/js/polyfill.js"></script>
    <script src="assets_home/js/main.js"></script>
  </body>
</html>

