    @if (Session::has('Login'))
    @else
    <script>window.location = "{{ url('/Admin') }}";</script>
    @endif
    <!-- All Css -->
    <link rel="stylesheet" type="text/css" href="{{ url('css/app.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <a class="navbar-brand" href="{{ url('/Dashboard') }}">Dashboard</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/Create_Link') }}">Create Link <span class="sr-only">(current)</span></a>
                      </li>
                      @if (Session::get('Login.0')->status == '0')
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ url('/User') }}">จัดการผู้ใช้งาน</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </li>  
                      @endif                    
                    </ul>                
                    <a href="{{ url('/Logout') }}">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="ก็อปปี้ข้อมูล">Logout</button>
                    </a>                    
                  </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- All Js -->
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>    
    <script type="text/javascript">
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip(); 
        $("[data-toggle='tooltip']").tooltip();
      });
    </script>