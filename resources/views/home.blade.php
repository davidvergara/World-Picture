@extends('layout.master2')

@section('content')
    <!--<div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <b>Welcome</b>

                    </div>

                    <div class="panel-body">
                        <img style="max-width:850px; " src="/bosqueHOME.jpg">

                    </div>
                </div>
            </div>
        </div>
    </div>-->


<style>

    body {
        background: url('{{ asset('bosqueHOME.jpg') }}')  no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
@endsection



