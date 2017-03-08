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
    <section id="page-header" class="visual color5 ">
        <div class="container">
            <div class="text-block">
                <div class="heading-holder">
                    <h1>{!! strtoupper($event->EventName) !!}</h1>
                </div>
                <p class="tagline">{!! $event->Tagline !!}</p>
            </div>
        </div>
    </section>
    @if(Session::has('status1'))
        <script>
            swal("{!! Session::get('status1') !!}","{!! Session::get('status2') !!}",  "success");
        </script>
    @endif
    <section class="section lb " style="padding:50px">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="entry">
                        <img src="{!! URL::to('images/'.$event->EventImage) !!}" alt="" width="100%" class="img-responsive">
                        <div class="magnifier">
                            <div class="magnibutton"><a href="#"><i class="fa fa-edit"></i></a></div>
                        </div>

                    </div>
                    <div class="client-button">
                        @if(Auth::guest())
                            <a data-toggle="modal" data-target="#loginModal" class="btn btn-lg btn-primary btn-block">Register for Event</a>
                        @else
							@if($event->EventType=='solo')
                                @if($part_allow=='YES')
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_solo') }}">
                                {{ csrf_field() }}
                                <button class="btn btn-primary  btn-block" name="event" value="{!! $event->EventId !!}">Register for Event</button>
                            </form>
                                @else
                                    @if($cancel_allow=='YES')
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/cancel_solo') }}">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger  btn-block" name="event" value="{!! $event->EventId !!}">Cancel Event</button>
                                        </form>
                                        @else
                                        <h2 style="color:red;" align="center">Already Participated!!!</h2>
                                        @endif
                                @endif
                            @else
                                @if($part_allow=='YES')
                                <a class="btn btn-primary  btn-block" data-toggle="modal" data-target="#grpModal" >Add Your Team</a>
                                @else
                                    @if($cancel_allow=='YES')
                                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/cancel_group') }}">
                                            {{ csrf_field() }}
                                            <button class="btn btn-danger  btn-block" name="event" value="{!! $event->EventId !!}">Cancel Event</button>
                                        </form>
                                    @else
                                        <h2 style="color:red;" align="center">Already Participated!!!</h2>
                                    @endif
                                @endif
							@endif
<br><a href="{{ url('/cart') }}"><button class="btn btn-success  btn-block">Go to Cart</button></a>
                        @endif
                    </div>
                    <!--
                    <div class="section-title text-left">
                        <h3>Registration Process</h3>
                        <hr>
                    </div>
                    <div class="text-widget">
                        <ul class="check m20">
                            <li>Login yourself on Prastuti'17 website.</li>
                            <li>Click on register yourself
                        </ul>
                    </div>
                    -->
                </div><!-- end col -->

                <div class="col-md-7 col-sm-12 mobile30 single-portfolio">
                    <div class="section-title text-left">

                        <h3>{!! strtoupper($event->EventType) !!} EVENT</h3>
                        <hr>
                    </div><!-- end title -->

                    <div class="text-widget" style="padding:20px">
                       <p> {!! $event->EventRule !!}</p>
					   </div>
					   <div class="section-title text-left">

                        <h3>For More Info:</h3>
                    </div>
					 <div class="text-widget" style="">
					   <li> {!! $event->Coordinator1 !!} ( {!! $event->Mob1 !!} )</li>
					   <li> {!! $event->Coordinator2 !!} ( {!! $event->Mob2 !!} )</li>
					</div>


                    </div><!-- end text-widget -->
                </div><!-- end col -->
            </div>
        </div><!-- end container -->
    </section>
@if(!Auth::guest())
@if($event->EventType=='group')
<div id="grpModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Enter Your Team Details</h4>
    </div>
    <div class="modal-body">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_grp') }}" onsubmit="return(check())">
							{{ csrf_field() }}
        <div class="row">
            <div class="col-md-3">
                <b style="color:red;">Your Team Name</b>
            </div>
            <div class="col-md-9">
                <input type="text" id="team" onchange="checkname();" name="team_name" placeholder="Enter your team name" class="form-control" required>
                <input type="hidden" id="invalid" value="1">
            </div>
        </div>
        <div class="row" id="detail" style="display:hide;">
            <div class="col-md-3"></div>
            <div class="col-md-9" style="color:red;" id="here"></div>
        </div><br>
        @for($i=0;$i<($product->Max_allowed-1);$i++)
            <div class="row">
                <div class="col-md-3">
                    Team Mate({!! $i+1 !!}) Registration Id
                </div>
                <div class="col-md-9">
                    <input type="number" onkeyup="student({!! $i !!})" id="student{!! $i !!}" name="{!! 'student'.$i !!}" class="form-control">
                    <input type="hidden" id="invalid{!! $i !!}" value="0">
                </div>
            </div>
            <div class="row" id="detail{!! $i !!}" style="display:hide;">
                <div class="col-md-3"></div>
                <div class="col-md-9" style="color:red;" id="here{!! $i !!}"></div>
            </div><br>
        @endfor
        <button type="submit" class="form-control btn btn-success" name="event" value="{!! $event->EventId !!}">Register for Event</button>
    </form>
    </div>
</div>
</div>
</div>
@endif
@endif
@include ('sponsorMorquee')
</div><!-- end wrapper -->
@if(!Auth::guest())
@if($event->EventType=='group')
    <script>
        function student(x) {
            jQuery('#detail'+x).hide('fast');
            var name=document.getElementById('student'+x).value;
            if(name=='')
            {
                jQuery('#detail'+x).hide('fast');
                jQuery('#invalid' + x).attr('value','1');
            }
                else
            {
                $.ajax({
                    type: "POST",
                    url: "{!!URL::to('/student_data')!!}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": name
                    },
                    success: function (data) {
                        console.log(data);
                        obj = JSON.parse(data);
                        if (obj.short == 'Invalid') {
                            document.getElementById('here' + x).innerHTML = obj.msg;
                            jQuery('#here' + x).attr('style', "color:red;");
                            jQuery('#invalid' + x).attr('value','1');
                        }
                        else {
                            document.getElementById('here' + x).innerHTML = "Name: " + obj[0].name;
                            if(obj[0].id=={!! Auth::user()->id !!})
                            {
                                jQuery('#here' + x).attr('style', "color:red;");
                                jQuery('#invalid' + x).attr('value','0');
                            }
                            else {
                                jQuery('#here' + x).attr('style', "color:green;");
                                jQuery('#invalid' + x).attr('value','0');
                            }

                        }
                        jQuery('#detail' + x).show('slow');
                    },
                    failure: function (errMsg) {
                        console.log(errMsg);
                    }
                });
            }
        }
        function checkname() {
            jQuery('#detail').hide('fast');
            var name=document.getElementById('team').value;
            if(name=='')
                jQuery('#invalid').attr('value','1');
            $.ajax({
                type: "POST",
                url: "{!!URL::to('/team')!!}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id": name
                },
                success: function(data) {
                    obj = JSON.parse(data);
                    if(obj.short=='Invalid')
                    {
                        document.getElementById('here').innerHTML=obj.msg;
                        jQuery('#here').attr('style',"color:red;");
                        jQuery('#invalid').attr('value','1');
                    }
                    else
                    {
                        document.getElementById('here').innerHTML=obj.msg;
                        jQuery('#here').attr('style',"color:green;");
                        jQuery('#invalid').attr('value','0');
                    }
                    jQuery('#detail').show('slow');
                },
                failure: function(errMsg) {
                    console.log(errMsg);
                }
            });
        }
        function check() {
            for (var x = 0; x <{!! $product->Max_allowed-1 !!}; x++) {
                name=document.getElementById('student'+x).value;

                    if(name!='') {
                        inv=document.getElementById('invalid'+x).value;
                        if(inv==1)
                        {
                            swal("Error","Please Enter Valid Registration Id ",  "error");
                            return false;
                        }
                    }
            }
            //return false;
            var name=document.getElementById('team').value;
            if(name!='') {
                inv=document.getElementById('invalid').value;
                if(inv==1)
                {
                    swal("Error","Please Check Your team Name ",  "error");
                    return false;
                }
            }
            for (var x = 0; x <{!! $product->Max_allowed-1 !!}; x++) {
                namex=document.getElementById('student'+x).value;
                for(var y=x+1;y<{!! $product->Max_allowed-1 !!};y++){
                namey=document.getElementById('student'+y).value;
                    if(namex!=''&&namey!=''&&namex==namey) {
                        swal("Error","Please Enter One Registration Id only Once ",  "error");
                        return false;
                    }
                }
            }
            for(var x=0;x<{!! $product->Max_allowed-1 !!}; x++) {
                namex=document.getElementById('student'+x).value;
                if(namex!=''&&namex=={!! Auth::user()->id !!}) {
                    swal("Error","Please do not enter your Registration Id",  "error");
                    return false;
                }
            }
        }
    </script>
    @endif
    @endif
@endsection