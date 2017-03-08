@extends('layouts.main')
@section('headContent')
    <title>{!! $event->EventName !!} | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')

    <div id="wrapper">
        <!-- end header -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
        <section id="page-header" class="visual color<?php echo rand(1,9); ?> ">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1>{!! strtoupper($event->EventName) !!}</h1>
                    </div>
                    <p class="tagline">{!! $event->Tagline !!}</p>
                </div>
            </div>
        </section>
        <section class="section lb " style="padding:50px">
            <div class="container">
                <div class="row">
                    <!--<div class="col-md-5">
                        <div class="entry">
                            <img src="{!! URL::to('images/'.$event->EventImage) !!}" alt="" width="100%" class="img-responsive">
                            <div class="magnifier">
                                <div class="magnibutton"><a href="#"><i class="fa fa-edit"></i></a></div>
                            </div>

                        </div>
                        
                        <div class="section-title text-left">
                            <h3>Registration Process</h3>
                            <hr>
                        </div>
                        <div class="text-widget">
                            <ul class="check m20">
                                <li>Login yourself on Prastuti17 website.</li>
                                <li>Click on register yourself
                            </ul>
                        </div>
                        
                    </div>--><!-- end col -->

                    <div class="col-md-12 col-sm-12 mobile30 single-portfolio">
                        <div class="section-title text-left">

                            <u><h3 align="center">FUN EVENT</h3>
                            </u><br>
                            <h4 align="center" style="color:green;">{!! $event->tag2 !!}</h4>
                        </div><!-- end title -->
                        <div class="row">
                        <div class="col-md-4"></div>
			<div class="entry col-md-4">
                            <img src="{!! URL::to('images/'.$event->EventImage) !!}" alt="" width="100%" class="img-responsive img-circle">
                        </div>
                        <div class="col-md-4"></div></div>
			<div class=""
                        <div class="text-widget" style="padding:20px">
                            <p align="center"> {!! $event->EventRule !!}</p>
                        </div>


                    </div><!-- end text-widget -->
                </div><!-- end col -->
    </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')

@endsection