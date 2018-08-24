<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class View_Data extends Controller
{
    public function List_View($locale,$encode,$list)
    {
        app()->setLocale($locale);
        $land        = $locale;
        if ($land == 'en' OR $land == 'th') {
        $title_web   = DB::select("select * from setting where Setting_head = 'title_web' and Setting_land = '$land'");
        $head_form   = DB::select("select * from setting where Setting_head = 'head_form' and Setting_land = '$land'");
        $foot_form   = DB::select("select * from setting where Setting_head = 'foot_form' and Setting_land = '$land'");
        $cardhead    = DB::select("select * from head_query where lang = '$land'");
        $cardbody    = DB::select("select * from sup_query where lang = '$land' order by sup_num ASC");
        $grop        = DB::select("select * from create_link where link_encode = '$encode'");

        $Data_view = DB::table('comment_detail')->where('encode', $encode)->where('num_save', $list)->get();
        $CountData = DB::table('comment_detail')->where('encode', $encode)->where('num_save', $list)->count();

        if ($grop != null) {
        if ($CountData == '1') {
        return view('list_data', [
            'title_web' => $title_web,
            'head_form' => $head_form,
            'cardhead'  => $cardhead,
            'cardbody'  => $cardbody,
            'foot_form' => $foot_form,
            'grop'      => $grop,
            'encode'    => $encode,
            'Data_view' => $Data_view,
            'List_View' => $list]); 
        }else{
        return redirect('404'); 	
   		}    
        }else{
        return redirect('404');     
        }  
        }else{
        return redirect('404');
        }    	
    }
}
