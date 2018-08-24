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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">	
</head>
<body class="hold-transition login-page">
    @include('layout.head')
    <br>
    <div class="container">
    <div class="row">
    <div class="col-md-12">

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title text-center">View</h3>
      </div>
      <div class="card-body">
    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
        <thead>
            <tr class="bg-primary" align="center">
                <th>Grop Name</th>
                <th>จำนวน</th>
                <th>วันที่เข้าพัก</th>
                <th>คนส่งแบบสอบถามล่าสุด</th>
                <th>ลิ้งค์ ภาษาอังกฤษ</th>
                <th>ตัวช่วย</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($create_link as $link)
            <tr align="center">
                <td>{{ $link->link_group_name }}</td>
                <td>{{ $link->link_gust_in }}</td>
                <td>{{ date('d-m-Y', strtotime($link->link_staying_from)) }}</td>
                <td></td>
                <td></td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล">View</button>
                </td>
            </tr>
            @endforeach 
        </tbody>
        <tfoot>
            <tr class="bg-primary" align="center">
                <th>Grop Name</th>
                <th>จำนวน</th>
                <th>วันที่เข้าพัก</th>
                <th>คนส่งแบบสอบถามล่าสุด</th>
                <th>ลิ้งค์ ภาษาอังกฤษ</th>
                <th>ตัวช่วย</th>
            </tr>
        </tfoot>
    </table>        
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
  <!-- Use script -->
  <script type="text/javascript">
    $(document).ready(function() { 
    $('#example').DataTable({
    "responsive": "true",  
    "aLengthMenu": [[ 5, -1], [ "5","ทั้งหมด"]],
    "language": {
    "lengthMenu":"แสดง _MENU_ แถว",
    "search":"ค้นหา:",
    "info":"แสดง _START_ ถึง _END_ ทั้งหมด _TOTAL_ แถว",
    "infoEmpty":"แสดง 0 ถึง 0 ทั้งหมด 0 แถว",
    "infoFiltered":"(จาก ทั้งหมด _MAX_ ทั้งหมด แถว)",
    "processing": "กำลังโหลดข้อมูล...",
    "zeroRecords": "ไม่มีข้อมูล",
    "paginate": {
    "first": "หน้าแรก",
    "last": "หน้าสุดท้าย",
    "next": "ต่อไป",
    "previous": "ย้อนกลับ"
    },
    }, 
    "columnDefs": [
    { "targets": 0 },
    { "targets": 1 },
    { "type":"date-eu", "targets": 2 },
    { "targets": 3 },
    { "targets": 4 },
    { "orderable": "false"}
    ],  
    "order":[[2,'desc']],     
    });
    });
  </script>
</html>