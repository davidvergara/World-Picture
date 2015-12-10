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
                <li><a href="{{(route('showpictures')) }}"> <span class="glyphicon glyphicon-home"></span>  Home </a></li>
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
                        <ul class="nav nav-tabs nav-justified" id="myTabs">

                        @if ($control == "map")
                            {{ $control }}

                            <li ><a href="#mypictures" data-toggle="tab"> <span class="glyphicon glyphicon-camera"></span>  My pictures</a>
                            </li>
                            <li class="active"><a href="#mymap" data-toggle="tab">  <span class="glyphicon glyphicon-globe"></span> aa My Map</a>
                            </li>
                            <li><a href="#other" data-toggle="tab"> <span class="glyphicon glyphicon-picture"></span> Upload pictures</a></li>
                        </ul>

                        @else
                            <li class="active"><a href="#mypictures" data-toggle="tab"> <span class="glyphicon glyphicon-camera"></span>  My pictures</a>
                            </li>
                            <li><a href="#mymap" onclick="imageMarkers($thumbnails)" data-toggle="tab">  <span class="glyphicon glyphicon-globe"></span>  My Map</a>
                            </li>
                            <li><a href="#other" data-toggle="tab"> <span class="glyphicon glyphicon-picture"></span> Upload pictures</a></li>
                            </ul>
                        @endif

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="mypictures"> <h4> My pictures  </h4>
                                <div class="container">
                                    <div class="col-lg-10 ">
                                        @if ( $thumbnails=='')
                                            {!!  link_to_route('showpictures', 'Show pictures', null, array('class' => 'btn btn-primary')) !!}
                                        @elseif($thumbnails != '')
                                            <div class="panel-body">
                                                <div class="row">
                                                    @foreach($thumbnails as $thumbnail)
                                                        <div class="col-lg-5 col-md-8 col-xs-10">

                                                            <div class="thumbnail">

                                                                <img id="imageresource" src="pictures/{{$thumbnail->filename}}" style="width:360px;height:240px;"></a></li>
                                                                <h4 class="text-primary"><span class="label label-primary center-block">Lattitude: {{$thumbnail->lattitude}}</span></h4>
                                                                <h4 class="text-primary"><span class="label label-primary center-block">Longitude: {{$thumbnail->longitude}}</span></h4>
                                                                <div class="caption">
                                                                    {!! Form::open(array('route' => array('deletepictures', $thumbnail->filename), 'method' => 'delete')) !!}
                                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger center-block', 'onclick'=>"return confirm('Are you sure you want to delete this picture?')"]) !!}
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Creates the bootstrap modal where the image will appear -->
                            <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                                        </div>
                                        <div class="modal-body">
                                            <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="mymap" > <h4>

                                    <div class="container">
                                        <div class="col-md-8 ">
                                            <h1> My Map test </h1>

                                            <br>


                                            <div class="form-group">
                                                <div id="map-canvas" style="width:780px;height:410px;"></div>
                                            </div>

                                            <button type="submit" href="{{ route('showmap') }}" class="btn btn-success" style="margin-right: 15px;">
                                                Show pictures
                                            </button>

                                        </div>
                                    </div>
                                </h4> </div>

                            <div class="tab-pane fade" id="other"> <h4> Upload picture </h4>

                                <div class="container">

                                    <div class="row">
                                        <div class="col-sm-9 ">
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">Add a new picture</div>
                                                <div class="panel-body">
                                                    <form method="POST" action='storage/create' accept-charset="UTF-8" enctype="multipart/form-data">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                        <div class="form-group" id="form1">
                                                            <label class="col-md-4 control-label">New file</label>
                                                            <div class="col-md-6">
                                                                <input type="file" class="form-control" name="file" required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Enter a place</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="searchmap" class="form-control" name="lng">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div id="map-canvas2" style="width:780px;height:410px;"></div>
                                                        </div>


                                                        <div class="form-group" id="form2">
                                                            <label class="col-md-4 control-label">Lattitude </label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="lat" pattern="^[-+]?([1-8]?\d(\.\d{1,20})?|90(\.0{1,20})?)$" title="This is an error message" class="form-control" name="lat"  required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group" id="form3">
                                                            <label class="col-md-4 control-label">Longitude</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="lng" pattern="^\s*[-+]?(180(\.0{1,20})?|((1[0-7]\d)|([1-9]?\d))(\.\d{1,20})?)$" title="This is an error message" class="form-control" name="lng"  required="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-7 col-md-offset-4">
                                                                <br>
                                                                <button type="submit" class="btn btn-success">Upload</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="panel-body">


                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif


            <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"> </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRBsKT5uCocA4gfabJk6RBgssqTYspQIk&libraries=places&callback=initMap" async="async">
    </script>



    <script>

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {lat:  48.614399, lng: 21.616646},
                scrollwheel: true,
                zoom: 2,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });

            var map2 = new google.maps.Map(document.getElementById('map-canvas2'), {
                center: {lat:  48.614399, lng: 21.616646},
                scrollwheel: true,
                zoom: 2,
                mapTypeId: google.maps.MapTypeId.HYBRID
            });


            var marker = new google.maps.Marker({
                position: {lat:  48.614399, lng: 21.616646},
                map: map2,
                title: 'First test!',
                draggable: true
            });

            var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

            google.maps.event.addListener(searchBox, 'places_changed',function(){

                var places = searchBox.getPlaces();
                var bounds = new google.maps.LatLngBounds();
                var i,place;

                for(i=0; place = places[i]; i++){
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                }
                map2.fitBounds(bounds);
                map2.setZoom(15);

            });

            google.maps.event.addListener(marker,'position_changed', function(){
               var lat = marker.getPosition().lat;
                var lng = marker.getPosition().lng;

                $('#lat').val(lat);
                $('#lng').val(lng);

            });


        });



        $('#myTabs a[href="#mymap"]').on('show', function(a){

            var fieldId = $('#imageresources').data("thumbnails");


        });


        $('#form2 input[type=text]').on('change invalid', function() {
            var textfield2 = $(this).get(0);

            // 'setCustomValidity not only sets the message, but also marks
            // the field as invalid. In order to see whether the field really is
            // invalid, we have to remove the message first
            textfield2.setCustomValidity('');

            if (!textfield2.validity.valid) {
                textfield2.setCustomValidity('Please add a lattitude!');
            }
        });

        $('#form3 input[type=text]').on('change invalid', function() {
            var textfield3 = $(this).get(0);

            // 'setCustomValidity not only sets the message, but also marks
            // the field as invalid. In order to see whether the field really is
            // invalid, we have to remove the message first
            textfield3.setCustomValidity('');

            if (!textfield3.validity.valid) {
                textfield3.setCustomValidity('Please add a longitude!');
            }
        });

        $('.thumbnails').on("click", function() {
            $('#imagepreview').attr('src', $(this).find('img').attr('src')); // here asign the image to the modal when the user click the enlarge link
            $('#imagemodal').modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function


        });

    </script>


    @yield('scripts')
</body>
</html>