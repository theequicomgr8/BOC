<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use DB;
use Session;
class GenralMainController extends Controller
{
    use CommonTrait;
    
    public function ministry_code_list()
    {
        $dbresponse['ministry_data'] = DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh')
                                        ->select('mh.Ministries Head as ministry_head','my.Ministry Name as ministry_name','mh.Head Name as head_name')
                                        ->leftjoin('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as my','mh.New Ministry Code','=','my.Ministry Code')
                                        ->get();

        // echo"<pre>";print_r($ministry_data);die;
        return view('admin.pages.general.ministry_code_list',$dbresponse);
    }

    public function ministry_code_code()
    {
        $dbresponse['ministry_data'] = DB::table('BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2 as mh')
                                        ->select('mh.Ministries Head as ministry_head','my.Ministry Name as ministry_name','mh.Head Name as head_name')
                                        ->leftjoin('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2 as my','mh.New Ministry Code','=','my.Ministry Code')
                                        ->get();

        // echo"<pre>";print_r($ministry_data);die;
        return view('admin.pages.general.ministry_wise_code_list',$dbresponse);
    }


}