@extends('layouts.main')
@section('headContent')
    <title>{!! Auth::user()->name !!} | Prastuti'17 | KIET Group of Institutions </title>
@endsection
@section('bodyContent')
<script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
@if(Session::has('status1'))
        <script>
            swal("{!! Session::get('status1') !!}","{!! Session::get('status2') !!}",  "success");
        </script>
    @endif
    <div id="wrapper">
        <!-- end header -->

        <section id="page-header" class="visual color5 ">
            <div class="container">
                <div class="text-block">
                    <div class="heading-holder">
                        <h1>{!! Auth::user()->name !!}</h1>
                    </div>
                    <p class="tagline">Registration Id :: {!! Auth::user()->id !!}</p><br>
                    <p class="tagline"><a href="{{ url('/logout') }}"
                                          onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></p>
                </div>
            </div>
        </section>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <section class="section lb " style="padding:50px">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <table class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Order Id</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;
                        $total=0; ?>
                        @if(Auth::user()->accomodation=='Yes')
                                <tr>
                                    <td>{!! ++$i !!}</td>
                                    <td>Accomodation</td>
                                    <td>2 Days Accomodation</td>
                                    <td>--</td>
                                    <td>400</td>
                                    <td>Paid</td>
                                </tr>
                                <?php $total+=400; ?>
                        @endif
                        <?php if($solo_count>0){ ?>
                        @foreach($solo_orders as $soloorder)
                            @foreach($soloorder as $order)
                            <tr>
                                <td>{!! ++$i !!}</td>
                                <td>{!! $order->EventName.' ('.$order->event.')' !!}</td>
                                <td>--</td>
                                <td>{!! $soloorder->bill !!}</td>
                                <td>Rs. {!! $order->Amt !!}</td>
                                <?php $total+=$order->Amt; ?>
                                <td>
                                    <b>Registered</b>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach

                        <?php }
                        if($group_count>0){ ?>
                        @foreach($group_orders as $grporder)
                            @foreach($grporder as $order)
                            <tr>
                                <td>{!! ++$i !!}</td>
                                <td>{!! $order->EventName.' ('.$order->event.')' !!}</td>
                                <td>
                                    <a data-toggle="modal" onclick="team_detail({!! $order->Id !!})" data-target="#teamModal">Team Details</a>
                                </td>
                                <td>{!! $grporder->bill !!}</td>
                                <td>Rs. {!! $order->Amt !!}</td>
                                <td>
                                    <b>Registered</b>
                                </td>
                                <?php $total+=$order->Amt; ?>
                            </tr>
                            @endforeach
                        @endforeach
                        <?php }
                        if($product_count>0){?>
                        @foreach($products as $product1)
                        @foreach($product1 as $order)
                            <tr>
                                <td>{!! ++$i !!}</td>
                                <td>{!! $order->Name !!}</td>
                                <td>Quantity: {!! $order->quantity !!}</td>
                                <td>{!! $product1->bill !!}</td>
                                <td>Rs. {!! $order->Amt*$order->quantity !!}</td>
                                <td><b>Paid</b></td>
                                <?php $total+=($order->Amt*$order->quantity); ?>
                            </tr>
                        @endforeach
                        @endforeach
                        <?php }
                        if($products_count>0){?>
                        @foreach($products1 as $products11)
                        @foreach($products11 as $order)
                            <tr>
                                <td>{!! ++$i !!}</td>
                                <td>{!! $order->Name !!}</td>
                                <td>Quantity: {!! $order->quantity !!}</td>
                                <td>{!! $products11->bill !!}</td>
                                <td>Rs. {!! $order->Amt*$order->quantity !!}</td>
                                <td><b>Paid</b></td>
                                <?php $total+=($order->Amt*$order->quantity); ?>
                            </tr>
                        @endforeach
                        @endforeach
                        <?php } ?>
                        @if($i==0)
                            <tr><td colspan="6" align="center">Your Have Not Registered in any Events!!!</td></tr>
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="4" align="right"><b>Total: </b></td>
                            <td colspan="2" align="left"><b>{!! 'Rs. '.$total !!}</b></td>
                        </tr>
                        </tfoot>
                    </table><br>
                </div>
            </div>
        </section>
        @include ('sponsorMorquee')
    </div><!-- end wrapper -->
    <div id="teamModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="title"></h4>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Team Name</th>
                            <th>Student Name</th>
                        </tr>
                        </thead>
                        <tbody id="detail">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function team_detail(x) {
            jQuery('#detail').hide('fast');
            jQuery('#title').hide('fast');
            $.ajax({
                type: "POST",
                url: "{!!URL::to('/team_detail')!!}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": x
                },
                success: function (data) {
                    obj = JSON.parse(data);
                    test='';
                    document.getElementById('title').innerHTML='Team: '+obj[0].Team;
                    for(var i=0;i<obj.length;i++) {
                        test=test+'<tr><td>'+(i+1)+'</td><td>'+obj[i].Team+'</td><td>'+obj[i].name+'</td></tr>';
                    }
                    document.getElementById('detail').innerHTML=test;
                }
            });
            jQuery('#detail').show('slow');
            jQuery('#title').show('slow');
        }
    </script>
@endsection