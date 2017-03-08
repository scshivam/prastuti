@extends('layouts.main')
@section('headContent')
    <title>Fun Events | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
    <!-- end header -->

    <section id="page-header">
        <img src="{!!  URL::to('images/banners/funevents.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">FUN EVENTS</h1>
                </div>
            </div>
    </section>

    <section class="section">
        <div class="container" style="padding:20px">

            <div id="fourcol" class="portfolio">
                @foreach($events as $event)
                <div class="pitem item-w1 item-h1">
                    <div class="entry">
                        <img src="{!! URL::to('images/'.$event->EventImage) !!}" class="img-responsive" alt="">
                        <div class="magnifier">
                            <div class="magnibutton"><a href="{!! URL::to('funevents/'.$event->EventCode) !!}"><i class="fa fa-search"></i></a></div>
                        </div>
                    </div>
                    <div class="portfolio-title">
                        <h4><a href="{!! URL::to('funevents/'.$event->EventCode) !!}">{!! $event->EventName !!}</a></h4>
                        <small>Fun Event</small>
                        <i class="fa  fa-user"></i>
                    </div><!-- end title -->
                </div><!-- end col -->
                @endforeach

        </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')
</div><!-- end wrapper -->

@endsection