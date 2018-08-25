@if (Session::has('Login'))
@else
<script>window.location = "{{ url('/404') }}";</script>
@endif
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
					  <div class="card-body">
						<div class="form-group row">
					    <div class="col-md-12" align="center">
					    <label class="col-form-label"><h5><b>Group:</b> {{ $grop[0]->link_group_name }}</h5></label>
					    <br>
					    <label class="col-form-label"><h5><b>From:</b> {{ date('d-m-Y', strtotime($grop[0]->link_staying_from)) }} | <b>To:</b> {{ date('d-m-Y', strtotime($grop[0]->link_staying_to)) }}</h5></label>
					    <br>
					    <label class="col-form-label"><h5><b>Name:</b> {{ $Data_view[0]->firstname }}  {{ $Data_view[0]->lastname }}</h5></label>
					    <br>
					    <label class="col-form-label"><h5><b>Email:</b> {{ $Data_view[0]->email }}</h5></label>
					    <br>
					    <label class="col-form-label"><h5><b>Telephone:</b> {{ $Data_view[0]->telephone }}</h5></label>
					    </div>												
						</div>					 	
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
						                	<input type="radio" class="radiocheck" id="radio{{ $body->id.$body->head_id.$body->head_id }}" name="radio{{ $body->head_id.$body->sup_num }}" value="Yes" 
						                	<?php 	$data = 'radio'.$body->head_id.$body->sup_num; $new_Data_view = $Data_view[0];
						                	if($new_Data_view->$data == 'Yes'){
						                		echo 'checked';
						                	}
						                	?> >
						                	<label for="radio{{ $body->id.$body->head_id.$body->head_id }}"></label>
						                </div>			                			
			                		</td>
			                		<td>
						                <div class="icheck-primary icheck-inline">
						                	<input type="radio" class="radiocheck" id="radio{{ $body->id.$body->head_id.$body->head_id+1 }}" name="radio{{ $body->head_id.$body->sup_num }}" value="No" 
						                	<?php 	$data = 'radio'.$body->head_id.$body->sup_num; $new_Data_view = $Data_view[0];
						                	if($new_Data_view->$data == 'No'){
						                		echo 'checked';
						                	}
						                	?>>
						                	<label for="radio{{ $body->id.$body->head_id.$body->head_id+1 }}"></label>
						                </div>			                			
			                		</td>
			                		<td align="left" valign="baseline"><h4>{{ __('form.no') }}</h4></td>
			                	</tr>
			                </table>
			                <h5 class="animated slideInUp" align="left"><b>{{ __('form.comment') }}</b></h5>
			                <input type="text" class="form-control" name="comment{{ $body->head_id.$body->sup_num }}"
			                <?php $data = 'comment'.$body->head_id.$body->sup_num; $new_Data_view = $Data_view[0];
						    if($new_Data_view->$data){
						        echo 'value="'.$new_Data_view->$data.'"';
						    }
						    ?> disabled>
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
					  </div>
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
    			var urlsend = "{{ url('/en') }}/{{ $grop[0]->link_encode }}/{{ $List_View }}";
    		}else if (value == 'th') {
    			var urlsend = "{{ url('/th') }}/{{ $grop[0]->link_encode }}/{{ $List_View }}";
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
