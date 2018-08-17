    @if (Session::has('Login'))
    @else
    <script>window.location = "{{ url('/Admin') }}";</script>
    @endif
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
                        <a class="nav-link" href="#Home">Home <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#Features">Features</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#Pricing">Pricing</a>
                      </li>
                    </ul>                
                    <a href="{{ url('/Logout') }}">
                    <button type="button" class="btn btn-sm btn-primary">Logout</button>
                    </a>                    
                  </div>
                </nav>
            </div>
        </div>
    </div>