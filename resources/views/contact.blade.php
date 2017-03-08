@extends('layouts.main')
@section('headContent')
    <title>Contact Us | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
    <!-- end header -->

    <section id="page-header">
        <img src="{!!  URL::to('images/banners/contact.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">CONTACT US</h1>
                </div>
            </div>
    </section>

    <section class="section">
        <div class="container" style="padding:20px">

            <div class="panel panel-primary ">
                            <div class="panel-body">
								<div class="row">
								<div class="col-md-8 col-sm-6">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4191.907561815154!2d77.4983676578908!3d28.751920533582247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf5c6d6eefa89a5df!2sKIET+Group+of+Institutions!5e0!3m2!1sen!2sin!4v1484860793184" width="100%" height="400px" frameborder="0" style="border:0" style="margin-top:-500px;"allowfullscreen></iframe>
									</div>
									<div class="col-sm-6 col-md-4" style="padding-bottom: 15px">
                                        <div class="panel color5 panel-stat" style="min-height:100px;">
                                            <div class="panel-heading">

                                                <div class="stat">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <img class="img-circle"src="{!! URL::to('images/contact.png') !!}" alt="" width="80px" />
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <small class="stat-label">KIET Group of Institutions</small>
                                                            <h5 style="color:white">Muradnagar,Ghaziabad - Meerut Highway (NH-58), U.P.-201206</h5>
															
															</div>
                                                    </div><!-- row -->

                                                    
                                                </div><!-- stat -->

                                            </div><!-- panel-heading -->
                                        </div><!-- panel -->
                                    </div>
									<a href="mailto:prastuti@kiet.edu">
                                    <div class="col-sm-6 col-md-4" style="padding-bottom: 15px">
                                        <div class="panel color2 panel-stat" style="min-height:100px;">
                                            <div class="panel-heading">

                                                <div class="stat">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <img class="img-circle"src="{!! URL::to('images/mail.png') !!}" alt="" width="80px" />
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <small class="stat-label">Email Us:</small>
                                                            <h4 style="color:white">prastuti@kiet.edu</h4>
															</div>
                                                    </div><!-- row -->

                                                    
                                                </div><!-- stat -->

                                            </div><!-- panel-heading -->
                                        </div><!-- panel -->
                                    </div><!-- col-sm-6 -->
									</a>
									<a href="tel:8375830814">
									<div class="col-sm-6 col-md-4" style="padding-bottom: 15px">
                                        <div class="panel color3 panel-stat" style="min-height:100px;">
                                            <div class="panel-heading">

                                                <div class="stat">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <img class="img-circle"src="{!! URL::to('images/mob.png') !!}" alt="" width="80px" />
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <small class="stat-label">Call Us:</small>
                                                            <h4 style="color:white">8375830814</h4>
                                                            <h5 style="color:white">Vibhav Raj Singh</h5>
															</div>
                                                    </div><!-- row -->

                                                    
                                                </div><!-- stat -->

                                            </div><!-- panel-heading -->
                                        </div><!-- panel -->
                                    </div>
									</a>
									
									</div>
                            </div>
                            </div>

        </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')
</div><!-- end wrapper -->

@endsection