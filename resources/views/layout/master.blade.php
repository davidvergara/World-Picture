<!DOCTYPE html >
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Picture World </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />


</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img style="max-width:200px; margin-top: -7px;" src="/pictureworldlogoBLUE.png">
            </a>

        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/"> <span class="glyphicon glyphicon-home"></span>  Home</a></li>
                <li><a href="{{ (route('contact')) }}"> <span class="glyphicon glyphicon-envelope"></span> Contact</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}"> <span class="glyphicon glyphicon-log-in"></span>   Login</a></li>
                    <li><a href="{{ route('register') }}"> <span class="glyphicon glyphicon-pencil"></span>  Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <span class="glyphicon glyphicon-user">  </span>  {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href= {{ (route('settings')) }}> <span class="glyphicon glyphicon-cog"></span>   Settings </a></li>
                            <li><a href="{{ route('logout') }}"> <span class="glyphicon glyphicon-log-out"></span>   Logout </a></li>

                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if ( Session::has('flash_message') )

    <div class="alert {{ Session::get('flash_type') }}">
        <h3>{{ Session::get('flash_message') }}</h3>
    </div>

@endif

@if (Auth::guest())
    @yield('content')
@else
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#mypictures" data-toggle="tab"> <span class="glyphicon glyphicon-camera"></span>  My pictures</a>
                            </li>


                            <li><a href="#mymap" data-toggle="tab" onclick="initMap()">  <span class="glyphicon glyphicon-globe"></span>  My Map</a>

                            </li>
                            <li><a href="#other" data-toggle="tab">Other</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="mypictures"> <h4> My pictures  </h4>
                            </div>

                            <div class="tab-pane fade" id="mymap" > <h4>

                                    <div class="container">
                                        <div class="col-md-8 ">
                                            <h1> My Map test - Add a picture  </h1>
                                            {!! Form::open(array('url'=> 'auth/map' , 'files' => true))!!}

                                            <div class="form-group">
                                                <label for="title"> Title   </label>
                                                <input type="text" class=form-control" name="title">
                                            </div>

                                            <div class="form-group">

                                                <div id="map-canvas" style="width:780px;height:410px;"></div>

                                            </div>

                                            <div class="form-group">
                                                <label for="Lat"> Lat </label>
                                                <input type="text" class=form-control" name="lat" id="lat">
                                            </div>

                                            <div class="form-group">
                                                <label for="Long"> Long </label>
                                                <input type="text" class=form-control" name="lng" id="lng">
                                            </div>

                                            <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                                                Add Picture
                                            </button>
                                            {!! Form::close()!!}
                                        </div>
                                    </div>
                                </h4> </div>

                            <div class="tab-pane fade" id="other"> <h4> Other </h4> Other stuff </div>
                        </div>

                    </div>
                    <div class="panel-body">


                    </div>
                </div>
            </div>
        </div>
    </div>


 @endif

 @yield('map')


        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script src="ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"> </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRBsKT5uCocA4gfabJk6RBgssqTYspQIk&callback=initMap" async="async">
    </script>


    <script>

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat:  48.614399, lng: 21.616646},
                scrollwheel: true,
                zoom: 2,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

        });
    </script>
 @yield('scripts')
</body>
</html>