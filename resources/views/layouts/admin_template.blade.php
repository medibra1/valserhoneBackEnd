<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        Valserhone Admin | @yield('title')
    </title>

    <meta name="description" content="Synapses Technologies Administration">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/font-awesome/css/font-awesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/vendors/themify-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/selectFX/css/cs-skin-elastic.css')}}">

    {{-- CSS --}}
        @yield('css')
    {{-- CSS --}}

    <link rel="stylesheet" href="{{asset('backend/assets/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


<!-- Left Panel -->
@include('include.admin_left_panel')
<!-- /#left-panel -->

<!-- Left Panel -->


<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <!-- Header-->
    @include('include.admin_header')
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        @yield('position')
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        {{-- Content --}}
            @yield('content')
        {{-- Content --}}
    </div> <!-- .content -->

</div><!-- /#right-panel -->

<!-- Right Panel -->



<script src="{{asset('backend/vendors/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('backend/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('backend/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<script src="{{asset('backend/assets/js/delete-modal.js')}}"></script>

<script src="{{asset('backend/assets/js/main.js')}}"></script>

{{-- Scripts --}}

@yield('scripts')

{{-- Scripts --}}


</body>

</html>
