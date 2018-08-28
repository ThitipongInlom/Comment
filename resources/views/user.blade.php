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
                      <div class="card-header text-center">
                        <h3 class="card-title">จัดการ User</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#adduser" data-toggle="tooltip" data-placement="top" title="สร้าง User ใหม่">Add User</button>
                        </div>                        
                      </div>
                      <div class="card-body">
                        <table class="table table-sm table-bordered" id="tableuser">
                            <thead>
                                <tr align="center">
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th>Update Login</th>
                                    <th>ตัวช่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $data)
                                <tr align="center">
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                    @if ($data->status == '0')
                                    {{ 'Admin' }}    
                                    @endif
                                    @if ($data->status == '1')
                                    {{ 'User' }}
                                    @endif
                                    </td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($data->created_at)) }}</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($data->updated_at)) }}</td>
                                    <td>

                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                      </div>
                    </div>                   
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="Add User" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="{{ url('/Add_User') }}" method="post" accept-charset="utf-8">
              @csrf
              <div class="modal-header bg-primary">
                <h5 class="modal-title" id="Add User">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" align="center">
                  <div class="form-group">
                    <label for="inputname"><h4>Name</h4></label>
                    <input type="text" class="form-control" id="inputname" name="inputname" placeholder="Name" required>
                  </div>     
                  <div class="form-group">
                    <label for="inputusername"><h4>Username</h4></label>
                    <input type="text" class="form-control" id="inputusername" name="inputusername" placeholder="Username" required>
                  </div> 
                  <div class="form-group">
                    <label for="inputpassword"><h4>Password</h4></label>
                    <input type="text" class="form-control" id="inputpassword" name="inputpassword" placeholder="Password" required>
                  </div>   
                  <div class="form-group">
                    <label for="inputpemail"><h4>E-mail</h4></label>
                    <input type="text" class="form-control" id="inputpemail" name="inputpemail" placeholder="E-mail" required>
                  </div> 
                  <div class="form-group">
                    <label for="usertype"><h4>Type</h4></label><br>
                      <select id="usertype" name="Type" class="custom-select col-4" required>
                        <option value="1">User</option>
                        <option value="0">Admin</option>
                      </select>
                  </div>                                                                                 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        </body>
        <!-- Data Table -->
        <script type="text/javascript" src="{{ url('public/plugins/datatables/datatables.js') }}"></script>
        <script type="text/javascript" src="{{ url('public/plugins/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
        <script type="text/javascript" src="{{ url('public/plugins/datatables/Responsive-2.2.2/js/responsive.bootstrap4.js') }}"></script>
        <!-- Clipboardjs --> 
        <script type="text/javascript" src="{{ url('node_modules/clipboard/dist/clipboard.js') }}"></script>
        <!-- Use script -->
        <script type="text/javascript">
            $(document).ready(function() {
                $(".spinner").hide();
                $(".bodydata").fadeIn(400);               
                $("#tableuser").DataTable({
                "responsive": "true",  
                "aLengthMenu": [[ 5, 10, -1], [ "5", "10", "ทั้งหมด"]],
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
                "order":[[0,'desc']],  
                "columnDefs": [
                { "targets": 0 },
                { "targets": 1 },
                { "targets": 2 },
                { "targets": 3 },
                { "type":"date-eu", "targets": 4 },
                { "orderable": "false"}
                ],                                      
                });
            });
        </script>
</html>