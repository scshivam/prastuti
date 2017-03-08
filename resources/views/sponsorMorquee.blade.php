<section>
    <div class="container-fluid">


        <marquee behavior="alternate" direction="left">
            @foreach($sponsors as $sponsor)
                <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo) !!}" width="120" height="80" alt="{!! $sponsor->SponsorName !!}" />
            @endforeach
            @foreach($sponsors as $sponsor)
                 <img src="{!! URL::to('images/sponsors/'.$sponsor->SponsorLogo) !!}" width="120" height="80" alt="{!! $sponsor->SponsorName !!}" />
             @endforeach








        </marquee><!-- end row -->
    </div><!-- end container -->
    </div>
</section>