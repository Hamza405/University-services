<!DOCTYPE html>
<html lang="ar" dir="rtl">

<!-- Mirrored from educhamp.themetrades.com/demo/admin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:08:15 GMT -->
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
	<link rel="icon" href="../error-404.html" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>EduChamp : Education HTML Template </title>
	
	<!-- MOBILE SPECIFIC ============================================= -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.min.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="admin/css/assets.css">
	<link rel="stylesheet" type="text/css" href="admin/vendors/calendar/fullcalendar.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="admin/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="admin/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="admin/css/style.css">
	<link rel="stylesheet" type="text/css" href="admin/css/dashboard.css">
	<link class="skin" rel="stylesheet" type="text/css" href="admin/css/color/color-1.css">
	<style>
        .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

	text-align: center;
}

.styled-table thead tr {
    background-color: #471878;
    color: #fff;
    text-align: center;
}
.styled-table thead tr th{
	color: #fff;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
    </style>
</head>
<body class="ttr-opened-sidebar ttr-pinned-sidebar">
	
	<!-- header start -->
	<header class="ttr-header">
		<div class="ttr-header-wrapper">
			<!--sidebar menu toggler start -->
			<div class="ttr-toggle-sidebar ttr-material-button" style="float:right">
				<i class="ti-close ttr-open-icon"></i>
				<i class="ti-menu ttr-close-icon"></i>
			</div>
			<!--sidebar menu toggler end -->
			<!--logo start -->
			<div class="ttr-logo-box">
				<div>
					{{-- <a href="{{ url('/home') }}" class="ttr-logo">
						<img class="ttr-logo-mobile" alt="" src="assets/images/logo-mobile.png" width="30" height="30">
						<img class="ttr-logo-desktop" alt="" src="assets/images/logo-white.png" width="160" height="27">
					</a> --}}
				</div>
			</div>
			<!--logo end -->
			<div class="ttr-header-menu">
				<!-- header left menu start -->
				@include('templates.navbar')
				<!-- header left menu end -->
			</div>
		
			
		</div>
	</header>
	<!-- header end -->
	<!-- Left sidebar menu start -->
	<div class="ttr-sidebar" style="left: 78% !important;">
		<div class="ttr-sidebar-wrapper content-scroll">
			<!-- side menu logo start -->
			
			<!-- side menu logo end -->
			<!-- sidebar menu start -->
			<nav class="ttr-sidebar-navi">
			@include('templates.sidebar')
				<!-- sidebar menu end -->
			</nav>
			<!-- sidebar menu end -->
		</div>
	</div>
	<!-- Left sidebar menu end -->

	<!--Main container start -->
	<main class="ttr-wrapper">
	<div class="container-fluid" style="width: 75%;position: absolute;left: 16px;">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">لوحة التحكم</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i style="padding:0px 16px" class="fa fa-home"></i>البرنامج الدراسي</a></li>
					
				</ul>
			</div>	
			<!-- Card -->
			<div class="row" style="margin-top:2rem">
				<div class="col-lg-12">
                    <form class="contact-bx" method="POST" action="{{ url('/addPro') }}" enctype="multipart/form-data">
                        @csrf
						@method('PUT')
                        <div class="row placeani">
                            <div class="col-lg-12">
                                <div class="row">
                                <div class="form-group col-lg-12">
									<div class="input-group" style="display: grid">
                                        
                                        <select id="gender" name="day" style="width: 100%">
                                            <option value="1">
												السبت
                                            </option>
                                            <option value="2">
												الأحد
                                            </option>
											<option value="3">
												الاثنين
                                            </option>
                                            <option value="4">
												الثلاثاء
                                            </option>
											<option value="5">
												الاربعاء
                                            </option>
                                            <option value="6">
												الخميس
                                            </option>
		
                                        </select>
                                    </div> <br>
                                    <div class="input-group">
                                    	<textarea class="form-control" style="direction: rtl" placeholder="السنة الأولى" name="y1" required></textarea>
                                    </div> <br>
									<div class="input-group">
                                    	<textarea  class="form-control" style="direction: rtl" placeholder="السنة الثانية" name="y2" required></textarea>
                                    </div> <br>
									<div class="input-group">
                                    	<textarea  class="form-control" style="direction: rtl" placeholder="السنة الثالثة" name="y3" required></textarea>
                                    </div> <br>
									<div class="input-group">
                                    	<textarea  class="form-control" style="direction: rtl" placeholder="السنة الرابعة" name="y4" required></textarea>
                                    </div> <br>
									<div class="input-group">
                                    	<textarea  class="form-control" style="direction: rtl" placeholder="السنة الخامسة" name="y5" required></textarea>
                                    </div> <br>
									
                                    
									@if($errors->any())
									<div class="d-flex justify-content-center">
									  <div class="text-danger" >
										  {{ implode('', $errors->all('هناك غلط بالرقم الجامعي او ان الطالب فعلا ناجح في الماده او مجموع العلامات غير صحيح')) }}
									  </div>
									  @endif    
                            </div>
							  
                          
                            <div class="col-lg-12 m-b30">
                            <br>    
                            <button name="submit" type="submit" style="background:#ccc" value="Submit" class="btn button-md btn-block">حفظ</button>
                            </div>
							<br>
							<table class="styled-table">
							<thead>
								<tr>
									<th  style="color: #fff">السنه الخامسة</th>
									<th  style="color: #fff">السنة الرابعه</th>
									<th  style="color: #fff">السنة الثالثه</th>
									<th  style="color: #fff">السنة الثانية</th>
									<th  style="color: #fff">السنة الأولى</th>
									<th  style="color: #fff">######</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($studypro as $s)
					
								<tr >
									
									<td class="col-1">
										{{$s->year5}}
									</td>	
								
									<td class="col-1">
										{{$s->year4}}
									</td>	
								
									<td class="col-1">
										{{$s->year3}}
									</td>	
							
									<td  class="col-1">
										{{$s->year2}}
									</td>	
								
									<td class="col-1">
										{{$s->year1}}
									</td>	
								
									
									<td class="col-1">
											{{$s->day}}
										</td>	
									</tr>	
								@endforeach
							</tbody>
						</table>
                            
                        </div>
                    </form>
		</div>
	</main>
	<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src="admin/js/jquery.min.js"></script>
<script src="admin/vendors/bootstrap/js/popper.min.js"></script>
<script src="admin/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="admin/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="admin/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="admin/vendors/magnific-popup/magnific-popup.js"></script>
<script src="admin/vendors/counter/waypoints-min.js"></script>
<script src="admin/vendors/counter/counterup.min.js"></script>
<script src="admin/vendors/imagesloaded/imagesloaded.js"></script>
<script src="admin/vendors/masonry/masonry.js"></script>
<script src="admin/vendors/masonry/filter.js"></script>
<script src="admin/vendors/owl-carousel/owl.carousel.js"></script>
<script src='admin/vendors/scroll/scrollbar.min.js'></script>
<script src="admin/js/functions.js"></script>
<script src="admin/vendors/chart/chart.min.js"></script>
<script src="admin/js/admin"></script>
<script src='admin/vendors/calendar/moment.min.js'></script>
<script src='admin/vendors/calendar/fullcalendar.js'></script>
<script src='admin/vendors/switcher/switcher.js'></script>
<script>
  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2019-03-12',
      navLinks: true, // can click day/week names to navigate views

      weekNumbers: true,
      weekNumbersWithinDays: true,
      weekNumberCalculation: 'ISO',

      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-03-01'
        },
        {
          title: 'Long Event',
          start: '2019-03-07',
          end: '2019-03-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-03-11',
          end: '2019-03-13'
        },
        {
          title: 'Meeting',
          start: '2019-03-12T10:30:00',
          end: '2019-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-03-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-03-28'
        }
      ]
    });

  });

</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->
</html>