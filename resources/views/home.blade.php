@inject('us','App\Models\User')
@inject('Carbon','Carbon\Carbon')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="" />
        <title>HMK</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <meta property="og:title" content="EduChamp : Education HTML Template" />
        <meta property="og:description" content="EduChamp : Education HTML Template" />
        <meta property="og:image" content="" />
        <meta name="format-detection" content="telephone=no">
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
	
	<!-- REVOLUTION SLIDER CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/layers.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/settings.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/revolution/css/navigation.css">
	<!-- REVOLUTION SLIDER END -->	
	<style>
		html{
			scroll-behavior: smooth;
			}
			.item{
				width: 70%;margin: auto
			}
			dialog {
  border: none !important;
  border-radius: 15px;
  box-shadow: 0 0 #0000, 0 0 #0000, 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  padding: 1.6rem;
  max-width: 400px;
}
	</style>
    </head>
    <body id="bg">
		@include('sweetalert::alert')
<div class="page-wraper">
<div id="loading-icon-bx"></div>
	<!-- Header Top ==== -->
    <header class="header rs-nav header-transparent">
		<div class="top-bar">
			<div class="container">
				<div class="row d-flex justify-content-between">
					<div class="topbar-left">
					</div>
					<div class="topbar-right">
						<ul>
						<li style="font-weight: bold">{{ Auth::user()->name }}</li>
						@if (Route::has('login'))
							
							@auth
								<li> <a href="{{ route('logout') }}" class="text-sm text-gray-700 underline">تسجيل خروج</a> </li>	
							@else
								<li> <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">تسجيل دخول</a> </li> 
		
								@if (Route::has('register'))
									<li> <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">إنشاء حساب</a> </li> 
								@endif
							@endauth
						
					   @endif
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="sticky-header navbar-expand-lg">
            <div class="menu-bar clearfix">
                <div class="container clearfix">
					<!-- Header Logo ==== -->
					<div class="menu-logo">
						{{-- <a href="{{ url('/home') }}"><img src="assets/images/logo-white.png" alt=""></a> --}}
					</div>
					<!-- Mobile Nav Button ==== -->
                    <button class="navbar-toggler collapsed menuicon justify-content-end" type="button" data-toggle="collapse" data-target="#menuDropdown" aria-controls="menuDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<!-- Author Nav ==== -->
                    <div class="secondary-menu">
                        <div class="secondary-inner">
                            <ul>
								<li><a href="javascript:;" class="btn-link"><i class="fa fa-facebook"></i></a></li>
								<li><a href="javascript:;" class="btn-link"><i class="fa fa-send"></i></a></li>
								
								<!-- Search Button ==== -->
							
							</ul>
						</div>
                    </div>
					<!-- Search Box ==== -->
                    <div class="nav-search-bar">
                        <form action="#">
                            <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                            <span><i class="ti-search"></i></span>
                        </form>
						<span id="search-remove"><i class="ti-close"></i></span>
                    </div>
					<!-- Navigation Menu ==== -->
                    <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
						<div class="menu-logo">
							<a href="index.html"><img src="assets/images/logo.png" alt=""></a>
						</div>
                        <ul class="nav navbar-nav">	
							{{-- @if(Auth::user()->role == 'Admin') --}}
								<li class="active"><a href="{{ url('/adminDash') }}">Dashboard</a>
							
							{{-- @endif --}}
								<li><a href="#ads">آخر الإعلانات</a>
							
							</li>
							
								<li><a href="javascript:;">الأقسام <i class="fa fa-chevron-down"></i></a>
									<ul class="sub-menu">

										@foreach ($sections as $section)
											<li><a href="">{{ $section->name }}</a></li>
										@endforeach
								
									</ul>
								</li>
							</li>
								<li> 
									<a data-toggle="modal" data-target="#exampleModal">
										خدمات
									</a>
								</li>
							</li>
							
						<li><a href="javascript:;">طلباتي <i class="fa fa-chevron-down"></i></a>
							<ul class="sub-menu">

							@if (count($orders) > 0)
								@foreach ($orders as $order)
									<li><a href="">{{ $us->getServiceName($order->serviceID)->serviceName }}
										@if($us->check(Auth::user()->id,$order->serviceID)->state == 0)
										<span style="float: right;color:red;font-weight:bold">قيد المعالجة</span>
										@else 
										<span style="float: right;color:green;font-weight:bold">تم</span>
										@endif
									
									</a>
										
									</li>
								@endforeach
								<hr>
								@foreach ($reorders as $reorder)
								<li>
									<a style="display: inline-block">{{ $us->getSubjecteName($reorder->subjectID)->name }}</a>
									<a style="display: inline-block;color:#f7b205" href="{{ url('/pullReOrder'.'/'.Auth::user()->id.'/'.$reorder->subjectID) }}">إلغاء الطلب</a>
								</li>
								@endforeach
							@else 
							<p style="text-align: center;color:#000">لاتوجد طلبات</p>
							@endif
						
							</ul>
						</li>
						<li><a href="{{ url('/myMarks') }}">علاماتي</a>
					</li>
							{{-- <li><a href="javascript:;">خدمات</a>
								<ul class="sub-menu">
									<li><a href="{{ route('login') }}">كشف علامات</a></li>
									<li><a href="{{ route('login') }}">وثيقة ترفع</a></li>
									<li><a href="{{ route('login') }}">مصدقة تأجيل</a></li>
									<li><a href="{{ route('login') }}">إعادة عملي</a></li>
									<li><a href="{{ route('login') }}">وثيقة تخرج</a></li>
								</ul>
							</li> --}}
							<li ><a href="{{ url('/home') }}">الرئيسية</a>
							
						</ul>
						<div class="nav-social-link">
							<a href="javascript:;"><i class="fa fa-facebook"></i></a>
							<a href="javascript:;"><i class="fa fa-google-plus"></i></a>
							<a href="javascript:;"><i class="fa fa-linkedin"></i></a>
						</div>
                    </div>
					<!-- Navigation Menu END ==== -->
                </div>
            </div>
        </div>
    </header>
    <!-- Header Top END ==== -->
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- Main Slider -->
        <div class="rev-slider">
			<div id="rev_slider_486_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="news-gallery36" data-source="gallery" style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">
				<!-- START REVOLUTION SLIDER 5.3.0.2 fullwidth mode -->
				<div id="rev_slider_486_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.3.0.2">
					<ul>	<!-- SLIDE  -->
						<li data-index="rs-100" 
						data-transition="parallaxvertical" 
						data-slotamount="default" 
						data-hideafterloop="0" 
						data-hideslideonmobile="off" 
						data-easein="default" 
						data-easeout="default" 
						data-masterspeed="default" 
						data-thumb="error-404.html" 
						data-rotate="0" 
						data-fstransition="fade" 
						data-fsmasterspeed="1500" 
						data-fsslotamount="7" 
						data-saveperformance="off" 
						data-title="A STUDY ON HAPPINESS" 
						data-param1="" data-param2="" 
						data-param3="" data-param4="" 
						data-param5="" data-param6="" 
						data-param7="" data-param8="" 
						data-param9="" data-param10="" 
						data-description="Science says that Women are generally happier">
							<!-- MAIN IMAGE -->
							<img src="assets/images/slider/slide1.jpg" alt="" 
								data-bgposition="center center" 
								data-bgfit="cover" 
								data-bgrepeat="no-repeat" 
								data-bgparallax="10" 
								class="rev-slidebg" 
								data-no-retina />
								
							<!-- LAYER NR. 1 -->
							<div class="tp-caption tp-shape tp-shapewrapper " 
								id="slide-100-layer-1" 
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
								data-width="full"
								data-height="full"
								data-whitespace="nowrap"
								data-type="shape" 
								data-basealign="slide" 
								data-responsive_offset="off" 
								data-responsive="off"
								data-frames='[{"from":"opacity:0;","speed":1,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1,"to":"opacity:0;","ease":"Power4.easeOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 5;background-color:rgba(2, 0, 11, 0.80);border-color:rgba(0, 0, 0, 0);border-width:0px;"> </div>	
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Newspaper-Title   tp-resizeme" 
								id="slide-100-layer-2" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['250','250','250','240']" 
								data-fontsize="['50','50','50','30']"
								data-lineheight="['55','55','55','35']"
								data-width="full"
								data-height="none"
								data-whitespace="normal"
								data-type="text" 
								data-responsive_offset="on" 
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[10,10,10,10]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 6; font-family:rubik; font-weight:700; text-align:center; white-space: normal;">
									كلية الهندسة الميكانيكية والكهربائية
							</div>

							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-100-layer-3" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['210','210','210','210']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; white-space: nowrap; color:#fff; font-family:rubik; font-size:18px; font-weight:400;">
									جامعة تشرين
							</div>
							
							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-100-layer-4" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['320','320','320','290']" 
								data-width="['800','800','700','420']"
								data-height="['100','100','100','120']"
								data-whitespace="unset"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; text-transform:capitalize; white-space: unset; color:#fff; font-family:rubik; font-size:18px; line-height:28px; font-weight:400;">
								أهلا بك في قسم ال{{Auth::user()->section}}
							</div>
							<!-- LAYER NR. 4 -->
						
						</li>
						<li data-index="rs-200" 
						data-transition="parallaxvertical" 
						data-slotamount="default" 
						data-hideafterloop="0" 
						data-hideslideonmobile="off" 
						data-easein="default" 
						data-easeout="default" 
						data-masterspeed="default" 
						data-thumb="assets/images/slider/slide1.jpg" 
						data-rotate="0" 
						data-fstransition="fade" 
						data-fsmasterspeed="1500" 
						data-fsslotamount="7" 
						data-saveperformance="off" 
						data-title="A STUDY ON HAPPINESS" 
						data-param1="" data-param2="" 
						data-param3="" data-param4="" 
						data-param5="" data-param6="" 
						data-param7="" data-param8="" 
						data-param9="" data-param10="" 
						data-description="Science says that Women are generally happier">
							<!-- MAIN IMAGE -->
							<img src="assets/images/slider/slide2.jpg" alt="" 
								data-bgposition="center center" 
								data-bgfit="cover" 
								data-bgrepeat="no-repeat" 
								data-bgparallax="10" 
								class="rev-slidebg" 
								data-no-retina />
								
							<!-- LAYER NR. 1 -->
							<div class="tp-caption tp-shape tp-shapewrapper " 
								id="slide-200-layer-1" 
								data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" 
								data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" 
								data-width="full"
								data-height="full"
								data-whitespace="nowrap"
								data-type="shape" 
								data-basealign="slide" 
								data-responsive_offset="off" 
								data-responsive="off"
								data-frames='[{"from":"opacity:0;","speed":1,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:1;","ease":"Power4.easeOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 5;background-color:rgba(2, 0, 11, 0.80);border-color:rgba(0, 0, 0, 0);border-width:0px;"> 
							</div>

							<!-- LAYER NR. 2 -->
							<div class="tp-caption Newspaper-Title   tp-resizeme" 
								id="slide-200-layer-2" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['250','250','250','240']" 
								data-fontsize="['50','50','50','30']"
								data-lineheight="['55','55','55','35']"
								data-width="full"
								data-height="none"
								data-whitespace="normal"
								data-type="text" 
								data-responsive_offset="on" 
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[10,10,10,10]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 6; font-family:rubik; font-weight:700; text-align:center; white-space: normal;text-transform:uppercase;">
								كلية الهندسة الميكانيكية والكهربائية
							</div>

							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-200-layer-3" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['210','210','210','210']" 
								data-width="none"
								data-height="none"
								data-whitespace="nowrap"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['left','left','left','left']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; white-space: nowrap;text-transform:uppercase; color:#fff; font-family:rubik; font-size:18px; font-weight:400;">
									جامعة تشرين
							</div>
							
							<!-- LAYER NR. 3 -->
							<div class="tp-caption Newspaper-Subtitle   tp-resizeme" 
								id="slide-200-layer-4" 
								data-x="['center','center','center','center']" 
								data-hoffset="['0','0','0','0']" 
								data-y="['top','top','top','top']" 
								data-voffset="['320','320','320','290']" 
								data-width="['800','800','700','420']"
								data-height="['100','100','100','120']"
								data-whitespace="unset"
								data-type="text" 
								data-responsive_offset="on"
								data-frames='[{"from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
								data-textAlign="['center','center','center','center']"
								data-paddingtop="[0,0,0,0]"
								data-paddingright="[0,0,0,0]"
								data-paddingbottom="[0,0,0,0]"
								data-paddingleft="[0,0,0,0]"
								style="z-index: 7; text-transform:capitalize; white-space: unset; color:#fff; font-family:rubik; font-size:18px; line-height:28px; font-weight:400;">
								أهلا بك في قسم ال{{Auth::user()->section}}
							</div>
							<!-- LAYER NR. 4 -->
		
							
						</li>
						<!-- SLIDE  -->
					</ul>
				</div><!-- END REVOLUTION SLIDER -->  
			</div>  
		</div>  
        <!-- Main Slider -->
		<div class="content-block">
			
            
			<!-- Our Services -->
			<div class="section-area content-inner service-info-bx">
                <div class="container mb-4 mt-4">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="service-bx" style="border-radius: 20px">
								<div class="action-box" style="border-radius: 15px">
									<img src="assets/images/gallery/pic5.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-book text-primary"></i>
									</div>
									<h4><a href="#">المقررات الدراسية</a></h4>
								<a href="{{ url('/viewStudentsSubjects') }}" class="btn radius-xl">استعراض</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="service-bx m-b0" style="border-radius: 20px">
								<div class="action-box" style="border-radius: 15px">
									<img src="assets/images/gallery/pic6.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-files-o text-primary"></i>
									</div>
									<h4><a href="#">البرنامج الدراسي</a></h4>
									<a href="{{ url('/viewStudyProgram') }}" class="btn radius-xl">استعراض</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="service-bx m-b0"style="border-radius: 20px">
								<div class="action-box"style="border-radius: 15px">
									<img src="assets/images/gallery/pic3.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-file-text text-primary"></i>
									</div>
									<h4><a href="#">البرنامج الأمتحاني</a></h4>
									<a href="{{ url('/viewStudyExam') }}" class="btn radius-xl">استعراض</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="service-bx m-b0"style="border-radius: 20px">
								<div class="action-box"style="border-radius: 15px">
									<img src="assets/images/gallery/pic2.jpg" alt="">
								</div>
								<div class="info-bx text-center">
									<div class="feature-box-sm radius bg-white">
										<i class="fa fa-map-o text-primary"></i>
									</div>
									<h4><a href="#">خريطة الكلية</a></h4>
									<a href="{{ url('/home') }}" class="btn radius-xl">استعراض</a>
								</div>
							</div>
						</div>
						
					</div>
				</div>
            </div>
            <!-- Our Services END -->
			
		
			
			<!-- Form -->
			<div class="section-area section-sp1 ovpr-dark bg-fix online-cours" style="background-image:url(assets/images/background/bg1.jpg);">
				<div class="container" style="border-radius:25px">
					<div class="row">
						<div class="col-md-12 text-center text-white">
							<h2></h2>
							<h5></h5>
							
						</div>
					</div>
					<div class="mw800 m-auto">
						<div class="row">
							
							<div class="col-md-6 col-sm-6">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
									<h3><i class="ti-user"></i><span class="counter">{{ $user->where('role','طالب')->count() }}</span></h3>
									</div>
									<span class="cours-search-text">طالب</span>
								</div>
							</div>

							<div class="col-md-6 col-sm-6">
								<div class="cours-search-bx m-b30">
									<div class="icon-box">
									<h3><i class="ti-layout-list-post"></i><span class="counter">{{$user->where('role','موظف')->count() }}</span></h3>
									</div>
									<span class="cours-search-text">موظف</span>
								</div>
							</div>
							
						
						</div>
					</div>
					
				</div>
			</div>
			<!-- Form END -->
			<div class="section-area section-sp2" id="ads">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center heading-bx" >
							<h2 class="title-head m-b0"> <span>آخر</span>الإعلانات</h2>
							<hr style="color: #f7b205;width:30%;border:1px solid #f7b205">
						</div>
					</div>
					<div class="row mt-3">
						<div class="upcoming-event-carousel owl-carousel owl-btn-center-lr owl-btn-1 col-12 p-lr0  m-b30">
									@if($ads->isEmpty())
										<div class="col-md-12 text-center">
											<h4>^_^ لا يوجد إعلانات </h4>
										</div>
									@endif
									@foreach ($ads as $ad)
									@if($ad->target == Auth::user()->year || $ad->target == "0") 
									<div class="item" style="width: 32rem;">
										<div class="event-bx" style="border-radius:20px">
											
											<div class="info-bx d-flex"style="direction:rtl">
											
												<div class="event-info">
													<h4 style="float:right;margin-right:0.4rem;color: #4C238D">{{ $ad->section }}</h4>
													<br>
													<p style="float:right;margin-right:0.4rem"><i class="fa fa-clock-o" style="padding-left:8px"></i> {{date('d-M-y', strtotime($ad->created_at))}} </p>
														
												</div>
									
											</div>
								<div style="padding: 0.5rem 1.5rem;text-align:end;height:30vh;@if(strlen($ad->description) > 100) overflow-y:scroll; @endif ">
									<p>{{ $ad->description }}</p>
								</div>
							</div>
						</div>
						@endif
						@endforeach
									
								
						</div>
					</div>
					<div class="text-center">
					
					</div>
				</div>
			</div>
			
			
			
			
			
        </div>
		<!-- contact area END -->
    </div>
	<!-- Content END-->
	<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div  class="modal fade" style="margin-top: 7rem" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">تقديم الطلبات</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body" >
		  
		</div>
		<form action="{{ url('/addOrderStd') }}" method="POST" style="width: 80%;margin:auto;padding:1.1rem">
			@csrf
			<select name="service" >
				@foreach ($services as $service)
					<option value="{{ $service->id }}">{{ $service->serviceName }}</option>
				@endforeach
			</select> <br>
			<button type="submit" class="btn btn-primary btn-block" style="background: #f7b205;color:#fff;margin:2rem 0">تأكيد</button>
		</form> 
		<div class="modal-header" style="direction:rtl;text-align:right">
			<h5 style="direction:rtl;text-align:right" class="modal-title" id="exampleModalLabel">تقديم طلب إعادة عملي</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			</button>
		</div>
		<form action="{{ url('/reOrder') }}" method="POST" style="width: 80%;margin:auto;padding:1.1rem;text-align:end">
			@csrf
			<label style="direction:rtl;text-align:right" for="service">اختر المادة</label>
			<select name="subject" id="subject">
				@foreach ($subjects as $subject) 
					<option value="{{ $subject->id }}" @if($us->checkSubject(Auth::user()->id,$subject->id)) disabled @endif >{{ $subject->name }} </option>
				@endforeach
			</select> <br>
			<button type="submit" class="btn btn-primary btn-block" style="background: #f7b205;color:#fff;margin:2rem 0">قدم الطلب</button>
		</form>
		<!-- -->
		<div class="modal-header" style="direction:rtl;text-align:right">
			<h5 class="modal-title" id="exampleModalLabel"> تقديم شكوى </h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			</button>
		</div>
		<form action="{{ url('/saveComplaint') }}" method="POST" style="width: 80%;margin:auto;padding:1.1rem">
			@csrf
			<textarea minlength="50" dir="rtl" name="content" id="content" cols="30" rows="10" class="form-control" required>
			</textarea>
			<br>
			<div class="row" style="direction:rtl;text-align:right">
				<div class="col-md-8">
				<label for="isShown">إظهار اسم مقدم الشكوى</label>
				</div>
				<div class="col-md-4">
				<input style="width:1rem;position:relative;right:-3rem;top:-.4rem" type="checkbox" name="isShown" id="isShown" class="form-control">
				</div>
			</div>	
			<button type="submit" class="btn btn-primary btn-block" style="background: #f7b205;color:#fff;margin:2rem 0">قدم الشكوى</button>
		</form>
	  </div>
	</div>
  </div>
	<!-- Footer ==== -->
    <footer>
     
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center"> <a target="_blank" href="https://www.templateshub.net">Edit By Hamza & Adel</a></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END ==== -->
    <button class="back-to-top fa fa-chevron-up" ></button>
</div>
@include('templates.alert')

@if($errors->any()){
	<dialog id="favDialog" >
		<p id="dialog_description" style="direction: rtl">
			تم تقديم هذا الطلب بالفعل,
			طلبك قيد المعالجة
		  </p>
		  <div style="display: flex;
		  justify-content: center;
		  align-items: center;">
			<button id="b" type="button" class="btn btn-warning">اغلاق</button>
		  </div>
	</dialog>
	<script>
	 let favDialog = document.querySelector('#favDialog');
					 
	 let btn = document.querySelector('#b');
	 btn.addEventListener ('click',(e)=>{
		favDialog.close()
	 })

	
	
			favDialog.showModal();

	
	</script>
}
@endif


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
<!-- Revolution JavaScripts Files -->
<script src="assets/vendors/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/vendors/revolution/js/jquery.themepunch.revolution.min.js"></script>
<!-- Slider revolution 5.0 Extensions  (Load Extensions only on Local File Systems !  The following part can be removed on Server for On Demand Loading) -->
<script src="assets/vendors/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="assets/vendors/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script>
jQuery(document).ready(function() {
	var ttrevapi;
	var tpj =jQuery;
	if(tpj("#rev_slider_486_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_486_1");
	}else{
		ttrevapi = tpj("#rev_slider_486_1").show().revolution({
			sliderType:"standard",
			jsFileLocation:"assets/vendors/revolution/js/",
			sliderLayout:"fullwidth",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				keyboardNavigation:"on",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
				mouseScrollReverse:"default",
				onHoverStop:"on",
				touch:{
					touchenabled:"on",
					swipe_threshold: 75,
					swipe_min_touches: 1,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				}
				,
				arrows: {
					style: "uranus",
					enable: true,
					hide_onmobile: false,
					hide_onleave: false,
					tmp: '',
					left: {
						h_align: "left",
						v_align: "center",
						h_offset: 10,
						v_offset: 0
					},
					right: {
						h_align: "right",
						v_align: "center",
						h_offset: 10,
						v_offset: 0
					}
				},
				
			},
			viewPort: {
				enable:true,
				outof:"pause",
				visible_area:"80%",
				presize:false
			},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1240,1024,778,480],
			gridheight:[768,600,600,600],
			lazyType:"none",
			parallax: {
				type:"scroll",
				origo:"enterpoint",
				speed:400,
				levels:[5,10,15,20,25,30,35,40,45,50,46,47,48,49,50,55],
				type:"scroll",
			},
			shadow:0,
			spinner:"off",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			hideThumbsOnMobile:"off",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}
});	

document.getElementById('content').value = '';
</script>
</body>
</html>
