@extends('layout.master')

@section('content1')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#mypictures" data-toggle="tab"> <span class="glyphicon glyphicon-camera"></span>  My pictures</a>
                            </li>


                            <li><a href="#mymap" data-toggle="tab">  <span class="glyphicon glyphicon-globe"></span>  My Map</a>

                            </li>
                            <li><a href="#other" data-toggle="tab"> <span class="glyphicon glyphicon-picture"></span> Upload pictures</a></li>
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

                            <div class="tab-pane fade" id="other"> <h4> Upload picture </h4>

                                <div class="container">

                                    <div class="row">
                                        <div class="col-sm-8 ">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Add a new picture</div>
                                                <div class="panel-body">
                                                    <form method="POST" action='storage/create' accept-charset="UTF-8" enctype="multipart/form-data">

                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">New file</label>
                                                            <div class="col-md-6">
                                                                <input type="file" class="form-control" name="file" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Lattitude </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="lat"  placeholder="48.614399">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label">Longitude</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" name="lng"  placeholder="-21.616646">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-6 col-md-offset-4">
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


@endsection