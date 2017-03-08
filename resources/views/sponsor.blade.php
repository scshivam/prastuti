@extends('layouts.main')
@section('headContent')
    <title>Sponsors | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
    <div id="wrapper">
        <!-- end header -->

        <section id="page-header">
            <img src="{!!  URL::to('images/banners/sponsor.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                    <h1 class="txtholder">SPONSORS</h1>
                </div>
            </div>
        </section>


        <section class="section">
            <div class="container" style="padding:20px">
                @foreach($powered as $sponsor)
                    <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                <div class="row section-title text-center">
                    <br><br>
                    <h3>{!! $sponsor->SponsorDescription !!}</h3>
                    <hr>
                </div><!-- end title -->
                <div class=" row row-fluid service-list" style="margin-top:-3%">
                    <div class="col-md-6 col-md-offset-3 col-sm-12">
                        <div class="serviceBox text-center">
                                <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                            <div class="service-content text-center">

                                <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                            </div>

                    </div><!-- end col -->
                </div><!-- end row -->
                    </a>
                <hr style="border-top: dotted;">
                @endforeach
                    @foreach($hospitality as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class="row section-title text-center">
                                <br><br>
                                <h3>{!! $sponsor->SponsorDescription !!}</h3>
                                <hr>
                            </div><!-- end title -->
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                    @endforeach
                    <div class="row section-title text-center">

                        <h3>RADIO PARTNER</h3>
                        <hr>
                    </div><!-- end title -->
                    <div class="row row-fluid service-list">
			@foreach($radio as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                    @endforeach
                    </div>
                    <div class="row section-title text-center">

                        <h3>PHOTOGRAPHY PARTNER</h3>
                        <hr>
                    </div><!-- end title -->
                    <div class="row row-fluid service-list">
			@foreach($photo as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                    @endforeach
                    </div>
                    <div class="row section-title text-center">

                        <h3>ENTERTAINMENT PARTNER</h3>
                        <hr>
                    </div><!-- end title -->
                    <div class="row row-fluid service-list">
			@foreach($enter as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                    @endforeach
                    </div>
                    <?php $i=0; ?>
                    <div class="row section-title text-center">

                        <h3>MEDIA PARTNERS</h3>
                        <hr>
                    </div><!-- end title -->
                    <div class="row row-fluid service-list">
                        @foreach($media as $sponsor)
                            <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                                <div class="col-md-4 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo) !!}" style="width:60%;" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:15px;">{!! $sponsor->SponsorTagLine !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </a>
                            <?php if(++$i%3==0)
                                echo '</div><div class="row row-fluid service-list">'; ?>
                        @endforeach
                    </div>
                    <hr style="border-top: dotted;">
                    @foreach($knowledge as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class="row section-title text-center">
                                <br><br>
                                <h3>{!! $sponsor->SponsorDescription !!}</h3>
                                <hr>
                            </div><!-- end title -->
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                    @endforeach
                    <?php $i=0; ?>
                    <div class="row section-title text-center">

                        <h3>BEVERAGE PARTNERS</h3>
                        <hr>
                    </div><!-- end title -->
                    <div class="row row-fluid service-list">
                        @foreach($beverage as $sponsor)
                            <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                                <div class="col-md-4 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo) !!}" style="width:60%;" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:15px;">{!! $sponsor->SponsorTagLine !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </a>
                            <?php if(++$i%3==0)
                                echo '</div><div class="row row-fluid service-list">'; ?>
                        @endforeach
                    </div>
                    <hr style="border-top: dotted;">
                    @foreach($merchandise as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class="row section-title text-center">
                                <br><br>
                                <h3>{!! $sponsor->SponsorDescription !!}</h3>
                                <hr>
                            </div><!-- end title -->
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                @endforeach
                    @foreach($promotion as $sponsor)
                        <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                            <div class="row section-title text-center">
                                <br><br>
                                <h3>{!! $sponsor->SponsorDescription !!}</h3>
                                <hr>
                            </div><!-- end title -->
                            <div class=" row row-fluid service-list" style="margin-top:-3%">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo); !!}" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:20px;">{!! $sponsor->SponsorTagLine; !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </div><!-- end row -->
                        </a>
                        <hr style="border-top: dotted;">
                @endforeach
                    <?php $i=0; ?>
                    <div class="row section-title text-center">

                        <h3>OTHER SPONSORS</h3>
                        <hr>
                    </div><!-- end title -->
                    <div class="row row-fluid service-list">
                        @foreach($nsponsors as $sponsor)
                            <a href="{!! $sponsor->SponsorLink !!}" target="_blank">
                                <div class="col-md-4 col-sm-12">
                                    <div class="serviceBox text-center">
                                        <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo) !!}" style="width:60%;" alt=""></div>
                                    <div class="service-content text-center">

                                        <b><p style="font-size:15px;">{!! $sponsor->SponsorTagLine !!}</p></b>
                                    </div>

                                </div><!-- end col -->
                            </a>
                            <?php if(++$i%3==0)
                                echo '</div><div class="row row-fluid service-list">'; ?>
                        @endforeach
                    </div>
                <!-- end container -->
        </section>

    </div><!-- end wrapper -->

@endsection