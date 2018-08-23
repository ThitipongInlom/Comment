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
                      <li class="nav-item">
                        <a class="nav-link" href="{{ url('/View_Information') }}">View information</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#Pricing">Conclude</a>
                      </li>
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
      });
    </script>