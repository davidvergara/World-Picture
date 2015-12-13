@extends('layout.master')

@section('map')
    <style>

        #map-canvas{
            width: 250px;
            height: 350px;
        }

    </style>

    <script src="ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"> </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRBsKT5uCocA4gfabJk6RBgssqTYspQIk&libraries=places" type="text/javascript">
    </script>

    <div class="container">
        <div class="col-sm-4">
            <h1> Add a picture - Location </h1>
            {!! Form::open(array('url'=> 'auth/map' , 'files' => true))!!}
                <div class="form-group">
                    <label for="title"> </label>
                    <input type="text" class=form-control" name="title">
                </div>

            <div class="form-group">
                <label for="Map"> </label>
                <input type="text" id="searchmap">
                <div id="map-canvas"> </div>
            </div>

            <div class="form-group">
                <label for="Lat"> </label>
                <input type="text" class=form-control" name="lat" id="lat">
            </div>

            <div class="form-group">
                <label for="Long"> </label>
                <input type="text" class=form-control" name="lng" id="lng">
            </div>

            <button type="submit" class="btn btn-success" style="margin-right: 15px;">
                Add Picture
            </button>
            {!! Form::close()!!}
        </div>
    </div>

    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            center:{
                lat: 27.72,
                long: 85.36
            },
            zoom:15
        });

    </script>

@endsection