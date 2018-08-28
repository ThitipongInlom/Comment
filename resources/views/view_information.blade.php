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
        <h3 class="card-title text-center">View</h3>
      </div>
      <div class="card-body">
    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
        <thead>
            <tr class="bg-primary" align="center">
                <th>Grop Name</th>
                <th>จำนวน</th>
                <th>วันที่เข้าพัก</th>
                <th>รวม</th>
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
                <td>@foreach ($CountTotal as $total)@if ($total->encode == $link->link_encode) <?php echo '<span class="badge badge-primary">'.$total->Totalcount.'</span>';  ?> @endif @endforeach </td>
                <td></td>
                <td></td>
                <td>
                    <button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="ดูข้อมูล" Gropname="{{ $link->link_encode }}" onclick="show_view(this);">View</button>
                </td>
            </tr>
            @endforeach 
        </tbody>
        <tfoot>
            <tr class="bg-primary" align="center">
                <th>Grop Name</th>
                <th>จำนวน</th>
                <th>วันที่เข้าพัก</th>
                <th>รวม</th>
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

    <div class="modal fade" id="popup_view" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h5 class="modal-title">ดูรายการ คอมเม้น</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="display_body_popup_view">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    $(".spinner").hide();
    $(".bodydata").fadeIn(400);         
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

    // Open Link
    var onopenview = function onopenview(e) {
        var link = $(e).attr("linkto");
        window.open(link, '_blank');
    }  

    // To Do On Model Show
    $('#popup_view').on('show.bs.modal', function (e) {
    console.log('TO DO');
    });

    var show_view = function show_view(e) {
        var Gropname = $(e).attr('Gropname');
        $.ajax({
            url: '{{ url('/Table_View') }}',
            type: 'GET',
            data: {Gropname: Gropname},
            success: function (res) {
                var Table = JSON.parse(res);
                $("#display_body_popup_view").html(Table.Table);
                $('#popup_view').modal('show');
                console.log(Table);

            }
        });
        
    }
  </script>
</html>