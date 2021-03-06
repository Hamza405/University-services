<!DOCTYPE html>
<html lang="en">

<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- DESCRIPTION -->
	<meta name="description" content="EduChamp : Education HTML Template" />
	
	<!-- OG -->
	<meta property="og:title" content="EduChamp : Education HTML Template" />
	<meta property="og:description" content="EduChamp : Education HTML Template" />
	<meta property="og:image" content="" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>HMK</title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">
	
</head>
<body id="bg">
<div class="container-xl" style="background-image:url(assets/images/background/bg1.jpg);height:100%;background-size: cover;">
	<div id="loading-icon-bx"></div>
	<div class="row" style="background:rgb(100,50,120,0.6);height:100%;">
			
		<h1 class="col-md-6" style="text-align: center; color:white;margin:auto"> 
				???????? ??????????????<br>?????????????????????? ?? ????????????????????
		</h1>
		
		<div class="card col-md-4" style="margin: 32px 64px; border-radius: 25px;">
			<div class="account-container">
				
				<div class="row d-flex justify-content-end" style="margin-bottom:1rem">
						<div class="col-md-4">
							<img src="assets/images/logo.png" alt="">	
						</div>
						<!-- <div class="col-md-2"></div> -->
						<div class="col-md-8"style="padding-top:1.2rem">
							<div class="heading-bx left">
								<h2 class="title-head">???????? ???????? <span>????????</span></h2>
						
							</div>
						</div>
					</div>	
				<form class="contact-bx" method="POST" action="{{ route('register') }}">
					@csrf
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									
									<input style="direction:rtl" id="name" type="text" placeholder="??????????" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label style="text-align:end">?????????? ????????????????????</label>
									<input style="direction:rtl" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="row">
                           
                            <div class="form-group col-lg-6 col-md-6">
								<div class="input-group"> 
									<label style="text-align:end">?????????? ???????? ????????????</label>
                                    <input style="direction:rtl" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
								
								</div>
							</div>
							<div class="form-group col-lg-6 col-md-6">
								<div class="input-group"> 
									<label style="text-align:end">???????? ????????????</label>
									<input style="direction:rtl" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
							<div class="row">
                            <div class="form-group col-lg-6">
								<div class="input-group">
									<label style="text-align:end">?????????? ??????????????</label>
									<input style="direction:rtl" id="num" type="text" class="form-control @error('num') is-invalid @enderror" name="num" required>
									@error('num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> ?????????? ?????????????? ???????????? ???? ???????? ??????</strong>
                                    </span>
                               		 @enderror
								</div>
                            </div>
                           		<div class="form-group col-lg-6">
                            		<select id="section" name="section">
										@foreach($studySections as $section)
										<option value="{{$section->name}}" selected>
											{{$section->name}}
                                        </option>
										@endforeach
                                    </select>
                            	</div>
                            </div>
						</div>
						<div class="col-lg-12">
							<div class="row">
                                <div class="col-lg-6">
                                    <select id="gender" name="gender">
                                        <option value="??????">
                                            ??????
                                        </option>
                                        <option value="????????">
                                        ????????
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select id="year" name="year">
                                        <option value="1">?????????? ????????????</option>
                                        <option value="2">?????????? ??????????????</option>
                                        <option value="3">?????????? ??????????????</option>
                                        <option value="4">?????????? ??????????????</option>
                                        <option value="5">?????????? ??????????????</option>
                                    </select>
                                </div>
                            </div>
						</div> 
						
						<input type="hidden" id="role" name="role" value="????????">
						<br>
						<div class="col-lg-12" style="margin-top:1.5rem">
								<div class="form-group form-forget">
									<a class="ml-auto" href="{{ route('login') }}" style="text-decoration:rtl">???????? ???????? ?????????????? ?????????? ????????????</a>
								</div>
						</div>
						<div class="col-lg-12 m-b30">
                        	<br>    
                        	<button name="submit" type="submit" style="background:amber; border-radius: 10px;" value="Submit" class="btn button-md btn-block">?????????? ????????????</button>
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/contact.js"></script>
<script src='assets/vendors/switcher/switcher.js'></script>
</body>

</html>
