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
.pdf{
	background: #481875;
				border: none;
				padding: 3px 37px;
				color: #fff;
				font-size: 1.2rem;
				border-radius: 7px;
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
		<div class="container-fluid" style="width: 75%;position: absolute;
  			left: 16px;">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">لوحة التحكم</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="#"><i style="padding:0px 16px;" class="fa fa-home"></i>المقررات الدراسية</a></li>
				
				</ul>
			</div>	
			<!-- Card -->
			<div class="row" style="margin-top:2rem">
				<div class="col-lg-12">
					<form class="contact-bx exportForm"  action="{{ url('/exportExcelOrder') }}">
						<button class="pdf">
							Excel
						</button>
					</form>
					<table class="styled-table">
						<thead>
							<tr>							
								<th>المقرر الدراسي</th>
                                <th>السنة</th>
                                <th>الفصل</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($subjects as $subject)
							<tr>
								<td>{{ $subject->name }}</td>
                                <td>
                                    @if ($subject->year == 1)    الأولى@endif
                                    @if ($subject->year == 2)  الثانية@endif
                                    @if ($subject->year == 3)  الثالثة@endif
                                    @if ($subject->year == 4)  الرابعة@endif
                                    @if ($subject->year == 5)  الخامسة@endif
                            </td>
                                <td>
                                    @if ($subject->semester == 1)   الأول@endif
                                    @if ($subject->semester == 2)   الثاني@endif
                                </td>
							</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
				
			</div>
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