@extends('layouts.main')
@section('headContent')
    <title>Events | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<div id="wrapper">
    <!-- end header -->

    <section id="page-header">
        <img src="{!!  URL::to('images/banners/event.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">EVENTS</h1>
                </div>
            </div>
    </section>

    <section class="section">
        <div class="container" style="padding:20px">

            <div class="row">
                <div class="col-md-12">
                    <nav class="portfolio-filter text-center">
                        <ul>
                            <li><a class="btn btn-default" href="#" data-filter="*">All</a></li>
                            <li><a class="btn btn-default" href="#" data-filter=".solo">solo event</a></li>
                            <li><a class="btn btn-default" href="#" data-filter=".group">group event</a></li>

                        </ul>
                        <ul>
                            <li><a class="btn btn-default" href="#" data-filter=".music">Music</a></li>
                            <li><a class="btn btn-default" href="#" data-filter=".dance">Dance</a></li>
                            <li><a class="btn btn-default" href="#" data-filter=".art">Art</a></li>
                            <li><a class="btn btn-default" href="#" data-filter=".online">Online Gaming</a></li>
                            <li><a class="btn btn-default" href="#" data-filter=".others">Others</a></li>

                        </ul>
                    </nav>
                </div>
            </div>

            <div id="fourcol" class="portfolio">
                @foreach($events as $event)
                <div class="pitem item-w1 item-h1 {!! $event->EventCat !!} {!! $event->EventType !!}">
                    <div class="entry">
                        <img src="{!! URL::to('images/'.$event->EventImage) !!}" class="img-responsive" alt="">
                        <div class="magnifier">
                            <div class="magnibutton"><a href="{!! URL::to('events/'.$event->EventCode) !!}"><i class="fa fa-search"></i></a></div>
                        </div>
                    </div>
                    <div class="portfolio-title">
                        <h4><a href="{!! URL::to('events/'.$event->EventCode) !!}">{!! $event->EventName !!}</a></h4>
                        <small>{!! $event->event !!}</small>
                        <i class="fa  fa-{!! ($event->EventType=='solo'?'user':'users') !!}"></i>
                    </div><!-- end title -->
                </div><!-- end col -->
                @endforeach

        </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')
</div><!-- end wrapper -->

@endsection