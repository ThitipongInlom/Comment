<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">	
        <title>Admin Page</title>
        <!-- Img Setting -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/set_img.css') }}">
        <!-- animate -->
        <link rel="stylesheet" type="text/css" href="{{ url('css/animate.css') }}">
        <!-- Icheck-2 -->
        <link rel="stylesheet" type="text/css" href="{{ url('node_modules/icheck-bootstrap/icheck-bootstrap.css') }}">
        <!-- Data Table -->
        <link rel="stylesheet" type="text/css" href="{{ url('plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}"> 
        <link rel="stylesheet" type="text/css" href="{{ url('plugins/datatables/Responsive-2.2.2/css/responsive.bootstrap4.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">	
        </head>
        <body class="hold-transition login-page">
        @include('layout.head')
        <br>
        </body>
        <!-- Data Table -->
        <script type="text/javascript" src="{{ url('public/plugins/datatables/datatables.js') }}"></script>
        <script type="text/javascript" src="{{ url('public/plugins/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
        <script type="text/javascript" src="{{ url('public/plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap4.js') }}"></script>
        <!-- Clipboardjs --> 
        <script type="text/javascript" src="{{ url('node_modules/clipboard/dist/clipboard.js') }}"></script>
        <!-- Use script -->
</html>