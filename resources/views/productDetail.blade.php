@extends('layouts.main')
@section('headContent')
    <title>{!! $products->Name !!} | Prastuti'17 | KIET Group of Institutions</title>
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
                        <h1>{!! strtoupper($products->Name) !!}</h1>
                    </div>
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
                            <img src="{!! URL::to('images/products/'.$products->Image1) !!}" style="width:100%;" id="img" alt="" class="img-responsive">
                            <div class="magnifier">
                                <div class="magnibutton"><a href="#"><i class="fa fa-edit"></i></a></div>
                            </div>
                        </div><br>
                        <center>
                            @if($cnt>0)
                            <img src="{!! URL::to('images/products/'.$products->Image1) !!}" style="height:10%;display:inline;" onclick="change('{!! $products->Image1 !!}')" alt="" class="img-responsive"></img>
                            @foreach($images as $image)
                                <img src="{!! URL::to('images/products/'.$image->Img) !!}" style="height:10%;display:inline;" alt="" onclick="change('{!! $image->Img !!}')" class="img-responsive"></img>
                            @endforeach
                        @endif
                        </center>
                        <div class="client-button">
                            @if(Auth::guest())
                            <a data-toggle="modal" data-target="#loginModal" class="btn btn-lg btn-primary btn-block">Add to Cart</a>
                            @else
                                @if($products->Quantity>0)
                                    @if($product_added=='NO')
                                    <form method="post" action="/add_product">
                                        {{csrf_field()}}
                                    <button value="{!! $products->Id !!}" name="product" class="btn btn-primary  btn-block">Add to Cart</button>
                                    </form>
                                    @else
                                    <form method="post" action="/remove_product">
                                        {{csrf_field()}}
                                        <input type="hidden" name="quantity" value="{!! $quantity !!}">
                                        <button value="{!! $products->Id !!}" name="product" class="btn btn-danger  btn-block">Cancel Product</button>
                                    </form>
                                    @endif
                                @else
                                <h3>OUT OF STOCK</h3>
                                @endif
                            @endif
                        </div>
                    </div><!-- end col -->

                    <div class="col-md-7 col-sm-12 mobile30 single-portfolio">
                        <div class="section-title text-left">

                            <h3>{!! strtoupper($products->Name) !!}</h3>
                            <hr>
                        </div><!-- end title -->
                        <div class="col-md-6 col-sm-8 mobile30 single-portfolio">
                            <h3>Rs: {!! $products->Amt !!}</h3>
                            @if($products->Quantity>10)
                                <h5>In Stock!!!</h5>
                            @elseif($products->Quantity>0)
                                <h5>Only {!! $products->Quantity !!} Remaining In Stock.</h5>
                                @else
                                <h5>Out of Stock.</h5>
                            @endif
                            @if($des->Types!=null)
                        </div>
                        <div class="col-md-2">Size</div>
                        <div class="col-md-2">
                            <?php $m=$des->Types;
                                  $extras=explode('_',$m);  ?>
                            <select name="extra" class="form-control">
                                @foreach($extras as $extra)
                                <option value="{!! $extra !!}">{!! $extra !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            @endif
                            <br />
                        </div>
                        <div class="col-md-10">
                            <p> {!! $des->Detail !!}</p>
                        </div>
                        </div>


                    </div><!-- end text-widget -->
                </div><!-- end col -->
            </div>



    </div><!-- end container -->
    </section>
    @include ('sponsorMorquee')
    </div><!-- end wrapper -->
@endsection
<script>
    function change(a) {
        $("#img").fadeOut(200, function() {
                var url="{!! URL::to('images/products/') !!}"+'/'+a;
                $("#img").attr('src',url);
            }).fadeIn(200);
    }
</script>