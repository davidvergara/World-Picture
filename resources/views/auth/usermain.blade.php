@extends('layout.master')

@section('usermain')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#mypictures" data-toggle="tab"> <span class="glyphicon glyphicon-camera"></span>  My pictures</a></li>
                            <li><a href="#mymap" data-toggle="tab">  <span class="glyphicon glyphicon-globe"></span>  My Map</a></li>
                            <li><a href="#other" data-toggle="tab">Other</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="mypictures"> <h4> My pictures

                                </h4>

                            </div>
                            <div class="tab-pane fade" id="mymap"> <h4> My Map </h4> Pictures on the map </div>
                            <div class="tab-pane fade" id="other"> <h4> Other </h4> Other stuff </div>
                        </div>

                    </div>
                    <div class="panel-body">


                    </div>
                </div>
            </div>
        </div>
    </div>
@stop