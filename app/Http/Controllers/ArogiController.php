<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class ArogiController extends Controller
{
    
    public function roblist()  //list data show
    {
        $current_url = last(request()->segments());
        if($current_url == "roblist")
        {
            if(Session::get('UserID')){
                $user_id=Session('UserID');
                // $fetch = DB::select("select * from dbo.[rob_forms] where [user_id]='".$user_id."' order by [Pk_id] desc");
                $fetch=DB::table('rob_forms')
                        // ->leftJoin('rob_documents','rob_forms.Pk_id','=','rob_documents.rob_form_id')
                        ->where('user_id',$user_id)
                        ->where('document_type','<>','')
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.roblist',["data"=>$fetch]);
           }
           return redirect('/rob-login');
        }   
    }

    public function headquat()
    {
        $usertype=Session::get('UserType');
        if($usertype=='2')
        {
            $userName=Session::get('UserName');
            $hqs=DB::table('rob_fob_details')->where('user_name',$userName)->first();
            echo "<option value='".$hqs->rob_hq."'>".$hqs->rob_hq."</option>";
        }
        else //add 1 apr
        {
            $userName=Session::get('UserName');
            $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
            $robid=$findFobData->RobId;
            $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
            $robname=$robdetail->RobName;

            $hqs=DB::table('rob_fob_details')->where('user_name',$robname)->first();
            echo "<option value='".$hqs->rob_hq."'>".$hqs->rob_hq."</option>";
        }
        
    }
    public function foregion()
    {
        $userName=Session::get('UserName');
        $usertype=Session::get('UserType');
        if($usertype=='2')
        {
            $fos=DB::table('rob_fob_details')->where('user_name',$userName)->get();
            foreach($fos as $fo)
            {
                echo "<option value='".$fo->rob_fo."'>".$fo->rob_fo."</option>";
            }
        }
        else //add 1 apr
        {
            $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
            $robid=$findFobData->RobId;
            $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
            $robname=$robdetail->RobName;

            $fos=DB::table('rob_fob_details')->where('user_name',$robname)->get();
            foreach($fos as $fo)
            {
                echo "<option value='".$fo->rob_fo."'>".$fo->rob_fo."</option>";
            }
        }
         
    }

    public function rob_form_type()
    {
        return view('rob.rob-form-type');
    }

    //when you choose form type and click submit then redirect this function and open form which you choose.
    public function rob_form_type_submit(Request $request)
    {
        $type=$request->davp_code;
        Session::put('formType',$type);
        if($type==1)
        {

            $user_id=Session::get('UserID');
            $userName=Session::get('UserName');
            $usertype=Session::get('UserType');
            if($usertype=='2')
            {
                $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

            }
            else
            {
                $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                $robid=$findFobData->RobId;
                $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                $robname=$robdetail->RobName;
                $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                Session::put('rob_name',$robname);
            }

            @$data=DB::table('rob_forms')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
            $id=@$data->Pk_id; //get id for check condition in special area
            $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
            $list=[];
            foreach($sdata as $ssdata)
            {
                $list[]=$ssdata->special_area;
            }
            //for rob_documents
            @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
            @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
            // return $rob_documents->document_type;
            $count=count($rob_documents);
            //for ministry name
            $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
            // if($count > 0)
            if(@$data->status=='1')
            {
                $rob_documents[]='';
                $press[]='';
                return view('rob.rob-firstForm',compact('offTyp','offRegion','rob_documents','press','ministry_data'));
            }
            else
            {
                // return $data;
                return view('rob.rob-firstForm',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data'));
            }
        }
        else
        {
            // dd('pre form');
            $user_id=Session::get('UserID');
            $userName=Session::get('UserName');
            $usertype=Session::get('UserType');
            if($usertype=='2')
            {
                $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

            }
            else
            {
                $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                $robid=$findFobData->RobId;
                $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                $robname=$robdetail->RobName;
                $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                Session::put('rob_name',$robname);
            }

            @$data=DB::table('rob_forms')->where(['user_id'=>$user_id,'form_type'=>0])->orderBy('Pk_id','desc')->first();
            $id=@$data->Pk_id; //get id for check condition in special area
            $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
            $list=[];
            foreach($sdata as $ssdata)
            {
                $list[]=$ssdata->special_area;
            }
            //for rob_documents
            @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
            @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
            // return $rob_documents->document_type;
            $count=count($rob_documents);
            //for ministry name
            $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
            // if($count > 0)
            if(@$data->status=='1')
            {
                $rob_documents[]='';
                $press[]='';
                return view('rob.pre-activity-form',compact('offTyp','offRegion','rob_documents','press','ministry_data'));
            }
            else
            {
                // return $data;
                return view('rob.pre-activity-form',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data'));
            }
        }
    }



    public function index($id='')
    {
        // UserName
        if(Session::get('UserID')){
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;
                    
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();
                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }
                // return $list;
                // return view('rob.dataform',["data"=>$data,"special_data"=>$list]);
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                return view('rob.rob-firstForm',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data'));
            }
            else{
                $user_id=Session::get('UserID');
                $userName=Session::get('UserName');
                //31 march
                $usertype=Session::get('UserType');
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //31 march end
                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); // comment 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                @$data=DB::table('rob_forms')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
                $id=@$data->Pk_id; //get id for check condition in special area
                $sdata=DB::table('Special_Areas')->where('pk_id',$id)->get();
                $list=[];
                foreach($sdata as $ssdata)
                {
                    $list[]=$ssdata->special_area;
                }
                //for rob_documents
                @$rob_documents=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>0])->get();
                @$press=DB::table('rob_documents')->where(["rob_form_id"=>$id,"image_type"=>1])->get();
                // return $rob_documents->document_type;
                $count=count($rob_documents);

                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();

                // if($count > 0)
                if(@$data->status=='1')
                {
                    // return $count;
                    $rob_documents[]='';
                    $press[]='';
                    return view('rob.rob-firstForm',compact('offTyp','offRegion','rob_documents','press','ministry_data'));
                }
                else
                {
                    // return $data;
                    return view('rob.rob-firstForm',compact('data','list','rob_documents','offTyp','offRegion','press','ministry_data'));
                }
                
            }
            
        }
        return redirect('/rob-login');
        // return view('rob.rob-firstForm');
    }



    public function rob_insert(Request $request)
    {
        // return "hello";
        // $activity_checkbox1=$request->activity_checkbox1 ?? '0';
        $activity_checkbox1= implode(",", $request->activity_checkbox1);
        $direct_settlement_bill_pao=$request->direct_settlement_bill_pao ?? ' ';
        
        //single start
        $engagement_pre_event_activity=$request->engagement_pre_event_activity ?? '0';
        $engagement_txt_pre_event=$request->engagement_txt_pre_event ?? '';
        //single end

        //5start
        $nukkad_natak_pre_event_activity=$request->nukkad_natak_pre_event_activity ?? '0';
        $nukkad_natak_txt_pre_event=$request->nukkad_natak_txt_pre_event ?? '';
        $public_meeting_pre_event_activity=$request->public_meeting_pre_event_activity ?? '0';
        $public_meeting_txt_pre_event=$request->public_meeting_txt_pre_event ?? '';
        $public_announcement_pre_event_activity=$request->public_announcement_pre_event_activity ?? '0';
        $public_announcement_txt_pre_event=$request->public_announcement_txt_pre_event ?? '';
        $distribution_pamphlets_pre_event_activity=$request->distribution_pamphlets_pre_event_activity ?? '0';
        $distribution_pamphlets_txt_pre_event=$request->distribution_pamphlets_txt_pre_event ?? '';
        $social_media_pre_event_activity=$request->social_media_pre_event_activity ?? '0';
        $social_media_txt_pre_event=$request->social_media_txt_pre_event ?? '';
        //5end
                
        //9start
        $nukkad_natak1_pre_event_activity=$request->nukkad_natak1_pre_event_activity ?? '0';
        $nukkad_natak1_txt_pre_event=$request->nukkad_natak1_txt_pre_event ?? '';
        $public_meeting1_pre_event_activity=$request->public_meeting1_pre_event_activity ?? '0';
        $public_meeting1_txt_pre_event=$request->public_meeting1_txt_pre_event ?? '';
        $public_announcement1_pre_event_activity=$request->public_announcement1_pre_event_activity ?? '0';
        $public_announcement1_txt_pre_event=$request->public_announcement1_txt_pre_event ?? '';
        $distribution_pamphlets1_pre_event_activity=$request->distribution_pamphlets1_pre_event_activity ?? '0';
        $distribution_pamphlets1_txt_pre_event=$request->distribution_pamphlets1_txt_pre_event ?? '';
        $social_media_campaign1_pre_event=$request->social_media_campaign1_pre_event ?? '0';
        $social_media_campaign1_txt_pre_event=$request->social_media_campaign1_txt_pre_event ?? '';
        $public_rally_pre_event_activity=$request->public_rally_pre_event_activity ?? '0';
        $public_rally_txt_pre_event=$request->public_rally_txt_pre_event ?? '';
        $media_briefing_pre_event_activity=$request->media_briefing_pre_event_activity ?? '0';
        $media_briefing_txt_pre_event=$request->media_briefing_txt_pre_event ?? '';
        $dd_air_curtain_pre_activity=$request->dd_air_curtain_pre_activity ?? '0';
        $dd_air_curtain_txt_pre_activity=$request->dd_air_curtain_txt_pre_activity ?? '';
        $social_media_campaign_pre_event=$request->social_media_campaign_pre_event ?? '0';
        $social_media_campaign_txt_pre_event=$request->social_media_campaign_txt_pre_event ?? '';
        //9 end

        //Main Programmes start
        $mobile_station_main_event_activity=$request->mobile_station_main_event_activity ?? '0';
        $mobile_station_main_no_program=$request->mobile_station_main_no_program ?? '';
        $mobile_station_main_remark=$request->mobile_station_main_remark ?? '';
        $painting_poetry_rangoli_main_activity=$request->painting_poetry_rangoli_main_activity ?? '0';
        $painting_poetry_rangoli_main_no_program=$request->painting_poetry_rangoli_main_no_program ?? '';
        $painting_poetry_rangoli_main_remark=$request->painting_poetry_rangoli_main_remark ?? '';
        $debate_seminar_symposium_main_event=$request->debate_seminar_symposium_main_event ?? '0';
        $debate_seminar_symposium_main_no_program=$request->debate_seminar_symposium_main_no_program ?? '';
        $debate_seminar_symposium_main_remark=$request->debate_seminar_symposium_main_remark ?? '';
        $testimonials_main_event=$request->testimonials_main_event ?? '0';
        $testimonials_main_no_program=$request->testimonials_main_no_program ?? '';
        $testimonials_main_remark=$request->testimonials_main_remark ?? '';
        $felicitiation_main_event=$request->felicitiation_main_event ?? '0';
        $felicitiation_main_no_program=$request->felicitiation_main_no_program ?? '';
        $felicitiation_main_remark=$request->felicitiation_main_remark ?? '';
        $identifying_opinion_main_event=$request->identifying_opinion_main_event ?? '0';
        $identifying_opinion_main_no_program=$request->identifying_opinion_main_no_program ?? '';
        $identifying_opinion_main_remark=$request->identifying_opinion_main_remark ?? '';
        $expert_lectures_main_event=$request->expert_lectures_main_event ?? '0';
        $expert_lectures_main_no_program=$request->expert_lectures_main_no_program ?? '';
        $expert_lectures_main_remark=$request->expert_lectures_main_remark ?? '';
        $workshop_main_event=$request->workshop_main_event ?? '0';
        $workshop_main_no_program=$request->workshop_main_no_program ?? '';
        $workshop_main_remark=$request->workshop_main_remark ?? '';
        $media_station_workshop_main_event=$request->media_station_workshop_main_event ?? '0';
        $media_station_workshop_main_no_programm=$request->media_station_workshop_main_no_programm ?? '';
        $media_station_workshop_main_remark=$request->media_station_workshop_main_remark ?? '';
        $quiz_competitions_main_event=$request->quiz_competitions_main_event ?? '0';
        $quiz_competitions_main_no_program=$request->quiz_competitions_main_no_program ?? '';
        $quiz_competitions_main_remark=$request->quiz_competitions_main_remark ?? '';
        $public_meeting_main_event =$request->public_meeting_main_event ?? '0';
        $public_meeting_main_no_program=$request->public_meeting_main_no_program ?? '';
        $public_meeting_main_remark=$request->public_meeting_main_remark ?? '';
        $multimedia_component_main_event=$request->multimedia_component_main_event ?? '0';
        $multimedia_component_main_no_program=$request->multimedia_component_main_no_program ?? '';
        $multimedia_component_main_remark=$request->multimedia_component_main_remark ?? '';
        $nukkad_natak_main_event=$request->nukkad_natak_main_event ?? '0';
        $nukkad_natak_main_no_program=$request->nukkad_natak_main_no_program ?? '';
        $nukkad_natak_main_remark=$request->nukkad_natak_main_remark ?? '';
        $property_show_main_event=$request->property_show_main_event ?? '0';
        $property_show_main_no_program=$request->property_show_main_no_program ?? '';
        $property_show_main_remark=$request->property_show_main_remark ?? '';
        $megic_show_main_event=$request->megic_show_main_event ?? '0';
        $megic_show_main_no_program=$request->megic_show_main_no_program ?? '';
        $megic_show_main_remark=$request->megic_show_main_remark ?? '';
        $folk_song_main_event=$request->folk_song_main_event ?? '0';
        $folk_song_main_no_program=$request->folk_song_main_no_program ?? '';
        $folk_song_main_remark=$request->folk_song_main_remark ?? '';
        $folk_dance_main_event=$request->folk_dance_main_event ?? '0';
        $folk_dance_main_no_program=$request->folk_dance_main_no_program ?? '';
        $folk_dance_main_remark=$request->folk_dance_main_remark ?? '';
        $folk_drama_main_event=$request->folk_drama_main_event ?? '0';
        $folk_drama_main_no_program=$request->folk_drama_main_no_program ?? '';
        $folk_drama_main_remark=$request->folk_drama_main_remark ?? '';
        $av_medium_main_event=$request->av_medium_main_event ?? '0';
        $av_medium_main_no_program=$request->av_medium_main_no_program ?? '';
        $av_medium_main_remark=$request->av_medium_main_remark ?? '';
        $snippet_air_dd_main_event=$request->snippet_air_dd_main_event ?? '0';
        $snippet_air_dd_main_no_program=$request->snippet_air_dd_main_no_program ?? '';
        $snippet_air_dd_main_remark=$request->snippet_air_dd_main_remark ?? '';
        $other_av_meterial_main_event=$request->other_av_meterial_main_event ?? '0';
        $other_av_meterial_main_no_program=$request->other_av_meterial_main_no_program ?? '';
        $other_av_meterial_main_remark=$request->other_av_meterial_main_remark ?? '';

        
        $ten_twelve_stalls_main_event=$request->ten_twelve_stalls_main_event ?? '0';
        $ten_twelve_stalls_main_no_program=$request->ten_twelve_stalls_main_no_program ?? '';
        $ten_twelve_stalls_main_remark=$request->ten_twelve_stalls_main_remark ?? '';
        $ujwala_gas_main_event=$request->ujwala_gas_main_event ?? '0';
        $ujwala_gas_main_no_program=$request->ujwala_gas_main_no_program ?? '';
        $ujwala_gas_main_remark=$request->ujwala_gas_main_remark ?? '';
        $mudra_loans_main_event=$request->mudra_loans_main_event ?? '0';
        $mudra_loans_main_no_program=$request->mudra_loans_main_no_program ?? '';
        $mudra_loans_main_remark=$request->mudra_loans_main_remark ?? '';
        $kisian_credits_card_main_event=$request->kisian_credits_card_main_event ?? '0';
        $kisian_credits_card_main_no_program=$request->kisian_credits_card_main_no_program ?? '';
        $kisian_credits_card_main_remark=$request->kisian_credits_card_main_remark ?? '';
        $opening_account_main_event=$request->opening_account_main_event ?? '0';
        $opening_account_main_no_program=$request->opening_account_main_no_program ?? '';
        $opening_account_main_remark=$request->opening_account_main_remark ?? '';
        $other_govt_scheme_main_event=$request->other_govt_scheme_main_event ?? '0';
        $other_govt_scheme_main_no_program=$request->other_govt_scheme_main_no_program ?? '';
        $other_govt_scheme_main_remark=$request->other_govt_scheme_main_remark ?? '';
        //Main Programmes end

        //Post Event start
        $success_stories=$request->success_stories ?? '0';
        $local_input_about_program=$request->local_input_about_program ?? '0';
        $fb_twitter_instagram=$request->fb_twitter_instagram ?? '0';
        $web_streaming=$request->web_streaming ?? '0';
        $live_chat_session=$request->live_chat_session ?? '0';
        $talkathons=$request->talkathons ?? '0';
        $selfie_points=$request->selfie_points ?? '0';
        $social_media_wall=$request->social_media_wall ?? '0';
        $other=$request->other ?? '0';
        $media_coverage_txt=$request->media_coverage_txt ?? '';
        //Post Event end


        $community_network_created=$request->community_network_created ?? ' ';
        $community_network_details=$request->community_network_details ?? ' ';
        $virtual_network_created=$request->virtual_network_created ?? ' ';
        $virtual_network_details=$request->virtual_network_details ?? ' ';
        $radio_station_mobilized=$request->radio_station_mobilized ?? ' ';
        $remarks=$request->remarks ?? ' ';

        //required field
        $programme_activity=$request->programme_activity;
        $category_icop=$request->category_icop;
        $sop_theme=$request->sop_theme;
        $office_type=$request->office_type;
        $region_id=$request->region_id;
        $demography=$request->demography;
        $activity_area=$request->activity_area;
        $coverage=$request->coverage;
        $village_name=$request->village_name;

        $allocated_funds=$request->allocated_funds ?? ' ';
        $officer_name=$request->officer_name ?? ' ';
        $officer_designation=$request->officer_designation ?? ' ';
        $office_location=$request->office_location ?? ' ';
        $advance_account=$request->advance_account ?? ' ';
        $sattlement_account_advance=$request->sattlement_account_advance ?? ' ';

        $duration_activity_from_date=$request->duration_activity_from_date;
        $duration_activity_to_date=$request->duration_activity_to_date;
        $no_of_days=$request->no_of_days;
        $approx_size_of_audience=$request->approx_size_of_audience;

        $blank_arr=array();
        $special_area1=$request->special_area ?? $blank_arr;
        $special_area=implode(",", $special_area1);

        //end required
        // add new field
        $mobilisation_other_check=$request->mobilisation_other_check ?? ' ';
        $mobilisation_other_program=$request->mobilisation_other_program ?? ' ';
        $mobilisation_other_remark=$request->mobilisation_other_remark ?? ' ';
        $photo_check=$request->photo_check ?? ' ';
        $photo_program=$request->photo_program ?? ' ';
        $photo_program_remark=$request->photo_program_remark ?? ' ';
        $digital_check=$request->digital_check ?? ' ';
        $digital_program=$request->digital_program ?? ' ';
        $digital_program_remark=$request->digital_program_remark ?? ' ';
        $exhibition_other_check=$request->exhibition_other_check ?? ' ';
        $exhibition_other_program=$request->exhibition_other_program ?? ' ';
        $exhibition_other_program_remark=$request->exhibition_other_program_remark ?? ' ';
        $cultural_other_check=$request->cultural_other_check ?? ' ';
        $cultural_other_program=$request->cultural_other_program ?? ' ';
        $cultural_other_remark=$request->cultural_other_remark ?? ' ';
        $stalls_other_check=$request->stalls_other_check ?? ' ';
        $stalls_other_program=$request->stalls_other_program ?? ' ';
        $stalls_other_remark=$request->stalls_other_remark ?? ' ';
        $govt_other_check=$request->govt_other_check ?? ' ';
        $govt_other_program=$request->govt_other_program ?? ' ';
        $govt_other_remark=$request->govt_other_remark ?? ' ';

        //add second form field in first table
        $document_type=$request->document_type ?? ' ';
        $event_date=$request->event_date ?? ' ';
        $venue_event=$request->venue_event ?? ' ';
        $office_name=Session::get('UserName');
        $table1='[rob_forms]';
        $get_id=$request->get_id;
        if($get_id==0)
        {
            $Pk_id = DB::select('select TOP 1 [Pk_id] from dbo.[rob_forms] order by [Pk_id] desc');
            if (empty($Pk_id)) {
                $Pk_id = 1;
            } else {
                $Pk_id = $Pk_id[0]->{"Pk_id"};
                $Pk_id++;
            }
            $user_id=Session('UserID');
            $rob_ary=array(
                "Pk_id"=> $Pk_id,
                "programme_activity"=> $programme_activity,
                "category_icop"=> $category_icop,
                "activity_checkbox1"=> $activity_checkbox1,
                "sop_theme"=> $sop_theme,
                "office_type"=> $office_type,
                "region_id"=> $region_id,
                "demography"=> $demography,
                "activity_area"=> $activity_area,
                "coverage"=> $coverage,
                "village_name"=> $village_name,
                "allocated_funds"=> $allocated_funds,
                "officer_name"=> $officer_name,
                "officer_designation"=> $officer_designation,
                "office_location"=> $office_location,
                "advance_account"=> $advance_account,
                "sattlement_account_advance"=> $sattlement_account_advance,
                "direct_settlement_bill_pao"=> $direct_settlement_bill_pao,
                "duration_activity_from_date"=> $duration_activity_from_date,
                "duration_activity_to_date"=> $duration_activity_to_date,
                "no_of_days"=> $no_of_days,
                "engagement_pre_event_activity"=> $engagement_pre_event_activity,
                "engagement_txt_pre_event"=> $engagement_txt_pre_event,
                "nukkad_natak_pre_event_activity"=> $nukkad_natak_pre_event_activity,
                "nukkad_natak_txt_pre_event"=> $nukkad_natak_txt_pre_event,
                "nukkad_natak1_pre_event_activity"=> $nukkad_natak1_pre_event_activity,
                "nukkad_natak1_txt_pre_event"=> $nukkad_natak1_txt_pre_event,
                "public_meeting_pre_event_activity"=> $public_meeting_pre_event_activity,
                "public_meeting_txt_pre_event"=> $public_meeting_txt_pre_event,
                "public_meeting1_pre_event_activity"=> $public_meeting1_pre_event_activity,
                "public_meeting1_txt_pre_event"=> $public_meeting1_txt_pre_event,
                "public_announcement_pre_event_activity"=> $public_announcement_pre_event_activity,
                "public_announcement_txt_pre_event"=> $public_announcement_txt_pre_event,
                "public_announcement1_pre_event_activity"=> $public_announcement1_pre_event_activity,
                "public_announcement1_txt_pre_event"=> $public_announcement1_txt_pre_event,
                "distribution_pamphlets_pre_event_activity"=> $distribution_pamphlets_pre_event_activity,
                "distribution_pamphlets_txt_pre_event"=> $distribution_pamphlets_txt_pre_event,
                "distribution_pamphlets1_pre_event_activity"=> $distribution_pamphlets1_pre_event_activity,
                "distribution_pamphlets1_txt_pre_event"=> $distribution_pamphlets1_txt_pre_event,
                "social_media_pre_event_activity"=> $social_media_pre_event_activity,
                "social_media_txt_pre_event"=> $social_media_txt_pre_event,
                "public_rally_pre_event_activity"=> $public_rally_pre_event_activity,
                "public_rally_txt_pre_event"=> $public_rally_txt_pre_event,
                "media_briefing_pre_event_activity"=> $media_briefing_pre_event_activity,
                "media_briefing_txt_pre_event"=> $media_briefing_txt_pre_event,
                "dd_air_curtain_pre_activity"=> $dd_air_curtain_pre_activity,
                "dd_air_curtain_txt_pre_activity"=> $dd_air_curtain_txt_pre_activity,
                "social_media_campaign_pre_event"=> $social_media_campaign_pre_event,
                "social_media_campaign_txt_pre_event"=> $social_media_campaign_txt_pre_event,
                "mobile_station_main_event_activity"=> $mobile_station_main_event_activity,
                "mobile_station_main_no_program"=> $mobile_station_main_no_program,
                "mobile_station_main_remark"=> $mobile_station_main_remark,
                "painting_poetry_rangoli_main_activity"=> $painting_poetry_rangoli_main_activity,
                "painting_poetry_rangoli_main_no_program"=> $painting_poetry_rangoli_main_no_program,
                "painting_poetry_rangoli_main_remark"=> $painting_poetry_rangoli_main_remark,
                "debate_seminar_symposium_main_event"=> $debate_seminar_symposium_main_event,
                "debate_seminar_symposium_main_no_program"=> $debate_seminar_symposium_main_no_program,
                "debate_seminar_symposium_main_remark"=> $debate_seminar_symposium_main_remark,
                "testimonials_main_event"=> $testimonials_main_event,
                "testimonials_main_no_program"=> $testimonials_main_no_program,
                "testimonials_main_remark"=> $testimonials_main_remark,
                "felicitiation_main_event"=> $felicitiation_main_event,
                "felicitiation_main_no_program"=> $felicitiation_main_no_program,
                "felicitiation_main_remark"=> $felicitiation_main_remark,
                "identifying_opinion_main_event"=> $identifying_opinion_main_event,
                "identifying_opinion_main_no_program"=> $identifying_opinion_main_no_program,
                "identifying_opinion_main_remark"=> $identifying_opinion_main_remark,
                "expert_lectures_main_event"=> $expert_lectures_main_event,
                "expert_lectures_main_no_program"=> $expert_lectures_main_no_program,
                "expert_lectures_main_remark"=> $expert_lectures_main_remark,
                "workshop_main_event"=> $workshop_main_event,
                "workshop_main_no_program"=> $workshop_main_no_program,
                "workshop_main_remark"=> $workshop_main_remark,
                "media_station_workshop_main_event"=> $media_station_workshop_main_event,
                "media_station_workshop_main_no_programm"=> $media_station_workshop_main_no_programm,
                "media_station_workshop_main_remark"=> $media_station_workshop_main_remark,
                "quiz_competitions_main_event"=> $quiz_competitions_main_event,
                "quiz_competitions_main_no_program"=> $quiz_competitions_main_no_program,
                "quiz_competitions_main_remark"=> $quiz_competitions_main_remark,
                "public_meeting_main_event"=> $public_meeting_main_event,
                "public_meeting_main_no_program"=> $public_meeting_main_no_program,
                "public_meeting_main_remark"=> $public_meeting_main_remark,
                "multimedia_component_main_event"=> $multimedia_component_main_event,
                "multimedia_component_main_no_program"=> $multimedia_component_main_no_program,
                "multimedia_component_main_remark"=> $multimedia_component_main_remark,
                "nukkad_natak_main_event"=> $nukkad_natak_main_event,
                "nukkad_natak_main_no_program"=> $nukkad_natak_main_no_program,
                "nukkad_natak_main_remark"=> $nukkad_natak_main_remark,
                "property_show_main_event"=> $property_show_main_event,
                "property_show_main_no_program"=> $property_show_main_no_program,
                "property_show_main_remark"=> $property_show_main_remark,
                "megic_show_main_event"=> $megic_show_main_event,
                "megic_show_main_no_program"=> $megic_show_main_no_program,
                "megic_show_main_remark"=> $megic_show_main_remark,
                "folk_song_main_event"=> $folk_song_main_event,
                "folk_song_main_no_program"=> $folk_song_main_no_program,
                "folk_song_main_remark"=> $folk_song_main_remark,
                "folk_dance_main_event"=> $folk_dance_main_event,
                "folk_dance_main_no_program"=> $folk_dance_main_no_program,
                "folk_dance_main_remark"=> $folk_dance_main_remark,
                "folk_drama_main_event"=> $folk_drama_main_event,
                "folk_drama_main_no_program"=> $folk_drama_main_no_program,
                "folk_drama_main_remark"=> $folk_drama_main_remark,
                "av_medium_main_event"=> $av_medium_main_event,
                "av_medium_main_no_program"=> $av_medium_main_no_program,
                "av_medium_main_remark"=> $av_medium_main_remark,
                "snippet_air_dd_main_event"=> $snippet_air_dd_main_event,
                "snippet_air_dd_main_no_program"=> $snippet_air_dd_main_no_program,
                "snippet_air_dd_main_remark"=> $snippet_air_dd_main_remark,
                "other_av_meterial_main_event"=> $other_av_meterial_main_event,
                "other_av_meterial_main_no_program"=> $other_av_meterial_main_no_program,
                "other_av_meterial_main_remark"=> $other_av_meterial_main_remark,
                "ten_twelve_stalls_main_event"=> $ten_twelve_stalls_main_event,
                "ten_twelve_stalls_main_no_program"=> $ten_twelve_stalls_main_no_program,
                "ten_twelve_stalls_main_remark"=> $ten_twelve_stalls_main_remark,
                "ujwala_gas_main_event"=> $ujwala_gas_main_event,
                "ujwala_gas_main_no_program"=> $ujwala_gas_main_no_program,
                "ujwala_gas_main_remark"=> $ujwala_gas_main_remark,
                "mudra_loans_main_event"=> $mudra_loans_main_event,
                "mudra_loans_main_no_program"=> $mudra_loans_main_no_program,
                "mudra_loans_main_remark"=> $mudra_loans_main_remark,
                "kisian_credits_card_main_event"=> $kisian_credits_card_main_event,
                "kisian_credits_card_main_no_program"=> $kisian_credits_card_main_no_program,
                "kisian_credits_card_main_remark"=> $kisian_credits_card_main_remark,
                "opening_account_main_event"=> $opening_account_main_event,
                "opening_account_main_no_program"=> $opening_account_main_no_program,
                "opening_account_main_remark"=> $opening_account_main_remark,
                "other_govt_scheme_main_event"=> $other_govt_scheme_main_event,
                "other_govt_scheme_main_no_program"=> $other_govt_scheme_main_no_program,
                "other_govt_scheme_main_remark"=> $other_govt_scheme_main_remark,
                "success_stories"=> $success_stories,
                "local_input_about_program"=> $local_input_about_program,
                "fb_twitter_instagram"=> $fb_twitter_instagram,
                "web_streaming"=> $web_streaming,
                "live_chat_session"=> $live_chat_session,
                "talkathons"=> $talkathons,
                "selfie_points"=> $selfie_points,
                "social_media_wall"=> $social_media_wall,
                "other"=> $other,
                "media_coverage_txt"=> $media_coverage_txt,
                "approx_size_of_audience"=> $approx_size_of_audience,
                "community_network_created"=> $community_network_created,
                "community_network_details"=> $community_network_details,
                "virtual_network_created"=> $virtual_network_created,
                "virtual_network_details"=> $virtual_network_details,
                "radio_station_mobilized"=> $radio_station_mobilized,
                "remarks"=> $remarks,
                "social_media_campaign1_pre_event"=> $social_media_campaign1_pre_event,
                "social_media_campaign1_txt_pre_event"=> $social_media_campaign1_txt_pre_event,
                "user_id"=> $user_id,
                "status"=> '0',
                "Special_Areas"=> $special_area,
                "mobilisation_other_check"=> $mobilisation_other_check,
                "mobilisation_other_program"=> $mobilisation_other_program,
                "mobilisation_other_remark"=> $mobilisation_other_remark,
                "photo_check"=> $photo_check,
                "photo_program"=> $photo_program,
                "photo_program_remark"=> $photo_program_remark,
                "digital_check"=> $digital_check,
                "digital_program"=> $digital_program,
                "digital_program_remark"=> $digital_program_remark,
                "exhibition_other_check"=> $exhibition_other_check,
                "exhibition_other_program"=> $exhibition_other_program,
                "exhibition_other_program_remark"=> $exhibition_other_program_remark,
                "cultural_other_check"=> $cultural_other_check,
                "cultural_other_program"=> $cultural_other_program,
                "cultural_other_remark"=> $cultural_other_remark,
                "stalls_other_check"=> $stalls_other_check,
                "stalls_other_program"=> $stalls_other_program,
                "stalls_other_remark"=> $stalls_other_remark,
                "govt_other_check"=> $govt_other_check,
                "govt_other_program"=> $govt_other_program,
                "govt_other_remark"=> $govt_other_remark,
                "document_type"=> $document_type,
                "event_date"=> $event_date,
                "venue_event"=> $venue_event,
                "office"=> $office_name,
                "vip_name"=>$request->vip_name ?? '',
                "vip_designation"=>$request->vip_designation ?? '',
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "user_type"=>Session::get('UserType'),
                "rob_name"=>$request->rob_name,
                "led_main_event"=>$request->led_main_event ?? 0,
                "led_main_no_program"=>$request->led_main_no_program ?? '',
                "led_main_remark"=>$request->led_main_remark ?? '',
                "auto_main_event"=>$request->auto_main_event ?? 0,
                "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',
                "form_type"=>1,
                "pre_photo"=>'',
                "pre_show_website"=>0,
                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? ''
            );
            $sql=DB::table('rob_forms')->insert($rob_ary);
                



        }
        else
        {
            if(empty($request->url_id))
            {
                // dd('first else');
                $user_id=Session('UserID');
                $get_insert_id=DB::table('rob_forms')->select('*')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
                $last_ID=$get_insert_id->Pk_id;
                $blank_arr=array();
                $special_area1=$request->special_area ?? $blank_arr;
                $special_area=implode(",", $special_area1);
                $update=DB::table('rob_forms')->where('Pk_id',$last_ID)->update([
                    "programme_activity"=>$request->programme_activity,
                    "category_icop"=>$request->category_icop ?? '',
                    "activity_checkbox1"=>implode(",", $request->activity_checkbox1),
                    "sop_theme"=>$request->sop_theme ?? '',
                    "office_type"=>$request->office_type ?? '',
                    "region_id"=>$request->region_id ?? '',
                    "demography"=>$request->demography ?? '',
                    "activity_area"=>$request->activity_area ?? '',
                    "coverage"=>$request->coverage ?? '',
                    "village_name"=>$request->village_name ?? '',
                    "vip_name"=>$request->vip_name ?? '',
                    "vip_designation"=>$request->vip_designation ?? '',
                    "officer_name_person"=>$request->officer_name_person ?? '',
                    "contact_no"=>$request->contact_no ?? '',
                    "allocated_funds"=>$request->allocated_funds ?? '',
                    "officer_name"=>$request->officer_name ?? '',
                    "officer_designation"=>$request->officer_designation ?? '',
                    "office_location"=>$request->office_location ?? '',
                    "advance_account"=>$request->advance_account ?? '',
                    "sattlement_account_advance"=>$request->sattlement_account_advance ?? '',
                    "direct_settlement_bill_pao"=>$request->direct_settlement_bill_pao ?? '',
                    "duration_activity_from_date"=>$request->duration_activity_from_date ?? '',
                    "duration_activity_to_date"=>$request->duration_activity_to_date ?? '',
                    "no_of_days"=>$request->no_of_days ?? '',
                    "engagement_pre_event_activity"=>$request->engagement_pre_event_activity ?? '',
                    "engagement_txt_pre_event"=>$request->engagement_txt_pre_event ?? '',
                    "nukkad_natak_pre_event_activity"=>$request->nukkad_natak_pre_event_activity ?? '',
                    "nukkad_natak_txt_pre_event"=>$request->nukkad_natak_txt_pre_event ?? '',
                    "nukkad_natak1_pre_event_activity"=>$request->nukkad_natak1_pre_event_activity ?? '',
                    "nukkad_natak1_txt_pre_event"=>$request->nukkad_natak1_txt_pre_event ?? '',
                    "public_meeting_pre_event_activity"=>$request->public_meeting_pre_event_activity ?? '',
                    "public_meeting_txt_pre_event"=>$request->public_meeting_txt_pre_event ?? '',
                    "public_meeting1_pre_event_activity"=>$request->public_meeting1_pre_event_activity ?? '',
                    "public_meeting1_txt_pre_event"=>$request->public_meeting1_txt_pre_event ?? '',
                    "public_announcement_pre_event_activity"=>$request->public_announcement_pre_event_activity ?? '',
                    "public_announcement_txt_pre_event"=>$request->public_announcement_txt_pre_event ?? '',
                    "public_announcement1_pre_event_activity"=>$request->public_announcement1_pre_event_activity ?? '',
                    "public_announcement1_txt_pre_event"=>$request->public_announcement1_txt_pre_event ?? '',
                    "distribution_pamphlets_pre_event_activity"=>$request->distribution_pamphlets_pre_event_activity ?? '',
                    "distribution_pamphlets_txt_pre_event"=>$request->distribution_pamphlets_txt_pre_event ?? '',
                    "distribution_pamphlets1_pre_event_activity"=>$request->distribution_pamphlets1_pre_event_activity ?? '',
                    "distribution_pamphlets1_txt_pre_event"=>$request->distribution_pamphlets1_txt_pre_event ?? '',
                    "social_media_pre_event_activity"=>$request->social_media_pre_event_activity ?? '',
                    "social_media_txt_pre_event"=>$request->social_media_txt_pre_event ?? '',
                    "public_rally_pre_event_activity"=>$request->public_rally_pre_event_activity ?? '',
                    "public_rally_txt_pre_event"=>$request->public_rally_txt_pre_event ?? '',
                    "media_briefing_pre_event_activity"=>$request->media_briefing_pre_event_activity ?? '',
                    "media_briefing_txt_pre_event"=>$request->media_briefing_txt_pre_event ?? '',
                    "dd_air_curtain_pre_activity"=>$request->dd_air_curtain_pre_activity ?? '',
                    "dd_air_curtain_txt_pre_activity"=>$request->dd_air_curtain_txt_pre_activity ?? '',
                    "social_media_campaign_pre_event"=>$request->social_media_campaign_pre_event ?? '',
                    "social_media_campaign_txt_pre_event"=>$request->social_media_campaign_txt_pre_event ?? '',
                    "mobile_station_main_event_activity"=>$request->mobile_station_main_event_activity ?? '',
                    "mobile_station_main_no_program"=>$request->mobile_station_main_no_program ?? '',
                    "mobile_station_main_remark"=>$request->mobile_station_main_remark ?? '',
                    "painting_poetry_rangoli_main_activity"=>$request->painting_poetry_rangoli_main_activity ?? '',
                    "painting_poetry_rangoli_main_no_program"=>$request->painting_poetry_rangoli_main_no_program ?? '',
                    "painting_poetry_rangoli_main_remark"=>$request->painting_poetry_rangoli_main_remark ?? '',
                    "debate_seminar_symposium_main_event"=>$request->debate_seminar_symposium_main_event ?? '',
                    "debate_seminar_symposium_main_no_program"=>$request->debate_seminar_symposium_main_no_program ?? '',
                    "debate_seminar_symposium_main_remark"=>$request->debate_seminar_symposium_main_remark ?? '',
                    "testimonials_main_event"=>$request->testimonials_main_event ?? '',
                    "testimonials_main_no_program"=>$request->testimonials_main_no_program ?? '',
                    "testimonials_main_remark"=>$request->testimonials_main_remark ?? '',
                    "felicitiation_main_event"=>$request->felicitiation_main_event ?? '',
                    "felicitiation_main_no_program"=>$request->felicitiation_main_no_program ?? '',
                    "felicitiation_main_remark"=>$request->felicitiation_main_remark ?? '',
                    "identifying_opinion_main_event"=>$request->identifying_opinion_main_event ?? '',
                    "identifying_opinion_main_no_program"=>$request->identifying_opinion_main_no_program ?? '',
                    "identifying_opinion_main_remark"=>$request->identifying_opinion_main_remark ?? '',
                    "expert_lectures_main_event"=>$request->expert_lectures_main_event ?? '',
                    "expert_lectures_main_no_program"=>$request->expert_lectures_main_no_program ?? '',
                    "expert_lectures_main_remark"=>$request->expert_lectures_main_remark ?? '',
                    "workshop_main_event"=>$request->workshop_main_event ?? '',
                    "workshop_main_no_program"=>$request->workshop_main_no_program ?? '',
                    "workshop_main_remark"=>$request->workshop_main_remark ?? '',
                    "media_station_workshop_main_event"=>$request->media_station_workshop_main_event ?? '',
                    "media_station_workshop_main_no_programm"=>$request->media_station_workshop_main_no_programm ?? '',
                    "media_station_workshop_main_remark"=>$request->media_station_workshop_main_remark ?? '',
                    "quiz_competitions_main_event"=>$request->quiz_competitions_main_event ?? '',
                    "quiz_competitions_main_no_program"=>$request->quiz_competitions_main_no_program ?? '',
                    "quiz_competitions_main_remark"=>$request->quiz_competitions_main_remark ?? '',
                    "public_meeting_main_event"=>$request->public_meeting_main_event ?? '',
                    "public_meeting_main_no_program"=>$request->public_meeting_main_no_program ?? '',
                    "public_meeting_main_remark"=>$request->public_meeting_main_remark ?? '',
                    "multimedia_component_main_event"=>$request->multimedia_component_main_event ?? '',
                    "multimedia_component_main_no_program"=>$request->multimedia_component_main_no_program ?? '',
                    "multimedia_component_main_remark"=>$request->multimedia_component_main_remark ?? '',
                    "nukkad_natak_main_event"=>$request->nukkad_natak_main_event ?? '',
                    "nukkad_natak_main_no_program"=>$request->nukkad_natak_main_no_program ?? '',
                    "nukkad_natak_main_remark"=>$request->nukkad_natak_main_remark ?? '',
                    "property_show_main_event"=>$request->property_show_main_event ?? '',
                    "property_show_main_no_program"=>$request->property_show_main_no_program ?? '',
                    "property_show_main_remark"=>$request->property_show_main_remark ?? '',
                    "megic_show_main_event"=>$request->megic_show_main_event ?? '',
                    "megic_show_main_no_program"=>$request->megic_show_main_no_program ?? '',
                    "megic_show_main_remark"=>$request->megic_show_main_remark ?? '',
                    "folk_song_main_event"=>$request->folk_song_main_event ?? '',
                    "folk_song_main_no_program"=>$request->folk_song_main_no_program ?? '',
                    "folk_song_main_remark"=>$request->folk_song_main_remark ?? '',
                    "folk_dance_main_event"=>$request->folk_dance_main_event ?? '',
                    "folk_dance_main_no_program"=>$request->folk_dance_main_no_program ?? '',
                    "folk_dance_main_remark"=>$request->folk_dance_main_remark ?? '',
                    "folk_drama_main_event"=>$request->folk_drama_main_event ?? '',
                    "folk_drama_main_no_program"=>$request->folk_drama_main_no_program ?? '',
                    "folk_drama_main_remark"=>$request->folk_drama_main_remark ?? '',
                    "av_medium_main_event"=>$request->av_medium_main_event ?? '',
                    "av_medium_main_no_program"=>$request->av_medium_main_no_program ?? '',
                    "av_medium_main_remark"=>$request->av_medium_main_remark ?? '',
                    "snippet_air_dd_main_event"=>$request->snippet_air_dd_main_event ?? '',
                    "snippet_air_dd_main_no_program"=>$request->snippet_air_dd_main_no_program ?? '',
                    "snippet_air_dd_main_remark"=>$request->snippet_air_dd_main_remark ?? '',
                    "other_av_meterial_main_event"=>$request->other_av_meterial_main_event ?? '',
                    "other_av_meterial_main_no_program"=>$request->other_av_meterial_main_no_program ?? '',
                    "other_av_meterial_main_remark"=>$request->other_av_meterial_main_remark ?? '',
                    "ten_twelve_stalls_main_event"=>$request->ten_twelve_stalls_main_event ?? '',
                    "ten_twelve_stalls_main_no_program"=>$request->ten_twelve_stalls_main_no_program ?? '',
                    "ten_twelve_stalls_main_remark"=>$request->ten_twelve_stalls_main_remark ?? '',
                    "ujwala_gas_main_event"=>$request->ujwala_gas_main_event ?? '',
                    "ujwala_gas_main_no_program"=>$request->ujwala_gas_main_no_program ?? '',
                    "ujwala_gas_main_remark"=>$request->ujwala_gas_main_remark ?? '',
                    "mudra_loans_main_event"=>$request->mudra_loans_main_event ?? '',
                    "mudra_loans_main_no_program"=>$request->mudra_loans_main_no_program ?? '',
                    "mudra_loans_main_remark"=>$request->mudra_loans_main_remark ?? '',
                    "kisian_credits_card_main_event"=>$request->kisian_credits_card_main_event ?? '',
                    "kisian_credits_card_main_no_program"=>$request->kisian_credits_card_main_no_program ?? '',
                    "kisian_credits_card_main_remark"=>$request->kisian_credits_card_main_remark ?? '',
                    "opening_account_main_event"=>$request->opening_account_main_event ?? '',
                    "opening_account_main_no_program"=>$request->opening_account_main_no_program ?? '',
                    "opening_account_main_remark"=>$request->opening_account_main_remark ?? '',
                    "other_govt_scheme_main_event"=>$request->other_govt_scheme_main_event ?? '',
                    "other_govt_scheme_main_no_program"=>$request->other_govt_scheme_main_no_program ?? '',
                    "other_govt_scheme_main_remark"=>$request->other_govt_scheme_main_remark ?? '',
                    "success_stories"=>$request->success_stories ?? '',
                    "local_input_about_program"=>$request->local_input_about_program ?? '',
                    "fb_twitter_instagram"=>$request->fb_twitter_instagram ?? '',
                    "web_streaming"=>$request->web_streaming ?? '',
                    "live_chat_session"=>$request->live_chat_session ?? '',
                    "talkathons"=>$request->talkathons ?? '',
                    "selfie_points"=>$request->selfie_points ?? '',
                    "social_media_wall"=>$request->social_media_wall ?? '',
                    "other"=>$request->other ?? '',
                    "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                    "approx_size_of_audience"=>$request->approx_size_of_audience ?? '',
                    "community_network_created"=>$request->community_network_created ?? '',
                    "community_network_details"=>$request->community_network_details ?? '',
                    "virtual_network_created"=>$request->virtual_network_created ?? '',
                    "virtual_network_details"=>$request->virtual_network_details ?? '',
                    "radio_station_mobilized"=>$request->radio_station_mobilized ?? '',
                    "remarks"=>$request->remarks ?? '',
                    "social_media_campaign1_pre_event"=>$request->social_media_campaign1_pre_event ?? '',
                    "social_media_campaign1_txt_pre_event"=>$request->social_media_campaign1_txt_pre_event ?? '',
                    "Special_Areas"=>$special_area,
                    "mobilisation_other_check"=>$request->mobilisation_other_check ?? '',
                    "mobilisation_other_program"=>$request->mobilisation_other_program ?? '',
                    "mobilisation_other_remark"=>$request->mobilisation_other_remark ?? '',
                    "photo_check"=>$request->photo_check ?? '',
                    "photo_program"=>$request->photo_program ?? '',
                    "photo_program_remark"=>$request->photo_program_remark ?? '',
                    "digital_check"=>$request->digital_check ?? '',
                    "digital_program"=>$request->digital_program ?? '',
                    "digital_program_remark"=>$request->digital_program_remark ?? '',
                    "exhibition_other_check"=>$request->exhibition_other_check ?? '',
                    "exhibition_other_program"=>$request->exhibition_other_program ?? '',
                    "exhibition_other_program_remark"=>$request->exhibition_other_program_remark ?? '',
                    "cultural_other_check"=>$request->cultural_other_check ?? '',
                    "cultural_other_program"=>$request->cultural_other_program ?? '',
                    "cultural_other_remark"=>$request->cultural_other_remark ?? '',
                    "stalls_other_check"=>$request->stalls_other_check ?? '',
                    "stalls_other_program"=>$request->stalls_other_program ?? '',
                    "stalls_other_remark"=>$request->stalls_other_remark ?? '',
                    "govt_other_check"=>$request->govt_other_check ?? '',
                    "govt_other_program"=>$request->govt_other_program ?? '',
                    "govt_other_remark"=>$request->govt_other_remark ?? '',
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "rob_name"=>$request->rob_name,
                    "led_main_event"=>$request->led_main_event ?? 0,
                    "led_main_no_program"=>$request->led_main_no_program ?? '',
                    "led_main_remark"=>$request->led_main_remark ?? '',
                    "auto_main_event"=>$request->auto_main_event ?? 0,
                    "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                    "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                    "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                    "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                    "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                    "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                    "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                    "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                    "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                    "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                    "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                    "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                    "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                    "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',
                    
                    'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                    'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                    "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                    "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                    "ministry_name"=>$request->ministry_name ?? ''
                ]);
                

            }
            else
            {

                $blank_arr=array();
                $special_area1=$request->special_area ?? $blank_arr;
                $special_area=implode(",", $special_area1);

                $update=DB::table('rob_forms')->where('Pk_id',$request->url_id)->update([
                    "programme_activity"=>$request->programme_activity,
                    "category_icop"=>$request->category_icop ?? '',
                    "activity_checkbox1"=>implode(",", $request->activity_checkbox1),
                    "sop_theme"=>$request->sop_theme ?? '',
                    "office_type"=>$request->office_type ?? '',
                    "region_id"=>$request->region_id ?? '',
                    "demography"=>$request->demography ?? '',
                    "activity_area"=>$request->activity_area ?? '',
                    "coverage"=>$request->coverage ?? '',
                    "village_name"=>$request->village_name ?? '',
                    "vip_name"=>$request->vip_name ?? '',
                    "vip_designation"=>$request->vip_designation ?? '',
                    "officer_name_person"=>$request->officer_name_person ?? '',
                    "contact_no"=>$request->contact_no ?? '',
                    "allocated_funds"=>$request->allocated_funds ?? '',
                    "officer_name"=>$request->officer_name ?? '',
                    "officer_designation"=>$request->officer_designation ?? '',
                    "office_location"=>$request->office_location ?? '',
                    "advance_account"=>$request->advance_account ?? '',
                    "sattlement_account_advance"=>$request->sattlement_account_advance ?? '',
                    "direct_settlement_bill_pao"=>$request->direct_settlement_bill_pao ?? '',
                    "duration_activity_from_date"=>$request->duration_activity_from_date ?? '',
                    "duration_activity_to_date"=>$request->duration_activity_to_date ?? '',
                    "no_of_days"=>$request->no_of_days ?? '',
                    "engagement_pre_event_activity"=>$request->engagement_pre_event_activity ?? '',
                    "engagement_txt_pre_event"=>$request->engagement_txt_pre_event ?? '',
                    "nukkad_natak_pre_event_activity"=>$request->nukkad_natak_pre_event_activity ?? '',
                    "nukkad_natak_txt_pre_event"=>$request->nukkad_natak_txt_pre_event ?? '',
                    "nukkad_natak1_pre_event_activity"=>$request->nukkad_natak1_pre_event_activity ?? '',
                    "nukkad_natak1_txt_pre_event"=>$request->nukkad_natak1_txt_pre_event ?? '',
                    "public_meeting_pre_event_activity"=>$request->public_meeting_pre_event_activity ?? '',
                    "public_meeting_txt_pre_event"=>$request->public_meeting_txt_pre_event ?? '',
                    "public_meeting1_pre_event_activity"=>$request->public_meeting1_pre_event_activity ?? '',
                    "public_meeting1_txt_pre_event"=>$request->public_meeting1_txt_pre_event ?? '',
                    "public_announcement_pre_event_activity"=>$request->public_announcement_pre_event_activity ?? '',
                    "public_announcement_txt_pre_event"=>$request->public_announcement_txt_pre_event ?? '',
                    "public_announcement1_pre_event_activity"=>$request->public_announcement1_pre_event_activity ?? '',
                    "public_announcement1_txt_pre_event"=>$request->public_announcement1_txt_pre_event ?? '',
                    "distribution_pamphlets_pre_event_activity"=>$request->distribution_pamphlets_pre_event_activity ?? '',
                    "distribution_pamphlets_txt_pre_event"=>$request->distribution_pamphlets_txt_pre_event ?? '',
                    "distribution_pamphlets1_pre_event_activity"=>$request->distribution_pamphlets1_pre_event_activity ?? '',
                    "distribution_pamphlets1_txt_pre_event"=>$request->distribution_pamphlets1_txt_pre_event ?? '',
                    "social_media_pre_event_activity"=>$request->social_media_pre_event_activity ?? '',
                    "social_media_txt_pre_event"=>$request->social_media_txt_pre_event ?? '',
                    "public_rally_pre_event_activity"=>$request->public_rally_pre_event_activity ?? '',
                    "public_rally_txt_pre_event"=>$request->public_rally_txt_pre_event ?? '',
                    "media_briefing_pre_event_activity"=>$request->media_briefing_pre_event_activity ?? '',
                    "media_briefing_txt_pre_event"=>$request->media_briefing_txt_pre_event ?? '',
                    "dd_air_curtain_pre_activity"=>$request->dd_air_curtain_pre_activity ?? '',
                    "dd_air_curtain_txt_pre_activity"=>$request->dd_air_curtain_txt_pre_activity ?? '',
                    "social_media_campaign_pre_event"=>$request->social_media_campaign_pre_event ?? '',
                    "social_media_campaign_txt_pre_event"=>$request->social_media_campaign_txt_pre_event ?? '',
                    "mobile_station_main_event_activity"=>$request->mobile_station_main_event_activity ?? '',
                    "mobile_station_main_no_program"=>$request->mobile_station_main_no_program ?? '',
                    "mobile_station_main_remark"=>$request->mobile_station_main_remark ?? '',
                    "painting_poetry_rangoli_main_activity"=>$request->painting_poetry_rangoli_main_activity ?? '',
                    "painting_poetry_rangoli_main_no_program"=>$request->painting_poetry_rangoli_main_no_program ?? '',
                    "painting_poetry_rangoli_main_remark"=>$request->painting_poetry_rangoli_main_remark ?? '',
                    "debate_seminar_symposium_main_event"=>$request->debate_seminar_symposium_main_event ?? '',
                    "debate_seminar_symposium_main_no_program"=>$request->debate_seminar_symposium_main_no_program ?? '',
                    "debate_seminar_symposium_main_remark"=>$request->debate_seminar_symposium_main_remark ?? '',
                    "testimonials_main_event"=>$request->testimonials_main_event ?? '',
                    "testimonials_main_no_program"=>$request->testimonials_main_no_program ?? '',
                    "testimonials_main_remark"=>$request->testimonials_main_remark ?? '',
                    "felicitiation_main_event"=>$request->felicitiation_main_event ?? '',
                    "felicitiation_main_no_program"=>$request->felicitiation_main_no_program ?? '',
                    "felicitiation_main_remark"=>$request->felicitiation_main_remark ?? '',
                    "identifying_opinion_main_event"=>$request->identifying_opinion_main_event ?? '',
                    "identifying_opinion_main_no_program"=>$request->identifying_opinion_main_no_program ?? '',
                    "identifying_opinion_main_remark"=>$request->identifying_opinion_main_remark ?? '',
                    "expert_lectures_main_event"=>$request->expert_lectures_main_event ?? '',
                    "expert_lectures_main_no_program"=>$request->expert_lectures_main_no_program ?? '',
                    "expert_lectures_main_remark"=>$request->expert_lectures_main_remark ?? '',
                    "workshop_main_event"=>$request->workshop_main_event ?? '',
                    "workshop_main_no_program"=>$request->workshop_main_no_program ?? '',
                    "workshop_main_remark"=>$request->workshop_main_remark ?? '',
                    "media_station_workshop_main_event"=>$request->media_station_workshop_main_event ?? '',
                    "media_station_workshop_main_no_programm"=>$request->media_station_workshop_main_no_programm ?? '',
                    "media_station_workshop_main_remark"=>$request->media_station_workshop_main_remark ?? '',
                    "quiz_competitions_main_event"=>$request->quiz_competitions_main_event ?? '',
                    "quiz_competitions_main_no_program"=>$request->quiz_competitions_main_no_program ?? '',
                    "quiz_competitions_main_remark"=>$request->quiz_competitions_main_remark ?? '',
                    "public_meeting_main_event"=>$request->public_meeting_main_event ?? '',
                    "public_meeting_main_no_program"=>$request->public_meeting_main_no_program ?? '',
                    "public_meeting_main_remark"=>$request->public_meeting_main_remark ?? '',
                    "multimedia_component_main_event"=>$request->multimedia_component_main_event ?? '',
                    "multimedia_component_main_no_program"=>$request->multimedia_component_main_no_program ?? '',
                    "multimedia_component_main_remark"=>$request->multimedia_component_main_remark ?? '',
                    "nukkad_natak_main_event"=>$request->nukkad_natak_main_event ?? '',
                    "nukkad_natak_main_no_program"=>$request->nukkad_natak_main_no_program ?? '',
                    "nukkad_natak_main_remark"=>$request->nukkad_natak_main_remark ?? '',
                    "property_show_main_event"=>$request->property_show_main_event ?? '',
                    "property_show_main_no_program"=>$request->property_show_main_no_program ?? '',
                    "property_show_main_remark"=>$request->property_show_main_remark ?? '',
                    "megic_show_main_event"=>$request->megic_show_main_event ?? '',
                    "megic_show_main_no_program"=>$request->megic_show_main_no_program ?? '',
                    "megic_show_main_remark"=>$request->megic_show_main_remark ?? '',
                    "folk_song_main_event"=>$request->folk_song_main_event ?? '',
                    "folk_song_main_no_program"=>$request->folk_song_main_no_program ?? '',
                    "folk_song_main_remark"=>$request->folk_song_main_remark ?? '',
                    "folk_dance_main_event"=>$request->folk_dance_main_event ?? '',
                    "folk_dance_main_no_program"=>$request->folk_dance_main_no_program ?? '',
                    "folk_dance_main_remark"=>$request->folk_dance_main_remark ?? '',
                    "folk_drama_main_event"=>$request->folk_drama_main_event ?? '',
                    "folk_drama_main_no_program"=>$request->folk_drama_main_no_program ?? '',
                    "folk_drama_main_remark"=>$request->folk_drama_main_remark ?? '',
                    "av_medium_main_event"=>$request->av_medium_main_event ?? '',
                    "av_medium_main_no_program"=>$request->av_medium_main_no_program ?? '',
                    "av_medium_main_remark"=>$request->av_medium_main_remark ?? '',
                    "snippet_air_dd_main_event"=>$request->snippet_air_dd_main_event ?? '',
                    "snippet_air_dd_main_no_program"=>$request->snippet_air_dd_main_no_program ?? '',
                    "snippet_air_dd_main_remark"=>$request->snippet_air_dd_main_remark ?? '',
                    "other_av_meterial_main_event"=>$request->other_av_meterial_main_event ?? '',
                    "other_av_meterial_main_no_program"=>$request->other_av_meterial_main_no_program ?? '',
                    "other_av_meterial_main_remark"=>$request->other_av_meterial_main_remark ?? '',
                    "ten_twelve_stalls_main_event"=>$request->ten_twelve_stalls_main_event ?? '',
                    "ten_twelve_stalls_main_no_program"=>$request->ten_twelve_stalls_main_no_program ?? '',
                    "ten_twelve_stalls_main_remark"=>$request->ten_twelve_stalls_main_remark ?? '',
                    "ujwala_gas_main_event"=>$request->ujwala_gas_main_event ?? '',
                    "ujwala_gas_main_no_program"=>$request->ujwala_gas_main_no_program ?? '',
                    "ujwala_gas_main_remark"=>$request->ujwala_gas_main_remark ?? '',
                    "mudra_loans_main_event"=>$request->mudra_loans_main_event ?? '',
                    "mudra_loans_main_no_program"=>$request->mudra_loans_main_no_program ?? '',
                    "mudra_loans_main_remark"=>$request->mudra_loans_main_remark ?? '',
                    "kisian_credits_card_main_event"=>$request->kisian_credits_card_main_event ?? '',
                    "kisian_credits_card_main_no_program"=>$request->kisian_credits_card_main_no_program ?? '',
                    "kisian_credits_card_main_remark"=>$request->kisian_credits_card_main_remark ?? '',
                    "opening_account_main_event"=>$request->opening_account_main_event ?? '',
                    "opening_account_main_no_program"=>$request->opening_account_main_no_program ?? '',
                    "opening_account_main_remark"=>$request->opening_account_main_remark ?? '',
                    "other_govt_scheme_main_event"=>$request->other_govt_scheme_main_event ?? '',
                    "other_govt_scheme_main_no_program"=>$request->other_govt_scheme_main_no_program ?? '',
                    "other_govt_scheme_main_remark"=>$request->other_govt_scheme_main_remark ?? '',
                    "success_stories"=>$request->success_stories ?? '',
                    "local_input_about_program"=>$request->local_input_about_program ?? '',
                    "fb_twitter_instagram"=>$request->fb_twitter_instagram ?? '',
                    "web_streaming"=>$request->web_streaming ?? '',
                    "live_chat_session"=>$request->live_chat_session ?? '',
                    "talkathons"=>$request->talkathons ?? '',
                    "selfie_points"=>$request->selfie_points ?? '',
                    "social_media_wall"=>$request->social_media_wall ?? '',
                    "other"=>$request->other ?? '',
                    "media_coverage_txt"=>$request->media_coverage_txt ?? '',
                    "approx_size_of_audience"=>$request->approx_size_of_audience ?? '',
                    "community_network_created"=>$request->community_network_created ?? '',
                    "community_network_details"=>$request->community_network_details ?? '',
                    "virtual_network_created"=>$request->virtual_network_created ?? '',
                    "virtual_network_details"=>$request->virtual_network_details ?? '',
                    "radio_station_mobilized"=>$request->radio_station_mobilized ?? '',
                    "remarks"=>$request->remarks ?? '',
                    "social_media_campaign1_pre_event"=>$request->social_media_campaign1_pre_event ?? '',
                    "social_media_campaign1_txt_pre_event"=>$request->social_media_campaign1_txt_pre_event ?? '',
                    "Special_Areas"=>$special_area,
                    "mobilisation_other_check"=>$request->mobilisation_other_check ?? '',
                    "mobilisation_other_program"=>$request->mobilisation_other_program ?? '',
                    "mobilisation_other_remark"=>$request->mobilisation_other_remark ?? '',
                    "photo_check"=>$request->photo_check ?? '',
                    "photo_program"=>$request->photo_program ?? '',
                    "photo_program_remark"=>$request->photo_program_remark ?? '',
                    "digital_check"=>$request->digital_check ?? '',
                    "digital_program"=>$request->digital_program ?? '',
                    "digital_program_remark"=>$request->digital_program_remark ?? '',
                    "exhibition_other_check"=>$request->exhibition_other_check ?? '',
                    "exhibition_other_program"=>$request->exhibition_other_program ?? '',
                    "exhibition_other_program_remark"=>$request->exhibition_other_program_remark ?? '',
                    "cultural_other_check"=>$request->cultural_other_check ?? '',
                    "cultural_other_program"=>$request->cultural_other_program ?? '',
                    "cultural_other_remark"=>$request->cultural_other_remark ?? '',
                    "stalls_other_check"=>$request->stalls_other_check ?? '',
                    "stalls_other_program"=>$request->stalls_other_program ?? '',
                    "stalls_other_remark"=>$request->stalls_other_remark ?? '',
                    "govt_other_check"=>$request->govt_other_check ?? '',
                    "govt_other_program"=>$request->govt_other_program ?? '',
                    "govt_other_remark"=>$request->govt_other_remark ?? '',
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "rob_name"=>$request->rob_name,
                    "led_main_event"=>$request->led_main_event ?? 0,
                    "led_main_no_program"=>$request->led_main_no_program ?? '',
                    "led_main_remark"=>$request->led_main_remark ?? '',
                    "auto_main_event"=>$request->auto_main_event ?? 0,
                    "auto_dd_main_no_program"=>$request->auto_dd_main_no_program ?? '',
                    "auto_dd_main_remark"=>$request->auto_dd_main_remark ?? '',
                    "mini_auto_main_event"=>$request->mini_auto_main_event ?? 0,
                    "mini_auto_dd_main_no_program"=>$request->mini_auto_dd_main_no_program ?? '',
                    "mini_auto_dd_main_remark"=>$request->mini_auto_dd_main_remark ?? '',
                    "video_auto_main_event"=>$request->video_auto_main_event ?? 0,
                    "video_auto_dd_main_no_program"=>$request->video_auto_dd_main_no_program ?? '',
                    "video_auto_dd_main_remark"=>$request->video_auto_dd_main_remark ?? '',
                    "other_auto_main_event"=>$request->other_auto_main_event ?? 0,
                    "other_auto_dd_main_no_program"=>$request->other_auto_dd_main_no_program ?? '',
                    "other_auto_dd_main_remark"=>$request->other_auto_dd_main_remark ?? '',
                    "exhibition_other_check_standee"=>$request->exhibition_other_check_standee ?? 0,
                    "exhibition_other_program_standee"=>$request->exhibition_other_program_standee ?? '',
                    "exhibition_other_program_remark_standee"=>$request->exhibition_other_program_remark_standee ?? '',

                    'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                    'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                    "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                    "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                    "ministry_name"=>$request->ministry_name ?? ''
            ]);
            }
            

        } //main else close

    }

    public function robSubmit(Request $request)
    {
        return DB::transaction(function () use ($request) {
        // $request->validate([
            // "document_type" => 'required',
            // "event_date" => 'required',
            // "venue_event" => 'required',
            // "detail_report"=>'required',
            // "document_name"=>'required',
            // "caption_name"=>'required', 

            // "video"=>'required',
            // "video2"=>'required',
            // "video3"=>'required',
            // "video_caption"=>'required',
            // "video2_caption"=>'required',
            // "video3_caption"=>'required',

            // "press_document_name"=>'required',
            // "press_caption_name"=>'required'
        // ]);
        $document_type=$request->document_type ?? '';
        // $caption_name=$request->caption_name ?? '';
        // $show_website=$request->show_website ?? '';
        $event_date=$request->event_date ?? '';
        $venue_event=$request->venue_event ?? '';
        $user_id=Session('UserID');
        $get_insert_id=DB::table('rob_forms')->select('*')->where('user_id',$user_id)->orderBy('Pk_id','desc')->first();
        $last_ID=$get_insert_id->Pk_id;

        if($request->rob_form_id!='')
        {
            $rob_form_id=$request->rob_form_id;
            $created_date = date('m/d/Y');
            $table='[rob_documents]';
            
            $existData=DB::table('rob_forms')->select('*')->where('Pk_id',$rob_form_id)->first();
            //update last tab in rob_form table 

            if ($request->hasFile('detail_report')) 
            {  
                $file = $request->file('detail_report');
                $filename2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $filename2);
            }
            else
            {
                $filename2='';
            }

            if ($request->hasFile('video')) 
            {  
                $file = $request->file('video');
                $video = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video);
            }
            else
            {
                $video=$existData->video;
            }

            if ($request->hasFile('video2')) 
            {  
                $file = $request->file('video2');
                $video2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video2);
            }
            else
            {
                // $video2='';
                $video2=$existData->video2;
            }

            if ($request->hasFile('video3')) 
            {  
                $file = $request->file('video3');
                $video3 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video3);
            }
            else
            {
                $video3=$existData->video3;
            }

            DB::table('rob_forms')
                ->where('Pk_id',$rob_form_id)
                ->update([
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "detail_report"=>$filename2,
                    "video"=>$video,
                    "video_caption"=>$request->video_caption ?? $existData->video_caption,
                    "video2"=>$video2,
                    "video2_caption"=>$request->video2_caption ?? $existData->video2_caption,
                    "video3"=>$video3,
                    "video3_caption"=>$request->video3_caption ?? $existData->video3_caption,
                    "status"=>1
                ]);



             DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>0])->delete(); //add 1 apr   
            if(!empty($request->caption_name[0]))
            {
                foreach($request->document_name as $key => $document_name )
                {
                    $caption_name=$request->caption_name[$key];
                    $show_website=$request->show_website[$key] ?? '0';

                    // $document_modify=$request->document_name_modify[$key] ?? ''; //when you not choose file
                    // $caption_modify=$request->caption_name_modify[$key] ?? ''; //when you not choose file

                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('document_name')) 
                    {  
                        $file = $request->file('document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$document_modify;
                    }


                        $doc_array=array(
                            "pk_document_id" => $pk_document_id,
                            "rob_form_id" => $rob_form_id,
                            "event_date" => $event_date,
                            "document_name" => $filename,
                            "caption_name" => $caption_name ?? $caption_modify,
                            "show_website" => $show_website,
                            "created_date" => $created_date,
                            "image_type" => 0 
                        ); 
                        $sql=DB::table('rob_documents')->insert($doc_array);
                } //end foreach
            }
            else
            {
                foreach($request->document_name_modify as $key => $document_name )
                {
                    $document_modify=$request->document_name_modify[$key] ?? '';
                    $caption_name=$request->caption_name_modify[$key] ?? '';
                    $show_website=$request->show_website_modify[$key] ?? '0';

                    // $document_modify=$request->document_name_modify[$key] ?? ''; //when you not choose file
                    // $caption_modify=$request->caption_name_modify[$key] ?? ''; //when you not choose file

                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    // if ($request->hasFile('document_name')) 
                    // {  
                    //     $file = $request->file('document_name')[$key];
                    //     $filename = time() . '-' . $file->getClientOriginalName();
                    //     $file->move('rob/', $filename);
                    // }
                    // else
                    // {
                    //     $filename=$document_name;
                    // }

                    
                        $doc_array=array(
                            "pk_document_id" => $pk_document_id,
                            "rob_form_id" => $rob_form_id,
                            "event_date" => $event_date,
                            "document_name" => $document_modify,
                            "caption_name" => $caption_name ?? $caption_modify,
                            "show_website" => $show_website,
                            "created_date" => $created_date,
                            "image_type" => 0 
                        ); 
                        $sql=DB::table('rob_documents')->insert($doc_array);
                } //end foreach
            }




            


            //for press 
            DB::table("rob_documents")->where(['rob_form_id'=>$rob_form_id,"image_type"=>1])->delete(); //add 1 apr 
            if(!empty($request->press_caption_name[0]))
            {
                foreach($request->press_document_name as $key => $press_document_name)
                {
                    $press_caption_name=$request->press_caption_name[$key] ?? '';
                    $press_show_website=$request->press_show_website[$key] ?? '0';

                    $press_document_name_modify=$request->press_document_name_modify[$key] ?? ''; //when you not choose file
                    $press_caption_name_modify=$request->press_caption_name_modify[$key] ?? ''; 

                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('press_document_name')) 
                    {  
                        $file = $request->file('press_document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }
                    else
                    {
                        $filename=$press_document_name_modify;
                    }

                        $press_array=array(
                            "pk_document_id"=> $pk_document_id,
                            "rob_form_id"=> $rob_form_id,
                            "event_date"=> $event_date,
                            "document_name"=> $filename,
                            "caption_name"=> $press_caption_name ?? $press_caption_name_modify,
                            "show_website"=> $press_show_website,
                            "created_date"=> $created_date,
                            "image_type"=> '1'  
                        );
                    $sql=DB::table('rob_documents')->insert($press_array);
                } //end foreach
            }
            else
            {
                foreach($request->press_document_name_modify as $key => $press_document_name)
                {
                    $document_modify=$request->press_document_name_modify[$key] ?? '';
                    $caption_name=$request->press_caption_name_modify[$key] ?? '';
                    $show_website=$request->press_show_website_modify[$key] ?? '0';

                   $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                        $press_array=array(
                            "pk_document_id"=> $pk_document_id,
                            "rob_form_id"=> $rob_form_id,
                            "event_date"=> $event_date,
                            "document_name"=> $document_modify,
                            "caption_name"=> $caption_name,
                            "show_website"=> $show_website,
                            "created_date"=> $created_date,
                            "image_type"=> '1'  
                        );
                    $sql=DB::table('rob_documents')->insert($press_array);
                } //end foreach
            }
            //press close


        }
        else
        {
            // dd('sec');
            // $rob_form_id=$request->rob_form_id;
            $created_date = date('m/d/Y');
            $table='[rob_documents]';
            
            //update last tab in rob_form table 
            if ($request->hasFile('detail_report')) 
            {  
                $file = $request->file('detail_report');
                $filename2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $filename2);
            }
            else
            {
                $filename2='';
            }

            if ($request->hasFile('video')) 
            {  
                $file = $request->file('video');
                $video = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video);
            }
            else
            {
                $video='';
            }

            if ($request->hasFile('video2')) 
            {  
                $file = $request->file('video2');
                $video2 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video2);
            }
            else
            {
                $video2='';
            }

            if ($request->hasFile('video3')) 
            {  
                $file = $request->file('video3');
                $video3 = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $video3);
            }
            else
            {
                $video3='';
            }

            DB::table('rob_forms')
                ->where('Pk_id',$last_ID)
                ->update([
                    "document_type"=>$request->document_type ?? '',
                    "event_date"=>$request->event_date ?? '',
                    "venue_event"=>$request->venue_event ?? '',
                    "detail_report"=>$filename2,
                    "video"=>$video,
                    "video_caption"=>$request->video_caption ?? '',
                    "video2"=>$video2,
                    "video2_caption"=>$request->video2_caption ?? '',
                    "video3"=>$video3,
                    "video3_caption"=>$request->video3_caption ?? '',
                    "status"=>1
                ]);
            DB::table("rob_documents")->where(['rob_form_id'=>$last_ID,"image_type"=>0])->delete(); //add 1 apr 
            if(count($request->document_name) > 0)
            {
                foreach($request->document_name as $key => $document_name)
                {
                    $show_website=$request->show_website[$key] ?? '0'; //add
                    $caption_name=$request->caption_name[$key] ?? ''; //add 30 march
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        // $pk_document_id = 'PKOW1';
                        $pk_document_id=1;
                    } else 
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('document_name')) 
                    {  
                        $file = $request->file('document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }


                            $doc_array2=array(
                                "pk_document_id" => $pk_document_id,
                                "rob_form_id" => $last_ID,
                                "event_date" => $event_date,
                                "document_name" => $filename,
                                "caption_name" => $caption_name,
                                "show_website" => $show_website,
                                "created_date" => $created_date,
                                "image_type" => 0 
                            );

                            $sql=DB::table('rob_documents')->insert($doc_array2);

                } //end foreach
            }//close if count



            //press
            DB::table("rob_documents")->where(['rob_form_id'=>$last_ID,"image_type"=>1])->delete(); //add 1 apr
            if(count($request->press_document_name) > 0)
            {
                foreach($request->press_document_name as $key => $press_document_name)
                {
                    $press_show_website=$request->press_show_website[$key] ?? '0';
                    $press_caption_name=$request->press_caption_name[$key] ?? '';
                    $pk_document_id = DB::select('select TOP 1 [pk_document_id] from dbo.[rob_documents] order by [pk_document_id] desc');
                    if (empty($pk_document_id)) 
                    {
                        $pk_document_id=1;
                    } 
                    else
                    {
                        $pk_document_id = $pk_document_id[0]->{"pk_document_id"};
                        $pk_document_id++;
                    }

                    //$Pk_id = $request->rob_form_id;  // GET first form last id and store in rob_form_id column

                    if ($request->hasFile('press_document_name')) 
                    {  
                        $file = $request->file('press_document_name')[$key];
                        $filename = time() . '-' . $file->getClientOriginalName();
                        $file->move('rob/', $filename);
                    }

                        $pres_ary=array(
                            "pk_document_id"=>$pk_document_id,
                            "rob_form_id"=>$last_ID,
                            "event_date"=>$event_date,
                            "document_name"=>$filename,
                            "caption_name"=>$press_caption_name,
                            "show_website"=>$press_show_website,
                            "created_date"=>$created_date,
                            "image_type"=>'1'
                        );
                        $sql=DB::table('rob_documents')->insert($pres_ary);

                } //end foreach
            }//close if count
        } //end else
        }); //tansaction close
    } //robSubmit function close




    public function rob_fob_list()
    {
        $current_url = last(request()->segments());
        if($current_url == "rob-fob-list")
        {
            if(Session::get('UserID'))
            {
                $user_id=Session('UserID');
                $userName=Session('UserName');

                // $robdetail=DB::table('rob_details')->select("*")->where("RobName",$userName)->first();
                // $findFobData=DB::table('fob_details')->select('*')->where('RobId',$robdetail->RobId)->get();
                // $findFobData=DB::table('fob_details')->where('RobId',$robdetail->RobId)->pluck('FobName')->toArray();
                // $dataImport=implode(",",$findFobData);

                $fetch=DB::table('rob_forms')
                        // ->whereIn("office",[$findFobData])
                        ->where('rob_name',$userName)
                        ->where('user_type','3')
                        ->where('document_type','<>','')
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.foblist',["data"=>$fetch]);
           }
           // return redirect('/rob-login');
        }
    }


    public function get_status()
    {
        $data=DB::table('rob_forms')->where('user_id',Session::get('UserID'))->orderBy('Pk_id','desc')->first();
        return $data->status;
    }


    public function fob_list()
    {
        $current_url = last(request()->segments());
        if($current_url == "fob-list")
        {
            if(Session::get('UserID'))
            {
                $user_id=Session('UserID');
                $userName=Session('UserName');

                // $robdetail=DB::table('rob_details')->select("*")->where("RobName",$userName)->first();
                // $findFobData=DB::table('fob_details')->select('*')->where('RobId',$robdetail->RobId)->get();
                // $findFobData=DB::table('fob_details')->where('RobId',$robdetail->RobId)->pluck('FobName')->toArray();
                // $dataImport=implode(",",$findFobData);

                $fetch=DB::table('rob_forms')
                        // ->whereIn("office",[$findFobData])
                        ->where('office',$userName)
                        ->where('user_type','3')
                        ->where('document_type','<>','')
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.foblist',["data"=>$fetch]);
           }
           // return redirect('/rob-login');
        }
    }




    public function pre_insert(Request $request)
    {
            $Pk_id = DB::select('select TOP 1 [Pk_id] from dbo.[rob_forms] order by [Pk_id] desc');
            if (empty($Pk_id)) {
                $Pk_id = 1;
            } else {
                $Pk_id = $Pk_id[0]->{"Pk_id"};
                $Pk_id++;
            }
            $user_id=Session('UserID');

            $getusertype=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User Type as user_type','User Name as user_name')->where('User ID',$user_id)->first();
            $user_type=$getusertype->user_type;
            $user_name=$getusertype->user_name;
            
            
            if($user_type==2)
            {
                $getadg=DB::table('rob_adg_master')->select('*')->where('rob_name',$user_name)->first();
                $adg_name=$getadg->adg_name;
            }
            else
            {
                $adg_name='';
            }
            $office_name=Session::get('UserName');

            if ($request->hasFile('pre_photo')) 
            {  
                $file = $request->file('pre_photo');
                $pre_photo = time() . '-' . $file->getClientOriginalName();
                $file->move('rob/', $pre_photo);
            }
            else
            {
                $pre_photo='';
            }

            $rob_ary=array(
                "Pk_id"=> $Pk_id,
                "programme_activity"=> $request->programme_activity ?? '', 
                "category_icop"=> $request->category_icop ?? '', 
                "activity_checkbox1"=> implode(",", $request->activity_checkbox1), 
                "sop_theme"=> $request->sop_theme ?? '',
                "office_type"=> $request->office_type ?? '', 
                "region_id"=> $request->region_id ?? '',
                "demography"=> $request->demography ?? '',
                "activity_area"=> $request->activity_area ?? '',
                "coverage"=> $request->coverage ?? '',
                "village_name"=> $request->village_name ?? '', 
                "duration_activity_from_date"=> $request->duration_activity_from_date, 
                "duration_activity_to_date"=> $request->duration_activity_to_date, 
                "no_of_days"=> $request->no_of_days ?? 0, 
                "engagement_pre_event_activity"=> $request->engagement_pre_event_activity ?? 0, 
                "engagement_txt_pre_event"=> $request->engagement_txt_pre_event ?? '', 
                "nukkad_natak_pre_event_activity"=> $request->nukkad_natak_pre_event_activity ?? '0', 
                "nukkad_natak_txt_pre_event"=> $request->nukkad_natak_txt_pre_event ?? '', 
                "nukkad_natak1_pre_event_activity"=> $request->nukkad_natak1_pre_event_activity ?? '0', 
                "nukkad_natak1_txt_pre_event"=> $request->nukkad_natak1_txt_pre_event ?? '', 
                "public_meeting_pre_event_activity"=> $request->public_meeting_pre_event_activity ?? '0', 
                "public_meeting_txt_pre_event"=> $request->public_meeting_txt_pre_event ?? '', 
                "public_meeting1_pre_event_activity"=> $request->public_meeting1_pre_event_activity ?? '0', 
                "public_meeting1_txt_pre_event"=> $request->public_meeting1_txt_pre_event ?? '', 
                "public_announcement_pre_event_activity"=> $request->public_announcement_pre_event_activity ?? '0', 
                "public_announcement_txt_pre_event"=> $request->public_announcement_txt_pre_event ?? '', 
                "public_announcement1_pre_event_activity"=> $request->public_announcement1_pre_event_activity ?? '0', 
                "public_announcement1_txt_pre_event"=> $request->public_announcement1_txt_pre_event ?? '', 
                "distribution_pamphlets_pre_event_activity"=> $request->distribution_pamphlets_pre_event_activity ?? '0', 
                "distribution_pamphlets_txt_pre_event"=> $request->distribution_pamphlets_txt_pre_event ?? '',  
                "distribution_pamphlets1_pre_event_activity"=> $request->distribution_pamphlets1_pre_event_activity ?? '0', 
                "distribution_pamphlets1_txt_pre_event"=> $request->distribution_pamphlets1_txt_pre_event ?? '', 
                "social_media_pre_event_activity"=> $request->social_media_pre_event_activity ?? '0',  
                "social_media_txt_pre_event"=> $request->social_media_txt_pre_event ?? '', 
                "public_rally_pre_event_activity"=> $request->public_rally_pre_event_activity ?? '0', 
                "public_rally_txt_pre_event"=> $request->public_rally_txt_pre_event ?? '', 
                "media_briefing_pre_event_activity"=> $request->media_briefing_pre_event_activity ?? '0', 
                "media_briefing_txt_pre_event"=> $request->media_briefing_txt_pre_event ?? '', 
                "dd_air_curtain_pre_activity"=> $request->dd_air_curtain_pre_activity ?? '0', 
                "dd_air_curtain_txt_pre_activity"=> $request->dd_air_curtain_txt_pre_activity ?? '0', 
                "social_media_campaign_pre_event"=> $request->social_media_campaign_pre_event ?? '', 
                "social_media_campaign_txt_pre_event"=> $request->social_media_campaign_txt_pre_event ?? '', 
                "debate_seminar_symposium_main_remark"=> $request->debate_seminar_symposium_main_remark ?? '',
                "testimonials_main_no_program"=> $request->testimonials_main_no_program ?? '',
                "testimonials_main_remark"=> $request->testimonials_main_remark ?? '',
                "felicitiation_main_event"=> $request->felicitiation_main_event ?? '0',
                "felicitiation_main_no_program"=> $request->felicitiation_main_no_program ?? '',
                "felicitiation_main_remark"=> $request->felicitiation_main_remark ?? '',
                "social_media_campaign1_pre_event"=> $request->social_media_campaign1_pre_event ?? '0', 
                "social_media_campaign1_txt_pre_event"=> $request->social_media_campaign1_txt_pre_event ?? '', 
                "user_id"=> $user_id,
                "status"=> '1',
                "office"=>$office_name,
                "vip_name"=>$request->vip_name ?? '', 
                "vip_designation"=>$request->vip_designation ?? '', 
                "officer_name_person"=>$request->officer_name_person ?? '',
                "contact_no"=>$request->contact_no ?? '',
                "user_type"=>Session::get('UserType'),
                "rob_name"=>$request->rob_name,
                "form_type"=>0,
                "pre_photo"=>$pre_photo,
                "pre_show_website"=>$request->pre_show_website ?? '0',

                'other_media_campaign_pre_event'=>$request->other_media_campaign_pre_event ?? 0,
                'other_media_campaign_txt_pre_event'=>$request->other_media_campaign_txt_pre_event ?? '',
                "other_media_pre_event_activity"=>$request->other_media_pre_event_activity ?? 0,
                "other_media_txt_pre_event"=>$request->other_media_txt_pre_event ?? '',
                "ministry_name"=>$request->ministry_name ?? '',
                "adg_name"=>$adg_name
                
            );
            $sql=DB::table('rob_forms')->insert($rob_ary);
    }


    //for pre rob list
    public function preroblist()  //list data show
    {
        $current_url = last(request()->segments());
        if($current_url == "preroblist")
        {
            if(Session::get('UserID')){
                $user_id=Session('UserID');
                $office_name=Session::get('UserName');
                // $fetch = DB::select("select * from dbo.[rob_forms] where [user_id]='".$user_id."' order by [Pk_id] desc");
                $fetch=DB::table('rob_forms')
                        // ->leftJoin('rob_documents','rob_forms.Pk_id','=','rob_documents.rob_form_id')
                        ->where('user_id',$user_id)
                        ->where('status',1)
                        ->where('form_type',0)
                        ->where('office',$office_name)
                        ->orderBy('Pk_id','desc')
                        ->get();
                return view('rob.preroblist',["data"=>$fetch]);
           }
           return redirect('/rob-login');
        }   
    }

    


    //when you click view button of pre form
    public function pre_active_form($id='')
    {
        if(Session::get('UserID'))
        {
            if(!empty($id))
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;
                    
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }

                //31 march end

                // $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first(); 31 march
                // $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();

                $data=DB::table('rob_forms')->where('Pk_id',$id)->first();
                
                // return $list;
                // return view('rob.dataform',["data"=>$data,"special_data"=>$list]);
                return view('rob.pre-activity-form',compact('data','offTyp','offRegion','ministry_data'));
            }
            else
            {
                $userName=Session::get('UserName');
                $usertype=Session::get('UserType');

                //31 march
                $usertype=Session::get('UserType');
                $ministry_data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
                if($usertype=='2')
                {
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$userName)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$userName)->get();
                }
                else
                {
                    $findFobData=DB::table('fob_details')->select('*')->where('FobName',$userName)->first();
                    $robid=$findFobData->RobId;
                    $robdetail=DB::table('rob_details')->select("*")->where("RobId",$findFobData->RobId)->first();
                    $robname=$robdetail->RobName;
                    
                    $offTyp=DB::table('rob_fob_details')->where('user_name',$robname)->first();
                    $offRegion=DB::table('rob_fob_details')->where('user_name',$robname)->get();
                    Session::put('rob_name',$robname);
                }
                return view('rob.pre-activity-form',compact('offTyp','offRegion','ministry_data'));
            }
        }
    }


    //get Ministries Name
    public function getministries()
    {
        $data=DB::table('BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2')->select('Ministry Name as ministry_name')->get();
        $html="<option>Select Ministry Name</option>";
        foreach($data as $ministries)
        {
            $html.= "<option>".$ministries->ministry_name."</option>";
        }
        echo $html;
    }



    //for ADG List  rob-adg-list
    public function rob_adg_list()
    {
        $user_id=Session('UserID');
        $getusertype=DB::table('BOC$UMM User$3f88596c-e20d-438c-a694-309eb14559b2')->select('User Type as user_type','User Name as user_name')->where('User ID',$user_id)->first();
        $user_type=$getusertype->user_type;
        $user_name=$getusertype->user_name;
        $data=DB::table('rob_forms')->select('*')->where('adg_name',$user_name)->get();
        return view('rob.rob_adg_list',compact('data'));
    }


    public function approve_rejected($status,$id)
    {

        $update_status =DB::table('rob_forms')
                        ->where('Pk_id',$id)
                        ->update([
                            "approve"=>$status
                        ]);

        if($update_status)
        {
            if($status == 1)
            {
             return redirect()->back()->with("success","Status have been approved.");
            }
            else
            {
                 return redirect()->back()->with("success","Status have been rejected.");
            }
        }
        else
        {
             return redirect()->back()->with("error","Please try again!");
        }

    }

    
}
