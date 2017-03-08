@extends('layouts.main')
@section('headContent')
    <title>Pro Night | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
    <!-- end header -->

    <section id="page-header">
        <img src="{!!  URL::to('images/banners/pronight.png') !!}" width="100%" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">PRO NIGHT</h1>
                </div>
            </div>
    </section>

    <section class="section">
        <div class="container" style="padding:20px">
	<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-4">
	<center><h2><font face="Comic sans MS">25 February</font></h2></center>
	<img src="{!! URL::to('images/sabr.png') !!}" width="100%" alt="sabr band"></img></div>
	<div class="col-md-2"></div>
	<div class="col-md-4">
	<center><h2><font face="Comic sans MS">26 February</font></h2></center>
	<img src="{!! URL::to('images/dj.png') !!}" width="100%"  alt="dj tash"></img></div>
	</div>
        </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')
</div><!-- end wrapper -->

@endsection
<style>
body{
background-color:black;
}
</style>