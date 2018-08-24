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

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function Show_welcome_encode($locale,$encode)
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
        if ($grop != null) {
        return view('welcome', [
            'title_web' => $title_web,
            'head_form' => $head_form,
            'cardhead'  => $cardhead,
            'cardbody'  => $cardbody,
            'foot_form' => $foot_form,
            'grop'      => $grop,
            'encode'    => $encode]);  
        }else{
        return redirect('404');   
        }  
        }else{
        return redirect('404');
        }
    }       

    public function View_Information()
    {
        $create_link = DB::select("select * from create_link");
        return view('view_information',[
            'create_link' => $create_link,
            ]); 
    }


    public function Save_Data()
    {
        date_default_timezone_set("Asia/Bangkok");
        $today = now();

        // Count Grop And Plus 1
        $countdata = DB::table('comment_detail')->where('encode', $_POST['encode'])->count();
        $recountdata = $countdata+1;
         
        // Insert Data
        DB::table('comment_detail')->insert([
        'num_save'   => $recountdata,
        'encode'     => $_POST['encode'],
        'token_save' => $_POST['_token'],
        'Today'      => $today
        ]);

        // Turn id lastinsert
        $id = DB::getPdo()->lastInsertId();

        // Update Comment
        DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update([
            'comment11'  => $_POST['comment11'],
            'comment12'  => $_POST['comment12'],
            'comment13'  => $_POST['comment13'],
            'comment21'  => $_POST['comment21'],
            'comment22'  => $_POST['comment22'],
            'comment23'  => $_POST['comment23'],
            'comment24'  => $_POST['comment24'],
            'comment31'  => $_POST['comment31'],
            'comment310' => $_POST['comment310'],
            'comment311' => $_POST['comment311'],
            'comment312' => $_POST['comment312'],
            'comment32'  => $_POST['comment32'],
            'comment33'  => $_POST['comment33'],
            'comment34'  => $_POST['comment34'],
            'comment35'  => $_POST['comment35'],
            'comment36'  => $_POST['comment36'],
            'comment37'  => $_POST['comment37'],
            'comment38'  => $_POST['comment38'],
            'comment39'  => $_POST['comment39'],
            'comment41'  => $_POST['comment41'],
            'comment42'  => $_POST['comment42'],
            'comment51'  => $_POST['comment51'],
            'comment52'  => $_POST['comment52'],
            'comment53'  => $_POST['comment53'],
            'firstname'  => $_POST['firstname'],
            'lastname'   => $_POST['lastname'],
            'telephone'  => $_POST['telephone'],
            'email'      => $_POST['email'],
            ]);

        // Update Radio    
        if (isset($_POST['radio11'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio11'  => $_POST['radio11']]);
        }
        if (isset($_POST['radio12'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio12'  => $_POST['radio12']]);
        }
        if (isset($_POST['radio13'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio13'  => $_POST['radio13']]);
        }
        if (isset($_POST['radio21'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio21'  => $_POST['radio21']]);
        }
        if (isset($_POST['radio22'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio22'  => $_POST['radio22']]);
        }
        if (isset($_POST['radio23'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio23'  => $_POST['radio23']]);
        }
        if (isset($_POST['radio24'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio24'  => $_POST['radio24']]);
        }
        if (isset($_POST['radio31'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio31'  => $_POST['radio31']]);
        }
        if (isset($_POST['radio310'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio310'  => $_POST['radio310']]);
        }
        if (isset($_POST['radio311'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio311'  => $_POST['radio311']]);
        }
        if (isset($_POST['radio312'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio312'  => $_POST['radio312']]);
        }
        if (isset($_POST['radio32'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio32'  => $_POST['radio32']]);
        }
        if (isset($_POST['radio33'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio33'  => $_POST['radio33']]);
        }
        if (isset($_POST['radio34'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio34'  => $_POST['radio34']]);
        }
        if (isset($_POST['radio35'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio35'  => $_POST['radio35']]);
        }
        if (isset($_POST['radio36'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio36'  => $_POST['radio36']]);
        }
        if (isset($_POST['radio37'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio37'  => $_POST['radio37']]);
        }
        if (isset($_POST['radio38'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio38'  => $_POST['radio38']]);
        }
        if (isset($_POST['radio39'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio39'  => $_POST['radio39']]);
        }
        if (isset($_POST['radio41'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio41'  => $_POST['radio41']]);
        }
        if (isset($_POST['radio42'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio42'  => $_POST['radio42']]);
        }
        if (isset($_POST['radio51'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio51'  => $_POST['radio51']]);
        }
        if (isset($_POST['radio52'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio52'  => $_POST['radio52']]);
        }
        if (isset($_POST['radio53'])) {
            DB::table('comment_detail')
            ->where('comment_id', $id)
            ->update(['radio53'  => $_POST['radio53']]);
        }

        // Go Page New Error
        return redirect('Star');

    }


}
