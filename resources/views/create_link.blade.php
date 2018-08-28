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
        <!-- Data Table -->
        <link rel="stylesheet" type="text/css" href="{{ url('plugins/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('plugins/datatables/Responsive-2.2.2/css/responsive.bootstrap4.css') }}">
        <!--  Date picker-->
        <link rel="stylesheet" type="text/css" href="{{ url('plugins/datepicker/css/bootstrap-datepicker.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">	
        <style type="text/css">
        .bodydata{
          display: none;
        }       
        .spinner {
          margin: 100px auto 0;
          width: 70px;
          text-align: center;
        }

        .spinner > div {
          width: 18px;
          height: 18px;
          background-color: #333;

          border-radius: 100%;
          display: inline-block;
          -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
          animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        }

        .spinner .bounce1 {
          -webkit-animation-delay: -0.32s;
          animation-delay: -0.32s;
        }

        .spinner .bounce2 {
          -webkit-animation-delay: -0.16s;
          animation-delay: -0.16s;
        }

        @-webkit-keyframes sk-bouncedelay {
          0%, 80%, 100% { -webkit-transform: scale(0) }
          40% { -webkit-transform: scale(1.0) }
        }

        @keyframes sk-bouncedelay {
          0%, 80%, 100% { 
            -webkit-transform: scale(0);
            transform: scale(0);
          } 40% { 
            -webkit-transform: scale(1.0);
            transform: scale(1.0);
          }
        }            
        </style>           	
</head>
<body class="hold-transition login-page">
    @include('layout.head')
    <br>
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>    
    <div class="container bodydata">
    <div class="row">
    <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title text-center">Create Link</h3>
      </div>
      <div class="card-body">
        <div align="center">
        <form action="{{ url('/Do_create_link') }}" method="post" accept-charset="utf-8">
        @csrf
          <div class="form-group">
            <label for="groupname"><h4>Group Name</h4></label>
            <input type="text" class="form-control col-4" id="groupname" name="groupname" placeholder="Group Name" required>
          </div>
          <div class="form-group">
            <label for="number_of_people"><h4>Number OF People</h4></label>
            <input type="text" class="form-control col-4" id="number_of_people" name="numberprople" placeholder="Number OF People" required>
          </div>
          <div class="form-group">
            <label for="room_to_use"><h4>Room To USE</h4></label><br>
              <select id="room_to_use" name="room" class="custom-select col-4" required>
                @foreach ($room as $row)
                <option value="{{ $row->room_name }}">{{ $row->room_name }}</option>
                @endforeach 
              </select>
          </div>          
          <div class="form-group">
            <label for="number_of_people"><h4>Stay From</h4></label>
            <input type="text" class="form-control col-2 datepicker" id="number_of_people" name="stayin" placeholder="Stay From" required>
          </div>  
          <div class="form-group">
            <label for="number_of_people"><h4>Stay To</h4></label>
            <input type="text" class="form-control col-2 datepicker" id="number_of_people" name="stayto"  placeholder="Stay To" required>
          </div>   
          <hr>           
          <button class="btn btn-outline-success">Create</button>    
        </form>
        </div>
      </div>
      </div>
    </div>   
    </div>   
    </div>
</body>
	<!-- All Js -->
	<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
  <!-- Data Table -->
  <script type="text/javascript" src="{{ url('public/plugins/datatables/datatables.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/plugins/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap4.js') }}"></script>
  <!--  Date picker-->
  <script type="text/javascript" src="{{ url('public/plugins/datepicker/js/bootstrap-datepicker.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/plugins/datepicker/locales/bootstrap-datepicker.th.min.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
    $(".spinner").hide();
    $(".bodydata").fadeIn(400);       
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      language: 'th',
      todayHighlight: true,
    });
    });
  </script>
</html>