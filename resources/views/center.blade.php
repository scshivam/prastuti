<html>
	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
		<!-- SITE META -->
		<title>Prastuti'17 | KIET Group of Institutions</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="keywords" content="">
		
		<!-- FAVICONS -->
		<link rel="shortcut icon" href="{!! URL::to('images/favicon.ico') !!}" type="image/x-icon">
		
		
		<!-- TEMPLATE STYLES -->
		
		
		
		<!--[if IE]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
	</head>
	<div class="video-container" >
		
		<video class="video-ambient-youtube" id="abc" autoplay >
			<source src="{!! URL::to('images/video/video.mp4') !!}" preload="auto" type="video/mp4">
		</video>
		<video class="video-ambient-youtube" style="display:none;" loop="loop" id="def">
			<source src="{!! URL::to('images/video/video1.mp4') !!}" preload="auto" type="video/mp4">
		</video>
	</div>
	<body class="section main" >
		
		<div style="background-color: rgba(21, 112, 60, 0.48); background-size:cover;background-attachment: fixed">
			@include('layouts.header')
			<section>
				
				<div class="container">
					<div class="section-title text-center" style="padding-top:10px;margin-bottom:12px;">
						
						<img src="{!! URL::to('images/nameBanner.png') !!}" height="10%">
						
					</div><!-- end title -->
					
					<div class="row service-section " id="service-section">
						<div class="service-bg hidden-sm hidden-xs">
							<span class="service-main-bg"></span>
						</div>
						
						@if(Auth::guest())
						<a data-toggle="modal" data-target="#registerModal">
							<div class="col-md-6">
								<div class="service-box-inner">
									<div class="col-md-4 pull-right col-sm-5">
										<img src="{!! URL::to('images/center/register.png') !!}" class="icon-srv" alt="">
									</div>
									<div class="col-md-8 content-box pull-rigth col-sm-7" align="right">
										<h3 class="block-title">Register</h3>
										<p style="color:white">Register yourself here for participation in Prastuti'17.</p>
									</div>
								</div>
							</div>
						</a>
						@else
						<div class="col-md-6" onclick="window.location='/dashboard'">
							<div class="service-box-inner">
								<div class="col-md-4 pull-right col-sm-5" style="margin-right:-10%">
									<img src="{!! URL::to('images/'.Auth::user()->sex.'.png') !!}" class="icon-srv" alt="">
								</div>
								<div class="col-md-8 content-box col-sm-7" align="right">
									<h3 class="block-title" style="margin-right:-10%">{!! Auth::user()->name !!}</h3>
									<p style="color:white;margin-right:-15%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click here to view your registered events.<br><b>Registration Id :: {!! Auth::user()->id !!}</b></p>

								</div>
							</div>
						</div>
						@endif
						@if(Auth::guest())
						<a data-toggle="modal" data-target="#loginModal">
							<div class="col-md-6">
								<div class="service-box-inner">
									<div class="col-md-4 col-sm-5">
										<img src="{!! URL::to('images/center/login.png') !!}" class="icon-srv" alt="">
									</div>
									<div class="col-md-8 content-box col-sm-7">
										<h3 class="block-title">LOGIN</h3>
										<p style="color:white">Login here to participate & check event status in events of Prastuti'17.</p>
									</div>
								</div>
							</div>
						</a>
						@else
						
						<a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
							<div class="col-md-6">
								<div class="service-box-inner">
									<div class="col-md-4 col-sm-5">
										<img src="{!! URL::to('images/center/login.png') !!}" class="icon-srv" alt="">
									</div>
									<div class="col-md-8 content-box col-sm-7">
										<h3 class="block-title">LOG OUT</h3>
										<p style="color:white">Don't forget to logout your account from here.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
									</div>
								</div>
							</div>
						</a>
						
						@endif
						
						<div class="col-md-6" >
							<div class="service-box-inner">
								<div class="col-md-4 pull-right col-sm-5" onclick="window.location='/events'">
									<img src="{!! URL::to('images/center/events.png') !!}" class="icon-srv" alt="">
								</div>
								<div class="col-md-8 content-box col-sm-7" align="right" style="margin:-10px;">
									
									<div class="col-md-7 pull-right" style="margin-right:-55px;margin-left:10px;margin-top:15px;" onclick="window.location='/events'">
										<h3 class="block-title">EVENTS</h3>
										<p style="color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										View Event description, its rules & regulations.</p>
									</div>
									<div class=" col-md-1 hidden-sm hidden-xs pull-right" onclick="change(1);">
										<img src="{!! URL::to('images/left.png') !!}" style="width:60px;margin-top:60px;margin-left:-50px;"></img>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6" >
							<div class="service-box-inner">
								<div class="col-md-4 col-sm-5" onclick="window.location='/schedule'">
									<img src="{!! URL::to('images/center/schedule.png') !!}" class="icon-srv" alt="">
								</div>
								<div class="col-md-8 content-box col-sm-7" style="margin:-10px;">
									<div class="col-md-7" onclick="window.location='/schedule'" style="margin-top:10px;">
									<h3 class="block-title">SCHEDULE</h3>
									<p style="color:white">Click to know the schedule of&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br> 25<sup>th</sup>& 26<sup>th</sup> February.</p>
									</div>
									<div class=" col-md-1 hidden-sm hidden-xs pull-right" onclick="change(1);">
										<img src="{!! URL::to('images/right.png') !!}" style="width:40px; margin-top:60px;margin-left:-40px;"></img>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6" onclick="window.location='/sponsor';">
							<div class="service-box-inner ">
								<div class="col-md-4 pull-right col-sm-5">
									
									
									<img src="{!! URL::to('images/center/sponsor.png') !!}" class="icon-srv" alt="">
									
								</div>
								<div class="col-md-8 content-box col-sm-7">
									<h3 class="block-title">SPONSORS</h3>
									<p style="color:white">Valuable sponsors of "Prastuti'17 - Unveiling Creativity"</p>
								</div>
							</div>
						</div>
						<div class="col-md-6" onclick="window.location='/pronight'">
							<div class="service-box-inner">
								<div class="col-md-4 col-sm-5">
									<img src="{!! URL::to('images/center/pronight.png') !!}" class="icon-srv" alt="">
								</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="col-md-8 content-box col-sm-7">
									<h3 class="block-title">PRO NIGHT</h3>
									<p style="color:white" >Be there and Live the Moment in Prastuti'17.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row service-section " id="service-section1" style="display:none;">
						<div class="service-bg hidden-sm hidden-xs">
							<span class="service-main-bg"></span>
						</div>
						<a href="{{ url('/inventory') }}" >
							<div class="col-md-6">
								<div class="service-box-inner">
									<div class="col-md-4 pull-right col-sm-5" style="margin-right:-17%">
										<img src="{!! URL::to('images/center/inventory.png') !!}" class="icon-srv" alt="">
									</div>
									<div class="col-md-8 content-box pull-right col-sm-7" align="right">
										<h3 class="block-title" align="right">OUR INVENTORY</h3>
										<p style="color:white">Explore the Creativity of KIETian's in <br>"Prastuti'17 - Unveiling Creativity".</p>
									</div>
								</div>
							</div>
						</a>
						@if(Auth::guest())
						<a data-toggle="modal" data-target="#loginModal">
							<div class="col-md-6">
								<div class="service-box-inner">
									<div class="col-md-4 col-sm-5">
										<img src="{!! URL::to('images/center/cart.png') !!}" class="icon-srv" alt="">
									</div>
									<div class="col-md-8 content-box col-sm-7">
										<h3 class="block-title">CART</h3>
										<p style="color:white">Proceed to Checkout for your registered events in Prastuti'17.</p>
									</div>
								</div>
							</div>
						</a>
						@else
						
						<a href="{{ url('/cart') }}" >
							<div class="col-md-6">
								<div class="service-box-inner">
									<div class="col-md-4 col-sm-5">
										<img src="{!! URL::to('images/center/cart.png') !!}" class="icon-srv" alt="">
									</div>
									<div class="col-md-8 content-box col-sm-7">
										<h3 class="block-title">CART</h3>
										<p style="color:white">Proceed to Checkout for your registered events in Prastuti'17.</p>
									</div>
								</div>
							</div>
						</a>
						
						@endif
						
						<div class="col-md-6" >
							<div class="service-box-inner">
								<div class="col-md-4 pull-right col-sm-5" style="margin-right:-10%" onclick="window.location='/video'">
									<img src="{!! URL::to('images/center/video.png') !!}" class="icon-srv" alt="">
								</div>
								<div class="col-md-8 content-box pull-right col-sm-7" align="right">
									<div class="col-md-7 pull-right" style="margin-right:-20px;margin-left:10px;margin-top:-30px;" onclick="window.location='/video'">
									<h3 class="block-title" align="right">&nbsp;&nbsp;&nbsp;VIDEO GALLERY</h3>
									<p style="color:white">Catch the action of Prastuti'17.</p>
									</div>
									<div class=" col-md-1 hidden-sm hidden-xs pull-right" onclick="change(0);">
										<img src="{!! URL::to('images/left.png') !!}" style="width:60px;margin-top:25px;margin-left:-50px;"></img>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6" >
							<div class="service-box-inner">
								<div class="col-md-4 col-sm-5" onclick="window.location='/fun_events'">
									<img src="{!! URL::to('images/center/fun.png') !!}" class="icon-srv" alt="">
								</div>
								<div class="col-md-8 content-box col-sm-7">
									<div class="col-md-7" onclick="window.location='/fun_events'" style="margin-top:-30px;margin-left:-10px;" onclick="window.location='/gallery'">
									<h3 class="block-title">FUN EVENTS</h3>
									<p style="color:white">&nbsp;&nbsp;&nbsp;Because not all is meant for competition </p>
									</div>
									<div class=" col-md-1 hidden-sm hidden-xs pull-right" onclick="change(0);">
										<img src="{!! URL::to('images/right.png') !!}" style="width:40px; margin-top:30px;margin-left:-80px;"></img>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6" onclick="window.location='/commitee';">
							<div class="service-box-inner ">
								<div class="col-md-4 pull-right col-sm-5">
									
									
									<img src="{!! URL::to('images/center/powered.png') !!}" class="icon-srv" alt="">
									
								</div>
								<div class="col-md-8 content-box col-sm-7">
									<h3 class="block-title">COMMITTEE</h3>
									<p style="color:white">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Meet the organizers of Prastuti'17.</p>
								</div>
							</div>
						</div>
						<div class="col-md-6" onclick="window.location='/contact'">
							<div class="service-box-inner">
								<div class="col-md-4 col-sm-5">
									<img src="{!! URL::to('images/center/contact.png') !!}" class="icon-srv" alt="">
								</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="col-md-8 content-box col-sm-7">
									<h3 class="block-title">Contact Us</h3>
									<p style="color:white" >Contact the organizers of Prastuti'17.</p>
								</div>
							</div>
						</div>
					</div>
				</div><!-- end container -->
			</section>
			
			
			
		</div>
		<div id="registerModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Participant Registration</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
							{{ csrf_field() }}
							
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								<label for="name" class="col-md-4 control-label">Name</label>
								
								<div class="col-md-6">
									<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
									
									@if ($errors->has('name'))
									<span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">College Name</label>
								<div class="col-md-6">
									<select name="college" id="selectx" placeholder="Select a College" onchange="checkCollege(this.value)"style="width:100%" class="form-control" required>
										<option value="">Choose Your College</option>
										@foreach($colleges as $college)
										
										<option value="{!! $college->CollegeId !!}">{!! $college->CollegeName !!}</option>
										@endforeach
									</select>
									@if ($errors->has('college'))
									<span class="help-block">
                                        <strong>{{ $errors->first('college') }}</strong>
									</span>
									@endif
									<small style="color:red;">*Select Others if your college is not in the List.</small>
								</div>
							</div>
							<div class="form-group" id="collegeName" style="display:none">
								<label for="password-confirm" class="col-md-4 control-label">College Name</label>
								<div class="col-md-6">
									<input type="text" name="collegeName" id="clg" class="form-control" name="collegeName" placeholder="Type College Name">
									@if ($errors->has('college'))
									<span class="help-block">
                                        <strong>{{ $errors->first('college') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
								<label for="sex" class="col-md-4 control-label">Gender</label>
								
								<div class="col-md-6">
									<input  type="radio" class="" name="sex" value="MALE" required> Male
									<input  type="radio" class="" name="sex" value="FEMALE" required> Female
									@if ($errors->has('email'))
									<span class="help-block">
                                        <strong>{{ $errors->first('sex') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('accomodation') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">Hostel Accomodation</label>
								
								<div class="col-md-6">
									<select name="accomodation" placeholder="Select a College" class="form-control" required>
										
										<option value="">Choose One</option>
										<option value="YES">Yes</option>
										<option value="No">No</option>
										
									</select>
									@if ($errors->has('email'))
									<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								
								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
									
									@if ($errors->has('email'))
									<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
								<label for="mobile" class="col-md-4 control-label">Mobile No</label>
								
								<div class="col-md-6">
									<input id="mobile" type="number" class="form-control" name="mobile" maxlength="10" required>
									
									@if ($errors->has('mobile'))
									<span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
									</span>
									@endif
								</div>
							</div>
							
							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								<label for="password" class="col-md-4 control-label">Password</label>
								
								<div class="col-md-6">
									<input id="password" type="password" class="form-control" name="password" required>
									
									@if ($errors->has('password'))
									<span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
								
								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									
									<button type="submit" class="btn btn-primary">
										Register
									</button>
								</div>
							</div>
						</form>
					</div>
					
				</div>
				
			</div>
		</div>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="css/colors.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/mediaelement.js"></script>
	<script src="js/plugins.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
		<script src="js/jquery.fitvids.js"></script>
	</body>
									<script type="text/javascript">
			$(document).ready(function() {
				$("#selectx").select2();
			});
		</script>
	<script>
		function checkCollege(collegeId){
			if(collegeId==1){
				jQuery('#collegeName').show('slow');
				jQuery('#clg').attr('required','required');
				}else{
				jQuery('#collegeName').hide('slow');
                jQuery('#clg').removeAttr('required');
			}
		}
		$(document).ready(function(){
		var x=screen.width;
		if(x<1026)
		{
		$('#service-section1').attr('style','');
		}
		});
		$(document).ready(function(){
			$("#abc").on(
			"timeupdate", 
			function(event){
				if(this.currentTime>8)
				{
					jQuery('#def').show('fast');
					jQuery('#def').get(0).play();
				}
				if(this.currentTime>9.5)
				{
					jQuery('#abc').fadeOut('slow');
				}
			});
		});
		function change(x)
		{
			if(x==0)
			{
				jQuery('#service-section1').fadeOut(500);
				jQuery('#service-section').show("slow");
				
			}
			else
			if(x==1)
			{
				jQuery('#service-section').hide("slow");
				jQuery('#service-section1').fadeIn(500);
			}
		}
		
		if( window.chrome ) {
		$('#abc').attr('src',"{!! URL::to('images/video/video.webm') !!}");
		$('#abc').attr('type',"video/webm");
		$('#def').attr('src',"{!! URL::to('images/video/video1.webm') !!}");
		$('#def').attr('type',"video/webm");
		}
	</script>
</html>