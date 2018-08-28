<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
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

        $backnum   = $list - 1;
        $Backpage  = DB::table('comment_detail')->where('encode', $encode)->where('num_save', $backnum)->count();
        $nextnum   = $list + 1;
        $Nextpage  = DB::table('comment_detail')->where('encode', $encode)->where('num_save', $nextnum)->count();

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
            'List_View' => $list,
            'locale'    => $locale,
            'Backpage'  => $Backpage,
            'Nextpage'  => $Nextpage,
            'backnum'   => $backnum,
            'nextnum'   => $nextnum]); 
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

    public function Table_View()
    {
    	$encode = Input::get('Gropname');
    	$Data_Grop = DB::select("SELECT * FROM comment_detail WHERE encode = '$encode'");
    	$CountData = DB::table('comment_detail')->where('encode', $encode)->count();

    	$table  = "<table class='table table-sm table-bordered'>";
    	$table .= "<thead><tr align='center' class='bg-primary'><th>ลำดับ</th><th>ชื่อลูกค้า</th><th>เบอร์ลูกค้า</th><th>วันที่เวลาที่ลูกค้าส่ง</th><th>E-mail</th><th>ตัวช่วย</th></tr></thead><tbody>";
    	$i = 0;
    	foreach ($Data_Grop as $key => $data) {
    	$i++;
    	$table .= "<tr align='center'><td>$i</td><td>".$data->firstname.' '.$data->lastname."</td><td>".$data->telephone."</td><td>".$data->Today."</td><td>".$data->email."</td><td><button class='btn btn-sm btn-success' data-toggle='tooltip' data-placement='top' title='เปิดลิ้งค์' linkto='". url('').'/th'.'/'.$data->encode.'/'.$data->num_save ."' onclick='  onopenview(this)'><i class='fas fa-external-link-alt'></i></button></td></tr>";
    	}
    	$table .= "</tbody></table>";

    	$array = array('Table' => $table, 'Data' => $Data_Grop);
    	echo json_encode($array);
    }
}
