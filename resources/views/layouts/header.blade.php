<header class="header" >
    <div class="container">
        <nav class="navbar navbar-static-top navbar-fixed-top hidden-xs">
            <div class="container-fluid">
                <div class="navbar-header">

                    <a class="navbar-brand" href="{!! URL::to('/') !!}"><img src="{!! URL::to('images/headerLogo.png') !!}" alt="" width="100px"></a>
                </div>
                <div id="navbar" class="">
                    <ul class="nav navbar-nav navbar-right" >

                        <li style="display:inline"><a href="{!! URL::to('/') !!}" ><img src="{!! URL::to('images/home.png') !!}" width="45px" alt="Home"/></a></li>
                        <li style="display:inline"><a target="_blank" href="http://www.kiet.edu" ><img src="{!! URL::to('images/kiet.png') !!}" width="50px" alt="KIET Group of Institutions"/></a></li>
                        <li style="display:inline"><a target="_blank" href="http://www.facebook.com/kiet.edu"><img src="{!! URL::to('images/icons/facebook.png') !!}" width="50px" alt="KIET Group of Institutions" /></a></li>
                        <li style="display:inline"><a target="_blank" href="https://www.youtube.com/c/KIETEduGzb"><img src="{!! URL::to('images/icons/YouTube.png') !!}" width="50px" alt="KIET Group of Institutions" /></a></li>
                        </ul>
                </div>
            </div><!-- end container-fluid -->
        </nav><!-- end navbar -->
    </div><!-- end container -->
</header><!-- end header -->
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Participant Login</h4>
            </div>
            <div class="modal-body">
                @if(Auth::guest())
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>


                            </div>
                        </div>
                    </form>
                @else
                    You Are Already Logged in <a href="{{ url('/logout') }}"
                                                 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @endif
            </div>

        </div>

    </div>
</div>