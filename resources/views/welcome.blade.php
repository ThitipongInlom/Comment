<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
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
    <body style="background-color: rgb(239, 234, 225);">
		<div class="row"> 	
    	<div class="containerimg">
    	<div class="overlay">{{ $title_web[0]->Setting_detail }}</div>
    	<div  align="center" class="form_data">
       		<div class="col-md-2 col-xs-2"></div>
        	<div class="col-md-8 col-xs-6">
				<div class="card card-warning  card-outline">
				<div class="card-header" >	
				  <ul class="nav nav-tabs card-header-tabs pull-xs-left">
				      <li class="nav-item col-xs-12">
				        <a class="nav-link active"><h4 class="animated lightSpeedIn box-title card-title" align="left"><b>{{ $head_form[0]->Setting_detail }}</b></h4></a>
				      </li>
				  </ul>				  				
				  <div class="card-tools col-xs-12">
					<select class="custom-select" onchange="land(this);">
					  <option value="en" @if ( app()->getLocale()  == 'en')
					  	{{ 'selected' }}
					  @endif>EN</option>
					  <option value="th" @if ( app()->getLocale()  == 'th')
					  	{{ 'selected' }}
					  @endif>TH</option>
					</select>
                  </div>				  
				  </div>
				  	  <form action="{{ url('/Save_Data') }}" method="POST" accept-charset="utf-8">
				  	  <input type="hidden" name="encode" value="{{ $encode }}">
				  	  @csrf
					  <div class="card-body">
					  	@foreach ($cardhead as $card)
					  	<!-- Start Card FQA -->
						<div class="card card-outline">
			              <div class="card-header bg-danger">
			              <h3 class="card-title animated slideInUp" align="left"><b>{{ $card->detail }}:</b></h3>
			              </div>
			              <div class="card-body">
			              	@foreach ($cardbody as $body)
			              	@if ($body->head_id == $card->head_id_sub)
			              	<!-- Start Body -->
			                <h4 align="left">{{ $body->query }} <span style="color: red;"><b>*</b></span></h4>
			                <table class="table" cellspacing="0" cellpadding="0">
			                	<tr>
			                		<td align="right" valign="baseline"><h4>{{ __('form.yes') }}</h4></td>
			                		<td align="right">
						                <div class="icheck-primary icheck-inline">
						                	<input type="radio" class="radiocheck" id="radio{{ $body->id.$body->head_id.$body->head_id }}" name="radio{{ $body->head_id.$body->sup_num }}" value="Yes" required>
						                	<label for="radio{{ $body->id.$body->head_id.$body->head_id }}"></label>
						                </div>			                			
			                		</td>
			                		<td>
						                <div class="icheck-primary icheck-inline">
						                	<input type="radio" class="radiocheck" id="radio{{ $body->id.$body->head_id.$body->head_id+1 }}" name="radio{{ $body->head_id.$body->sup_num }}" value="No" required>
						                	<label for="radio{{ $body->id.$body->head_id.$body->head_id+1 }}"></label>
						                </div>			                			
			                		</td>
			                		<td align="left" valign="baseline"><h4>{{ __('form.no') }}</h4></td>
			                	</tr>
			                </table>
			                <h5 class="animated slideInUp" align="left"><b>{{ __('form.comment') }}</b></h5>
			                <input type="text" class="form-control" placeholder="Comment" name="comment{{ $body->head_id.$body->sup_num }}">
			                <br>
			                <!-- End Body -->
			                @endif
			                @endforeach	
			              </div>
			            </div>	
			            <!-- End Card FQA -->    					
						@endforeach	
						<hr>
						<h5>{{ $foot_form[0]->Setting_detail }}</h5>
						<hr>
						<div class="form-group row">
					    <div class="col-md-12" align="center">
					    <label class="col-form-label"><h5><b>Group:</b> {{ $grop[0]->link_group_name }}</h5></label>
					    <br>
					    <label class="col-form-label"><h5><b>From:</b> {{ date('d-m-Y', strtotime($grop[0]->link_staying_from)) }} | <b>To:</b> {{ date('d-m-Y', strtotime($grop[0]->link_staying_to)) }}</h5></label>
					    </div>												
						</div>
						<div class="form-group row">
						  <label for="firstname" class="col-sm-2 col-form-label">{{ __('form.firstname') }} :</label>
						  <div class="col-sm-4">
						    <input type="text" class="form-control" id="firstname" placeholder="{{ __('form.firstname') }}" name="firstname"  required>
						  </div>
						  <label for="lastname" class="col-sm-2 col-form-label">{{ __('form.lastname') }} :</label>
						  <div class="col-sm-4">
						    <input type="text" class="form-control" id="lastname" placeholder="{{ __('form.lastname') }}" name="lastname" required>
						  </div>						    
						</div>
						<div class="form-group row">
						  <label for="telephone" class="col-sm-2 col-form-label">{{ __('form.telephone') }} :</label>
						  <div class="col-sm-4">
						    <input type="text" class="form-control" id="telephone" placeholder="{{ __('form.telephone') }}" name="telephone" required>
						  </div>
						  <label for="email" class="col-sm-2 col-form-label">{{ __('form.email') }} :</label>
						  <div class="col-sm-4">
						    <input type="text" class="form-control" id="email" placeholder="{{ __('form.email') }}" name="email" required >
						  </div>						    
						</div>						
					  	<br>						
			            <div align="center">
			            	<button type="submit" class="btn btn-outline-success">{{ __('form.send') }}</button>
			            </div>
					  </div>
					  </form>
				</div>
        	</div>
        	</div>
        </div>	
    </body>
    <!-- Change language -->
    <script type="text/javascript">
    	var land = function land(e) {
    		var value = e.value;
    		if (value == 'en') {
    			var urlsend = "{{ url('/en') }}/{{ $grop[0]->link_encode }}";
    		}else if (value == 'th') {
    			var urlsend = "{{ url('/th') }}/{{ $grop[0]->link_encode }}";
    		}
    		window.location.href = urlsend;
    	}
		var elements = document.getElementsByClassName("radiocheck");
		for (var i = 0; i < elements.length; i++) {
		    elements[i].oninvalid = function(e) {
		        e.target.setCustomValidity("");
		        if (!e.target.validity.valid) {
		            e.target.setCustomValidity("{{ __('form.requiredradio') }}");
		        }
		    };
		    elements[i].oninput = function(e) {
		        e.target.setCustomValidity("");
		    };
		}   	
    </script>
    <!-- All Js -->
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
</html>
