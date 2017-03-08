@extends('layouts.main')
@section('headContent')
<title>Committee | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
	<!-- end header -->
	<script src="js/jquery.min.js"></script>
	<section id="page-header">
		<img src="{!!  URL::to('images/banners/committee.png') !!}" class="img-responsive banner"></img>
		<div class="container">
			<div class="textbanner">
				<h1 class="txtholder">COMMITTEE</h1>
			</div>
		</div>
	</section>
	
	<section class="section">
		<div class="container" style="padding:20px">
			
			<div class="row section-title text-center">
				
				<h3>Faculty Apex Committee</h3>
				<hr>
			</div><!-- end title -->
			<div class=" row row-fluid service-list">
				
				@foreach($faculties as $faculty)
				<div class="col-md-4 text-center">
					<div class="col-xs-5">
						<img class="img-circle" src="{!! URL::to('images/people/'.$faculty->Image) !!}" alt="" style="width:100px;margin-top:20px;" />
					</div>
					<div class="thumbnail ">
						<!--  <img class="img-responsive" src="http://placehold.it/750x450" alt=""> -->
						<div class="caption">
							<h3 >{!! $faculty->Name !!}<br>
								<small>{!! $faculty->Department !!} Department</small><br>
								<small>{!! $faculty->Responsibilty !!}</small>
							</h3>
							
							
						</div>
					</div>
				</div>
				@endforeach
				
				
				<!-- end col -->
			</div><!-- end row -->
			<br><div class="row section-title text-center">
				
				<h3>Cultural Committee</h3>
				<hr>
			</div>
			<div class=" row row-fluid service-list">
				
				@foreach($culturalc as $cultural)
				<div class="col-md-4 text-center">
					<div class="col-xs-5">
						<img class="img-circle" src="{!! URL::to('images/people/'.$cultural->Image) !!}" alt="" style="width:90px;margin-top:25px;" />
					</div>
					<div class="thumbnail ">
						<!--  <img class="img-responsive" src="http://placehold.it/750x450" alt=""> -->
						<div class="caption">
							<h3 >{!! $cultural->Name !!}<br>
								<small>{!! $cultural->Department !!} Department</small><br>
								<small>{!! $cultural->Responsibilty !!}</small>
							</h3>
							
							
						</div>
					</div>
				</div>
				@endforeach
				
				
				<!-- end col -->
			</div>
			<br><div class="row section-title text-center">
				
				<h3>Student Apex Committee</h3>
				<hr>
			</div><!-- end title -->
			<div class=" row row-fluid service-list">
				
				@foreach($students as $student)
				<a data-toggle="modal" onclick="sendobject({!! $student->Id !!})" data-target="#team">
					<div class="col-md-4 text-center" style="min-height:185px">
						<div class="col-xs-5">
							<img class="img-circle" src="{!! URL::to('images/people/'.$student->Image) !!}" alt="" style="width:100px;margin-top:25px;" />
						</div>
						<div class="thumbnail ">
							
							<div class="caption">
								<h3>{!! $student->Name !!}<br>
									<small>{!! $student->Responsibilty !!}</small><br>
									<small>{!! $student->Department !!}</small><br>
								</h3>
								
							</div>
						</div>
					</div>
				</a>
				
				@endforeach
				
				<div id="team" class="modal fade col-md-12 col-sm-9 col-xs-9 " role="dialog">
					<div class="modal-dialog">
						
						<!-- Modal content-->
						<div class="modal-content">
							<center><div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								<b>Supporting Hands</b>
							</div></center>
							<div class="modal-body" id="data">
							</div>
						</div>
					</div>
				</div>
				<!-- end col -->
			</div><!-- end row -->
			
			
			
		</div>
	</div>
	
	
	<!-- end container -->
</section>
@include('sponsorMorquee')
</div><!-- end wrapper -->

@endsection
<script>
	function sendobject(a) {
		jQuery('#data').hide('fast');
		$.ajax({
			type: "POST",
			url: "{!!URL::to('/volunteer')!!}",
			data:{
				"_token": "{{ csrf_token() }}",
				"id": a
			},
			success: function(data) {
				obj = JSON.parse(data);
				var test='<center>';
				for(var i=0;i<obj.length;i++)
				{
					test=test+'<div class="row"><div class="col-md-1 col-sm-0 col-xs-0"></div><div class="col-md-10 col-sm-12 col-xs-12 text-center" style="min-height:185px"><div class="col-xs-5 col-sm-5"><img class="img-circle" src="{!! URL::to("images/people/") !!}/'+obj[i].Image+'" alt="" style="width:100px;margin-top:5px;" /><br></div><div class="thumbnail "><div class="caption"><h3>'+obj[i].Name+'<br><small>'+obj[i].Responsibilty+'</small><br><small>'+obj[i].Department+'</small></h3></div></div></div></div>';
				}
				document.getElementById('data').innerHTML=test;
				jQuery('#data').show('slow');
			},
			failure: function(errMsg) {
				console.log(errMsg);
			}
		});
	}
    </script>		