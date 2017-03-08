@extends('layouts.main')
@section('headContent')
<title>Inventory | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
    <!-- end header -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
    <section id="page-header">
			<img src="{!!  URL::to('images/banners/inventory.png') !!}" class="img-responsive banner"></img>
		<div class="container">
			<div class="textbanner">
				<h1 class="txtholder">INVENTORY</h1>
			</div>
		</div>
	</section>
	@if(Session::has('status1'))
		<script>
            swal("{!! Session::get('status1') !!}","{!! Session::get('status2') !!}",  "success");
		</script>
	@endif
    <center><h1>OUR PRODUCTS</h1></center>
	<section class="section">
		<div class="container" style="padding:20px">

			<div id="fourcol" class="portfolio">
				@foreach($products1 as $product1)
					<div class="pitem item-w1 item-h1">
						<div class="entry" style="height:300px;">
							<img src="{!! URL::to('images/products/'.$product1->Image1) !!}" style="height:100%" class="img-responsive" alt="" >
							<div class="magnifier">
								<div class="magnibutton"><i class="fa fa-search"></i></div>
							</div>
						</div>
						<div class="portfolio-title">
							<h4>{!! $product1->Name !!}<b class="pull-right"> (Rs. {!! $product1->Amt !!}/-)</b></h4>
							@if(Auth::guest())
								<br><a data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-block">Add to Cart</a>
							@else
							<form method="post" action="/product_add">
								{{csrf_field()}}
                                <?php if($product1->Types==NULL)
                                    { ?>
									<small>In Stock </small>
									<?php }
									else
									    {
								$m=$product1->Types;
                                $extras=explode('_',$m);  ?>
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:3px;"><h5 class="pull-right">Size:</h5></div>
									<div class="col-md-8 col-sm-8 col-xs-8"><select name="extra" class="form-control pull-right">
									@foreach($extras as $extra)
										<option value="{!! $extra !!}">{!! $extra !!}</option>
									@endforeach
								</select>
									</div>
								</div>
								<?php } ?>
								<br><button type="submit" class="btn btn-primary form-control" name="product" value="{!! $product1->Id !!}">Add To Cart</button>
							</form>
							@endif
						</div><!-- end title -->
					</div><!-- end col -->
			@endforeach<!-- end container -->
	</section>
    <a href="http://www.facebook.com/impressions4" target="_blank"><center><h1>IMPRESSIONS ART GALLERY</h1></center></a>
    <section class="section">
        <div class="container" style="padding:20px">

			<div id="fourcol" class="portfolio">
				@foreach($products as $product)
					<div class="pitem item-w1 item-h1">
						<div class="entry" style="height:200px;">
							<img src="{!! URL::to('images/products/'.$product->Image1) !!}" style="height:100%" class="img-responsive" alt="" >
							<div class="magnifier">
								<div class="magnibutton"><a href="{!! URL::to('inventory/'.$product->short) !!}"><i class="fa fa-search"></i></a></div>
							</div>
						</div>
						<div class="portfolio-title">
							<h4><a href="{!! URL::to('inventory/'.$product->short) !!}">{!! $product->Name !!}</a></h4>
							@if($product->Quantity>10)
							<small>In Stock!!! <b class="pull-right"> (Rs. {!! $product->Amt !!}/-)</b></small>
							@elseif($product->Quantity<=10)
							<small>Only {!! $product->Quantity !!} Left. <b class="pull-right"> (Rs. {!! $product->Amt !!}/-)</b></small>
							@else
								<small>Out of Stock. <b class="pull-right"> (Rs. {!! $product->Amt !!}/-)</b></small>
							@endif
						</div><!-- end title -->
					</div><!-- end col -->
			@endforeach<!-- end container -->
		</section>
		@include ('sponsorMorquee')
	</div><!-- end wrapper -->
	
@endsection