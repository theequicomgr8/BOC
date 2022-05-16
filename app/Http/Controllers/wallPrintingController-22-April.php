<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\CommonTrait;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use PDF;

class wallPrintingController extends Controller
{
    use CommonTrait;

    public function companyDetails(Request $request) {
        if($request->isMethod('post')) {
                $data =DB::table('wall_painting')->select('id')->orderBy('id','desc')->first();
            if(!empty($data)) {
                $data =$data->id;
                $data++;
            }else{
                $data ="1000";
            }
            //dd($data);
            //$ownership_document_rent_agreement = '';
            $destinationPath = public_path() .'/uploads/CompanyDetails';
             if($request->hasFile('ownership_document_rent_agreement')) {
                    $file3= $request->file('ownership_document_rent_agreement');
                    $ownership_document_rent_agreement =time().'-'.$file3->getClientOriginalName();
                    $fileUploaded_Undertaking_file=$file3->move($destinationPath, $ownership_document_rent_agreement);
                    if($fileUploaded_Undertaking_file){
                        $ownership_document_rent_agreement=$ownership_document_rent_agreement;
                    }
              } else {
                $ownership_document_rent_agreement ="";
              }
            $insert =DB::table('wall_painting')->insert(
                [
                "id" =>$data,
                "name_of_agency" =>$request->name_of_agency,
                "bid_security_declaration" =>$request->bid_security_declaration,
                "head_office_telphone_email" =>$request->head_office_telphone_email,
                "branch_telephone" =>$request->branch_telephone,
                "certificate_incorporation" =>$request->certificate_incorporation,
                "gst_certificate"=>$request->gst_certificate,
                "Pan_tan_card"=>$request->Pan_tan_card,
                "registration_startup"=>$request->registration_startup,
                "other_document" =>$request->other_document,
                "area_work_name_state_city" =>$request->area_work_name_state_city,
                "details_of_past_work_wall_painting" =>$request->details_of_past_work_wall_painting,
                "total_years_exp_wall_painting" =>$request->total_years_exp_wall_painting,
                "total_years_exp_digital_painting" =>$request->total_years_exp_digital_painting,
                "annual_turn_2019_20_wp"=>$request->annual_turn_2019_20_wp,
                "annual_turn_2019_20_dwp"=>$request->annual_turn_2019_20_dwp,
                "annual_turn_2020_21_wp"=>$request->annual_turn_2020_21_wp,
                "annual_turn_2020_21_dwp"=>$request->annual_turn_2020_21_dwp,
                "annual_turn_2021_22_wp"=>$request->annual_turn_2021_22_wp,
                "annual_turn_2021_22_dwp"=>$request->annual_turn_2021_22_dwp,
                "work_past_three_2018_19_area_of_painting"=>$request->work_past_three_2018_19_area_of_painting,
                "work_past_three_2018_19_amt_rs" =>$request->work_past_three_2018_19_amt_rs,
                "work_past_three_2018_19_wp_dwp"=>$request->work_past_three_2018_19_wp_dwp,
                "work_past_three_2018_19_area_claimed"=>$request->work_past_three_2018_19_area_claimed,
                "work_past_three_2018_19_area_gst"=>$request->work_past_three_2018_19_area_gst,
                "work_past_three_2019_20_area_of_painting"=>$request->work_past_three_2019_20_area_of_painting,
                "work_past_three_2019_20_amt_rs"=>$request->work_past_three_2019_20_amt_rs,
                "work_past_three_2019_20_wp_dwp"=>$request->work_past_three_2019_20_wp_dwp,
                "work_past_three_2019_20_area_claimed"=>$request->work_past_three_2019_20_area_claimed,
                "work_past_three_2019_20_area_gst"=>$request->work_past_three_2019_20_area_gst,
                "work_past_three_2020_21_area_of_painting"=>$request->work_past_three_2020_21_area_of_painting,
                "work_past_three_2020_21_amt_rs"=>$request->work_past_three_2020_21_amt_rs,
                "work_past_three_2020_21_wp_dwp"=>$request->work_past_three_2020_21_wp_dwp,
                "work_past_three_2020_21_area_claimed"=>$request->work_past_three_2020_21_area_claimed,
                "work_past_three_2020_21_area_gst"=>$request->work_past_three_2020_21_area_gst,
                "work_past_three_2021_22_area_of_painting"=>$request->work_past_three_2021_22_area_of_painting,
                "work_past_three_2021_22_amt_rs"=>$request->work_past_three_2021_22_amt_rs,
                "work_past_three_2021_22_wp_dwp"=>$request->work_past_three_2021_22_wp_dwp,
                "work_past_three_2021_22_area_claimed"=>$request->work_past_three_2021_22_area_claimed,
                "work_past_three_2021_22_area_gst"=>$request->work_past_three_2021_22_area_gst,
                "owner_printing_machine" =>$request->owner_printing_machine,
                "agreement_with_vendor" =>$request->agreement_with_vendor,
                "ownership_document_rent_agreement" =>$ownership_document_rent_agreement,
                "details_of_past_work_digital_painting"=>$request->details_of_past_work_digital_painting,
                "startup_certificate_wp"=>$request->startup_certificate_wp,
                "startup_certificate_dwp"=>$request->startup_certificate_dwp
                ]);

            $wall_print_data ="";
            if($insert == true) {
                $insert_id=DB::table('wall_painting')->select('id')->orderBy('id','desc')->first();
                $id=$insert_id->id;
                return redirect('wallPainting-view/'.$id)->with('msg','Information seved successfully!');
            }
        }
            return view('admin.pages.wall-painting.wall_printing');
        }

    public function wallPrintinglist($id='')
    {
        $vendor=DB::table('wall_painting')
                    ->select('id','name_of_agency','bid_security_declaration','head_office_telphone_email','branch_telephone')
                    ->orderBy('id','DESC')
                    ->get();
        return view('admin.pages.wall-painting.wallPrintingList',["vendor"=>$vendor]);
    }

    public function wallPrinting_view($id = null)
    {
        $wall_print_data = DB::table('wall_painting')->select('*')->where('id',$id )->orderBy('id','DESC')->first();
        return view('admin.pages.wall-painting.wall_printing_view',["wall_print_data"=>$wall_print_data]);
    }

    public function downloadPdf($id = null)
    {
        $wall_print_data = DB::table('wall_painting')->select('*')->where('id',$id )->orderBy('id','DESC')->first();
        $pdf = PDF::loadView('admin.pages.wall-painting.wall_printing_view',["wall_print_data"=>$wall_print_data] );
        return  $pdf->download('application-form.pdf');
    }

}
