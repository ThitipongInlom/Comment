<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">	
        <title>Admin Page</title>
        <!-- All Css -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
        <!-- Img Setting -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/set_img.css') }}">
        <!-- animate -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/animate.css') }}">
        <!-- Icheck-2 -->
        <link rel="stylesheet" type="text/css" href="{{ url('node_modules/icheck-bootstrap/icheck-bootstrap.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">		
</head>
<body class="hold-transition login-page">
    @include('layout.head')
    <br>
    <div class="container">
    <div class="row">
    <div class="col-md-6">
    <div class="card text-center">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        GO
      </div>
      <div class="card-footer text-muted">
        2 days ago
      </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="card text-center">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        GO
      </div>
      <div class="card-footer text-muted">
        2 days ago
      </div>
    </div>
    </div>    
    </div>
    </div>
</body>
	<!-- All Js -->
	<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
</html>