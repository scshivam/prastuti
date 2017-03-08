@extends('layouts.main')
@section('headContent')
    <title>Schedule | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
    <div id="wrapper">
        <section id="page-header">
			<img src="{!!  URL::to('images/banners/schedule.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">SCHEDULE</h1>
                </div>
            </div>
        </section>
        <section class="section lb " style="padding:50px">
            <div class="container">
                <div class="row">


                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#day1" data-toggle="tab"><strong class="lead">Day 1</strong></a></li>
                        <li><a href="#day2" data-toggle="tab"><strong class="lead">Day 2</strong ></a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="day1">
                            <div class="panel panel-primary ">
                            <div class="panel-body">
                                <?php $i=1; ?>
                                @foreach($events as $event)
                                    @if($event->EventDay=='Day 2')
                                        <?php continue; ?>
                                    @endif
                                    <div class="col-sm-6 col-md-3" style="padding-bottom: 15px">
                                        <div class="panel color<?php echo $i++; ?> panel-stat" style="min-height:100px;">
                                            <div class="panel-heading">

                                                <div class="stat">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            <img class="img-circle"src="{!! URL::to('images/'.$event->EventImage) !!}" alt="" width="80px" />
                                                        </div>
                                                        <div class="col-xs-8">
                                                            <small class="stat-label">{!! $event->event !!}</small>
                                                            <h5 style="color:white">{!! $event->Venue !!}</h5>
                                                            <h4 style="color:white">{!! date('H:i A',strtotime($event->EventTime)) !!}</h4>
                                                        </div>
                                                    </div><!-- row -->

                                                    <div class="mb15"></div>

                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <a href="{!! URL::to('events/'.$event->EventCode) !!}"><h3 style="color:white">{!! $event->EventName !!}</h3></a>
                                                        </div>

                                                    </div><!-- row -->
                                                </div><!-- stat -->

                                            </div><!-- panel-heading -->
                                        </div><!-- panel -->
                                    </div><!-- col-sm-6 -->
                                @endforeach

                            </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="day2">

                                <div class="panel panel-primary ">
                                    <div class="panel-body">
                                        <?php $i=1; ?>
                                        @foreach($events as $event)
                                            @if($event->EventDay=='Day 1')
                                                <?php continue; ?>
                                            @endif
                                            <div class="col-sm-6 col-md-3" style="padding-bottom: 15px">
                                                <div class="panel color<?php echo $i++; ?> panel-stat" style="min-height:100px;">
                                                    <div class="panel-heading">

                                                        <div class="stat">
                                                            <div class="row">
                                                                <div class="col-xs-5">
                                                                    <img class="img-circle" src="{!! URL::to('images/'.$event->EventImage) !!}" alt="" width="80px" />
                                                                </div>
                                                                <div class="col-xs-7">
                                                                    <small class="stat-label">{!! $event->event !!}</small>
                                                                    <h5 style="color:white">{!! $event->Venue !!}</h5>
                                                                    <h4 style="color:white">{!! date('H:i A',strtotime($event->EventTime)) !!}</h4>
                                                                </div>
                                                            </div><!-- row -->

                                                            <div class="mb15"></div>

                                                            <div class="row">
                                                                <div class="col-xs-12">
                                                                    <a href="{!! URL::to('events/'.$event->EventCode) !!}"><h3 style="color:white">{!! $event->EventName !!}</h3></a>
                                                                </div>

                                                            </div><!-- row -->
                                                        </div><!-- stat -->

                                                    </div><!-- panel-heading -->
                                                </div><!-- panel -->
                                            </div><!-- col-sm-6 -->
                                        @endforeach

                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        @include ('sponsorMorquee')
    </div>
@endsection