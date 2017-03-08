@extends('layouts.main')
@section('headContent')
    <title>Video Gallery | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
    <!-- end header -->

    <section id="page-header">
        <img src="{!!  URL::to('images/banners/video.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">VIDEO GALLERY</h1>
                </div>
            </div>
    </section>

    <section class="section">
        <div class="container" style="padding:20px">
		<div class="row">
		<?php $i=0; ?>
		@foreach($videos as $video)
		<div class="col-md-6">
		<?php $i++; ?>
		{!! $video->Link !!}
		</div>
		<?php if($i%2==0)
			echo "</div><br><div class='row'>";
		?>
		
		@endforeach
		</div>
		</div>
        </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')
</div><!-- end wrapper -->

@endsection