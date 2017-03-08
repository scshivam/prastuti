@extends('layouts.main')
@section('headContent')
    <title>Cart | Prastuti'17 | KIET Group of Institutions</title>
@endsection
@section('bodyContent')
<script src="../js/jquery.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
@if(Session::has('status1'))
        <script>
            swal("{!! Session::get('status1') !!}","{!! Session::get('status2') !!}",  "error");
        </script>
    @endif
<div id="wrapper">
    <!-- end header -->
    <script src="../js/jquery.min.js"></script>
    <section id="page-header">
        <img src="{!!  URL::to('images/banners/cart.png') !!}" class="img-responsive banner"></img>
            <div class="container">
                <div class="textbanner">
                        <h1 class="txtholder">CART</h1>
                </div>
            </div>
    </section><br><br><br>
    <section class="section">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table class="table table-responsive table-striped">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Remove</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0;
$j=0;
                $total=0; ?>
                @if(Auth::user()->accomodation!='Yes')
                @if(Auth::user()->accomodation=='YES')
                    <tr>
                        <td>{!! ++$i !!}</td>
<?php ++$j; ?>
                        <td>Accomodation</td>
                        <td>2 Days Accomodation</td>
                        <td>400</td>
                        <td>
                            <form method="post" action="/remove_hostel">
                                {{csrf_field()}}
                                <button class="btn btn-danger">x</button>
                            </form>
                        </td>
                    </tr>
                    <?php $total+=400; ?>
                @endif
                @endif
                <?php
                if($solo_count>0){ ?>
                @foreach($solo_orders as $order)
                <tr>
                <td>{!! ++$i !!}</td>
<?php ++$j; ?>
                <td>{!! $order->EventName.' ('.$order->event.')' !!}</td>
                <td>--</td>
                <td>{!! $order->Amt !!}</td>
                   <?php $total+=$order->Amt; ?>
                    <td>
                        <form action="/cancel_solo" method="post">
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-rounded" name="event" value="{!! $order->EventId !!}">x</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                <?php }
                if($group_count>0){ ?>
                @foreach($group_orders as $order)
                    <tr>
                        <td>{!! ++$i !!}</td>
			<?php ++$j; ?>
                        <td>{!! $order->EventName.' ('.$order->event.')' !!}</td>
                        <td>
                            <a data-toggle="modal" onclick="team_detail({!! $order->Id !!})" data-target="#teamModal">Team Details</a>
                        </td>
                        <td>{!! $order->Amt !!}</td>
                        <td>
                            <form action="/cancel_group" method="post">
                                {{ csrf_field() }}
                                <button class="btn btn-danger btn-rounded" name="event" value="{!! $order->EventId !!}">x</button>
                            </form>
                        </td>
                        <?php $total+=$order->Amt; ?>
                    </tr>
                @endforeach
                <?php }
                if($product_count>0){?>
                @foreach($products as $order)
                    <tr>
                        <td>{!! ++$i !!}</td>
                        <td>{!! $order->Name !!}</td>
                        <td>Quantity: {!! $order->quantity !!}<br>
                            <a data-toggle="modal" onclick="product('{!! $order->Name !!}','{!! $order->product_id !!}','')" data-target="#productModal">Update</a>
                        </td>
                        <td>{!! $order->Amt*$order->quantity !!}</td>
                        <td>
                            <form action="/remove_product" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="quantity" value="{!! $order->quantity !!}">
                                <button class="btn btn-danger btn-rounded" name="product" value="{!! $order->product_id !!}">x</button>
                            </form>
                        </td>
                        <?php $total+=($order->Amt*$order->quantity); ?>
                    </tr>
                @endforeach
                <?php }
                if($products_count>0){?>
                @foreach($products1 as $order)
                    <tr>
                        <td>{!! ++$i !!}</td>
                        <td>{!! $order->Name !!}</td>
                        <td>Quantity: {!! $order->quantity !!}
                            @if($order->Specs!=null)
                                <br>(Size: {!! $order->Specs !!})
                            @endif
                            <br>
                            @if($order->Specs==null)
                            <a data-toggle="modal" onclick="product('{!! $order->Name !!}','{!! $order->product_id !!}','')" data-target="#productModal">Update</a>
                            @else
                            <a data-toggle="modal" onclick="product('{!! $order->Name !!}','{!! $order->product_id !!}','{!! $order->Specs !!}')" data-target="#productModal">Update</a>
                            @endif
                        </td>
                        <td>{!! $order->Amt*$order->quantity !!}</td>
                        <td>
                            <form action="/remove_product" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="quantity" value="{!! $order->quantity !!}">
                                @if($order->Specs!=null)
                                <input type="hidden" name="specs" value="{!! $order->Specs !!}">
                                @endif
                                <button class="btn btn-danger btn-rounded" name="product" value="{!! $order->product_id !!}">x</button>
                            </form>
                        </td>
                        <?php $total+=($order->Amt*$order->quantity); ?>
                    </tr>
                @endforeach
                <?php } ?>
                @if($i==0)
                    <tr><td colspan="5" align="center">Your Cart is Empty!!!</td></tr>
@elseif($j==0)
<tr><td colspan="5" align="center">Add any event in Cart to complete the payment!!!</td></tr>
                @endif
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" align="right"><b>Total: </b></td>
                    <td colspan="2" align="left"><b>{!! 'Rs. '.$total !!}<?php if($total>0) echo '+<b>'.(0.017*$total).'</b> = '.($total+(0.017*$total)); ?></b></td>
                </tr>
                </tfoot>
            </table><br>
<h3><center><u>Payment Instruction</u></center></h3>
<li><b>Extra 1.7% of total Amount<?php if($total>0) echo ' (Rs. '.(0.017*$total).')'; $m=$total+(0.017*$total); ?> will be deducted as Banking Charges.</b></li>
<li>For Any Payment Related Queries Contact: (Shivam Chaurasia [8266063906])</li><br>
<h3><center><u>Terms & Condition</u></center></h3>
<li>All the participants are required to bring their Identity Card and NOC from their college, failing to which they will not be allowed to participate</li>
<li>All the participants must register on Prastuti's website</li>
<li>All the participants are requested to come 30 minutes prior to the scheduled time for their respective events</li>
<li>Registration fee is non–refundable and non-transferable</li>
<li>Participation in multiple-events is allowed</li>
<li>Kindly go through the schedule before registering for the events. Clash of event timings will be the sole responsibility of the participant.</li>
<li>College has a copyright over any sort of videography and photography taking place in college campus</li>
<li>If the behaviour of any contingent is found contrary to the objectives of the events, college may take appropriate action against the members/individual concerned</li>
@if(Auth::user()->college=='2')
<li>KIET Students must proceed to payment only if you fulfill the participation criteria.</li>
@endif
</center>
<br>
@if($j!=0)
<center><input type="checkbox" id="agree" onchange="document.getElementById('checkout').disabled = !this.checked;"> <b>I Agree to the above Terms and Conditions.</b><center>
@endif
<br><br>
<center>
                @if(Auth::user()->accomodation!='Yes')
                @if(Auth::user()->accomodation=='No')
                    <form action="add_hostel" method="post">
                        {{csrf_field()}}
                    <button class="btn btn-primary">Add Accomodation (Rs. 400)</button><br><br>
                    </form>
                @endif
                @endif
                @if($j!=0)
                &nbsp;&nbsp;<button id="checkout" onclick="location.href='/payment'" class="btn btn-success" disabled>Proceed to Checkout (Rs. {!! $m !!})</button>
                @endif
            </center><br><br><br>
        </div>
    </div>
    </section>
    @include ('sponsorMorquee')
</div><!-- end wrapper -->
<div id="productModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="title"></h4>
            </div>
            <div class="modal-body">
                <form action="/update_qty" method="post">
                <div class="row">
                    {{csrf_field()}}
                    <div class="col-md-2"></div>
                    <div class="col-md-4">Enter Quantity:</div>
                    <input type="hidden" name="specs" id="specs" value="">
                    <div class="col-md-4"><input type="number" min="1" name="qty" class="form-control"></div>
                    <div class="col-md-2"></div>
                </div><br>
                    <div class="row">
                        <center><button type="submit" name="product" id="productn" class="btn btn-success" value="">Update Quantity</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="teamModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="title1"></h4>
            </div>
            <div class="modal-body">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Team Name</th>
                        <th>Member Name</th>
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
    function product(name,id,specs) {
        if(specs=='')
            $('#specs').remove();
        else
            document.getElementById('specs').value=specs;
        jQuery('#title').hide('fast');
        document.getElementById('title').innerHTML=name;
        document.getElementById('productn').value=id;
        jQuery('#title').show('slow');
    }
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
                document.getElementById('title1').innerHTML='Team: '+obj[0].Team;
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