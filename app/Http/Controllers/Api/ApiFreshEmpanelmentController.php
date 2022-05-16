<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\ApiFreshEmpanelment;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Http\Traits\CommonTrait;
use App\Models\User;
//use Validator;
use Session;
use Carbon\Carbon;
Use File;
class ApiFreshEmpanelmentController extends Controller
{
    use CommonTrait; 
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function freshEmpanelmentSaveOwnerData(Request $request)
    {
        $table1 = '[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2]';
        $msg = '';
        $unique_id = array();
        if ($request->exist_owner_id != "") {
            $owner_id = DB::select("select [Owner ID] from $table1 where [Email ID] = '" . $request->email . "' and [Mobile No_] = '" . $request->mobile . "' and [Owner ID] = '" . $request->exist_owner_id . "'");
            $owner_id = $owner_id[0]->{"Owner ID"};
            $sql = $owner_id != '' ? true : false;
            $msg = 'Successfully!';
        }else{
            $request->phone = $request->phone ?? '';
            $request->fax_no = $request->fax_no ?? '';
            $request->owner_name = $request->owner_name ?? '';
            $request->owner_type = $request->owner_type ?? '';
            if ($request->ownerid == '') {
                // owner id formate               
                $owner_id = DB::select('select TOP 1 [Owner ID] from dbo.[BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2] order by [Owner ID] desc');
                if (empty($owner_id)) {
                    $owner_id = 'EMPOW1';
                } else {
                    $owner_id = $owner_id[0]->{"Owner ID"};
                    $owner_id++;
                }
                $sql =  DB::insert(
                    "insert into $table1 (
                [timestamp],
                [Owner ID],
                [Owner Name],
                [Mobile No_],
                [Email ID],
                [Phone No_],
                [Fax No_],
                [Address 1],
                [Address 2],
                [City],
                [District],
                [State],
                [HO Same Address as DO],
				[DO Address],
				[DO Landline No_(with STD)],
				[DO Fax No_],
				[DO E-Mail],
				[DO Mobile No_],
				[DO PIN Code],
				[DO City],
				[DO State],
				[DO District],
				[PIN Code],
                [User ID]
                ,[Group Name]
                ,[Printed]
                ,[BR Code]
                ,[Pay Mode]
                ,[Account No]
                ,[Account Type]
                ,[MICR Code]
                ,[MICR City Code]
                ,[Local]
                ,[RBI AG Code]
                ,[RBI BR Code]
                ,[State Code]
                ,[STEPS BR Code]
                ,[STEPS Account NO]
                ,[GRP Password]
                ,[STEPS CoreBank]
                ,[AUTH Sign Name]
                ,[AUTH Sign Desgn]
                ,[IFSC Code]
                ,[IFSC Account Name]
                ,[IFSC Account NO]
                ,[IFSC Address]
                ,[IFSC File]
                ,[Adwing Pay Mode]
                ,[PFMS UniqueCode]
                ,[Group New Name]
                ,[Sanction Payee]
                ,[Owner Type]
                )  
            values (
                DEFAULT,
                '" . $owner_id . "',
                '" . $request->owner_name . "',
                '" . $request->mobile . "',
                '" . $request->email . "',
                '" . $request->phone . "',
                '" . $request->fax_no . "',
                '" . $request->address . "',
                ' ',
                '" . $request->city . "',
                '" . $request->district . "',            
                '" . $request->state . "',
                0,'','','','','','','','','','','',
                '','','',0,'','','','','','','','','','','','','','','','','','','',0,'','','',
                 $request->owner_type               
                )"
                );
                $msg = 'Data Saved Successfully!';
            } else {
                $owner_id = $request->ownerid;
                $Owner_table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
                if ($request->district != '' && $request->district != '') {
                    $update = array(
                        'Owner Name' => $request->owner_name,
                        'Owner Type' => $request->owner_type,
                        'Mobile No_' => $request->mobile,
                        'Email ID' => $request->email,
                        'Phone No_' => $request->phone,
                        'Fax No_' => $request->fax_no,
                        'Address 1' => $request->address,
                        'City' => $request->city,
                        'District' => $request->district,
                        'State' => $request->state
                    );
                } else {
                    $update = array(
                        'Owner Name' => $request->owner_name,
                        'Mobile No_' => $request->mobile,
                        'Email ID' => $request->email,
                        'Phone No_' => $request->phone,
                        'Fax No_' => $request->fax_no,
                        'Address 1' => $request->address,
                        'City' => $request->city,
                    );
                }
                $where = array('Owner ID' => $owner_id);
                $sql = ApiFreshEmpanelment::updateAllRecords($Owner_table, $update, $where);
                $msg = 'Data Updated Successfully!';
            }
        }
        if ($sql) {
            $unique_id = array('Owner_ID' => $owner_id);
            return $this->sendResponse($owner_id, $msg);
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function freshEmpanelmentSaveVendorData(Request $request)
    {
        // All files variables
        $rni_reg_file_name = '';
        $rni_registration_certificate = 0;
        $annexure_file_name = '';
        $annexure_XII_A = 0;
        $circulation_cert_file_name = '';
        $circulation_certificate = 0;
        $annual_return_file_name = '';
        $annual_return_submitted_rni = 0;
        $specimen_copy_file_name = '';
        $specimen_copies = 0;
        $commercial_rate_file_name = '';
        $commercial_rate = 0;
        $no_dues_cert_file_name = '';
        $no_dues_certificate = 0;
        $gst_reg_cert_file_name = '';
        $gst_registration_certificate = 0;
        $declaration_field_file_name = '';
        $declaration_field = 0;
        $pan_copy_file_name = '';
        $pan_copy = 0;
        $dm_declaration_file_name = '';
        $dm_declaration_change = 0;
        $change_in_address_file_name = '';
        $change_in_address_uploaded = 0;
        // end files variables
        // define account details variables
        $request->bank_account_no = $request->bank_account_no ?? '';
        $request->account_holder_name = $request->account_holder_name ?? '';
        $request->address_of_account = $request->address_of_account ?? '';
        $request->ifsc_code = $request->ifsc_code ?? '';
        $request->bank_name = $request->bank_name ?? '';
        $request->branch_name = $request->branch_name ?? '';
        $request->pan_card = $request->pan_card ?? '';
        $request->ESI_account_no = $request->ESI_account_no ?? '';
        $request->ESI_no_employees = $request->ESI_no_employees ?? 0;
        $request->EPF_account_no = $request->EPF_account_no ?? '';
        $request->EPF_no_of_employees = $request->EPF_no_of_employees ?? 0;
        // end account variables
        // define vendor info variables
        $mytime = Carbon::now();
        $application_date = $mytime->format('Y-m-d');
        $status = 0;

        $davp_checkbox = $request->davp_checkbox == "on" ? 1 : 0;
        $self_declaration = $request->self_declaration == "on" ? 1 : 0;

        $request->page_length = $request->page_length ?? 0;
        $request->page_width = $request->page_width ?? 0;
        $request->print_area = $request->print_area ?? 0;
        $request->no_of_page = $request->no_of_page ?? 0;
        $request->total_print_area = $request->total_print_area ?? 0;
        $request->black_white = $request->black_white ?? 0;
        $request->colour = $request->colour ?? 0;
        $request->total_annual_turn_over = $request->total_annual_turn_over ?? 0;
        $request->colour_pages = $request->colour_pages ?? 0;
        $request->distance_office_to_press = $request->distance_office_to_press ?? 0;
        $request->ESI_no_employees = $request->ESI_no_employees ?? 0;
        $request->EPF_no_of_employees = $request->EPF_no_of_employees ?? 0;
        $request->dm_declaration = $request->dm_declaration ?? 0;
        $dm_declaration_date = '1970-01-01';
        $rate_status_date = '1970-01-01';
        //if ($request->dm_declaration == 1 && $request->dm_declaration_date != '') {
        if ($request->dm_declaration_date != '') {
            $dm_declaration_date = date('Y-m-d', strtotime($request->dm_declaration_date));
        }
        $rni_registration_no = '';
        $rni_efiling_no = '';
        $claimed_circulation = 0;
        $caregistration_no = '';
        $ca_claimed_circulation = '';
        $abc_certificate_no = '';
        $abc_claimed_circulation = '';

        $rni_reg_no_verified = 0;
        $rni_annual_valid = 0;
        $rni_claimed_circulation_verified = 0;
        $RNI_Validation_Date = '1970-01-01';

        $abc_reg_no_verified = 0;
        $abc_annual_valid = 0;
        $abc_claimed_circulation_verified = 0;
        $ABC_Validation_Date = '1970-01-01';

        if ($request->cir_base == 0) {
            $rni_registration_no = $request->rni_registration_no ?? '';
            $rni_efiling_no = $request->rni_efiling_no ?? '';
            $claimed_circulation = $request->claimed_circulation ?? 0;

            $rni_reg_no_verified = $request->rni_reg_no_verified ?? 0;
            $rni_annual_valid = $request->rni_annual_valid ?? 0;
            $rni_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old) {
                $RNI_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $RNI_Validation_Date = $mytime->format('Y-m-d');
            }
        }
        if ($request->cir_base == 1) {
            //$caregistration_no = $request->rni_registration_no ?? '';
            $ca_claimed_circulation = $request->claimed_circulation ?? '';
        }
        if ($request->cir_base == 3) {
            $abc_certificate_no = $request->abc_certificate_no ?? '';
            $abc_claimed_circulation = $request->claimed_circulation ?? '';

            $abc_reg_no_verified = $request->abc_reg_no_verified ?? 0;
            $abc_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old) {
                $ABC_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $ABC_Validation_Date = $mytime->format('Y-m-d');
            }
        }
        $request->address_of_press = $request->address_of_press ?? '';
        $request->ca_name = $request->ca_name ?? '';
        $request->ca_email = $request->ca_email ?? '';
        $request->ca_mobile = $request->ca_mobile ?? '';
        $request->ca_unique_no = $request->ca_unique_no ?? '';
        $request->ca_address = $request->ca_address ?? '';
        $request->ca_registration_no = $request->ca_registration_no ?? '';
        $request->cin_no = $request->cin_no ?? '';
        $request->v_phone = $request->v_phone ?? '';
        $request->v_fax_no = $request->v_fax_no ?? '';
        $owner_id = $request->ownerid ?? '';
        $user_id = $request->user_id ?? '';
        $request->change_address = $request->change_address ?? 0;
        $request->press_owned_by_owner = $request->press_owned_by_owner ?? 0;
        $request->vendor_edition = $request->vendor_edition ?? 0;
        $request->agencies = $request->agencies ?? '';

        $request->GST_No = $request->GST_No ?? '';
        $request->abc_certificate_no = $request->abc_certificate_no ?? '';
        $request->account_type = $request->account_type ?? '';
        $request->is_primary = $request->is_primary ?? 0;

        $request->ca_udin_number = $request->ca_udin_number ?? 0;
        $request->average_circulation_copies = $request->average_circulation_copies ?? 0;
        if ($request->date_of_first_publication) {
            $date_of_first_publication = date('Y-m-d', strtotime($request->date_of_first_publication));
        } else {
            $date_of_first_publication = $mytime->format('Y-m-d');
        }
        // newspaper code formate
        $vendor_table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
        $main_print_master = '[BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2]';
        // $Newspaper_Code_ID = DB::select("select [Newspaper Code] from $vendor_table where [Newspaper Code] = '" . $request->vendorid_tab_2 . "'");

        //Get value for Receiver ID.
        $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
        $get_receiver_code = DB::select("select TOP 1 [Print Empanel Landing UID] from dbo.$receiver_table");
        $recervier_id = $get_receiver_code[0]->{"Print Empanel Landing UID"};
        if ($request->vendorid_tab_2 == '') {

            // $vendor_table = '[BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2]';
            $newspaper_code = DB::select("select TOP 1 [Newspaper Code] from dbo.$vendor_table order by [Newspaper Code] desc");

            if (empty($newspaper_code)) {
                $newspaper_code = "800000";
            } else {
                $newspaper_code = $newspaper_code[0]->{"Newspaper Code"};
                $newspaper_code++;
            }
            $sql1 =  DB::insert(
                "insert into $vendor_table ([timestamp],
                [Newspaper Code],
                [Newspaper Name],
                [Place of Publication],
                [Language],
                [Bank Account No_],
                [Account Holder Name],
                [Account Address],
                [IFSC Code],
                [Bank Name],
                [Branch],
                [RNI Registration No_],
                [Claimed Circulation],
                [CIR Base],
                [RNI E-filling No_],
                [Address],
                [City],
                [State],
                [District],
                [Pin Code],
                [Phone No],
                [Fax],
                [Mobile No_],
                [E-mail ID],
                [ESI Account No],
                [No_of Employees covered],
                [EPF Account No_],
                [No_ of EPF Employees covered],
                [PAN],[Page Length],
                [Page Width],
                [Page Area per page],                
                [No_ Of pages],
                [Total Print Area],
                [Minimum Current Card Rate(B_W)],                
                [Minimum Current Card Rate(c)],
                [Annual Turn-over],
                [Quality of Paper],
                [Printing in colour],                
                [No_ of pages in colour],
                [News Agencies Subscribed To],
                [Agencies Name],
                [Price of NewsPaper],                
                [Publisher_s Name],
                [Printer_s Name],
                [Owner ID],
                [Name of Press],
                [Address of Press],                
                [Distance from office to press],
                [Press owned by owner],
                [CA Name],
                [CA Address],
                [CA Registration No_],                
                [RNI Registration Certificate],
                [Annexure - XII_A],
                [Self Declaration],
                [Circulation Certificate],                
                [Specimen Copies],
                [Commercial Rate],                
                [No Dues Certificate],
                [GST Registration Certificate],
                [RNI Reg File Name],
                [Annexure File Name],                
                [Circulation Cert File Name],
                [Specimen Copy File Name],
                [Commercial Rate File Name],
                [No Dues Cert File Name],                
                [GST Reg Cert File Name],
                [Status],
                [Application Date],
                [Periodicity],
                [Copy Of Declaration Reg_ Cer_],                
                [Any Other Publication of Owner],
                [Annual Return Submitted to RNI],
                [PAN Copy],
                [Declaration Filed Before Auth_],                
                [DM Decl_ in case of Change],
                [Annual Return File Name],
                [PAN Copy File Name],
                [Decl_ Filed Before File Name],                
                [DM Declaration File Name],
                [Digital Signature],
                [Digital Signature File Name],
                [CA Phone No_],
                [CA Email],                
                [CA Mobile No_],
                [DM Declaration],
                [DM Declaration Date],
                [Vendor Edition],
                [CIN Number],
                [Change In Company Address],                
                [Change in address uploaded],
                [Change in address File Name],
                [Editor Name],
                [Editor Email],
                [Editor Phone],                
                [Editor Mobile],
                [Publisher Email],
                [Publisher Phone],
                [Publisher Mobile],
                [Printer Email],
                [Printer Phone],                
                [Printer Mobile],
                [Press Email],
                [Press Phone],
                [Press Mobile],
                [CA Unique No_],
                [Sender ID],
                [Receiver ID],
                [Rate],
                [Circulation Accepted],
                [Bound Publications],
                [Unbound Publications],
                [C1],
                [Increase],
                [Rate Year],
                [User ID],
                [Modification],
                [Rate Status],
                [Rate Remark],
                [Rate Status Date],
                [ABC Number],
                [ABC Circulation Number],
                [CA Number],
                [CA Circulation Number],
                [RNI Circulation Validation],
                [RNI Registration Validation],
                [RNI Annual Validation],
                [RNI Validation Date],
                [ABC Circulation Validation],
                [ABC Registration Validation],
                [ABC Annual Validation],
                [ABC Validation Date],
                [Agr File Path],
                [Agr File Name],
                [Alocated NP Code],
                [Empanelment Category],
                [Global Dimension 1 Code],
                [Global Dimension 2 Code],
                [GST No_],
                [ABC Certificate No_],
                [Account Type],
                [Primary Edition],
                [Date Of First Publication],
                [Average Circulation Copies],
                [UDIN],
                [From Date],
                [To Date],
                [Physically Verified],
                [Verification Date],
                [Empanel Date]
                )
            values (DEFAULT,
            '" . $newspaper_code . "',
            '" . $request->newspaper_name . "',
            '" . $request->place_of_publication . "',
            '" . $request->language . "',
            '" . $request->bank_account_no . "',
            '" . $request->account_holder_name . "',
            '" . $request->address_of_account . "',
            '" . $request->ifsc_code . "',
            '" . $request->bank_name . "',
            '" . $request->branch_name . "',
            '" . $rni_registration_no . "',
                 $claimed_circulation,
                 $request->cir_base,
            '" . $rni_efiling_no . "',
            '" . $request->v_address . "',
            '" . $request->v_city . "',
            '" . $request->v_state . "',
            '" . $request->v_district . "',
            '" . $request->pin_code . "',
            '" . $request->v_phone . "',
            '" . $request->v_fax_no . "',
            '" . $request->v_mobile . "',
            '" . $request->v_email . "',
            '" . $request->ESI_account_no . "',
                 $request->ESI_no_employees,  
            '" . $request->EPF_account_no . "',
                 $request->EPF_no_of_employees,
            '" . $request->pan_card . "',
                $request->page_length,
                $request->page_width,
                $request->print_area,
                $request->no_of_page,
                $request->total_print_area,
                $request->black_white,
                $request->colour,
                $request->total_annual_turn_over,
                $request->quality_paper_used,
                $request->printing_colour,
                $request->colour_pages,
                $request->news_agencies_subscribed,
            '" . $request->agencies . "',
                 $request->price_newspaper,
            '" . $request->publisher_name . "',
            '" . $request->printer_name . "',
            '" . $owner_id . "',
            '" . $request->name_of_press . "',
            '" . $request->address_of_press . "',
                $request->distance_office_to_press,
                $request->press_owned_by_owner,
            '" . $request->ca_name . "',
            '" . $request->ca_address . "',
            '" . $request->ca_registration_no . "',
                $rni_registration_certificate,
                $annexure_XII_A,
                $self_declaration,
                $circulation_certificate,
                $specimen_copies,
                $commercial_rate,
                $no_dues_certificate,
                $gst_registration_certificate,
            '" . $rni_reg_file_name . "',
            '" . $annexure_file_name . "',
            '" . $circulation_cert_file_name . "',
            '" . $specimen_copy_file_name . "',
            '" . $commercial_rate_file_name . "',
            '" . $no_dues_cert_file_name . "',
            '" . $gst_reg_cert_file_name . "',
                 $status,
            '" . $application_date . "',
                 $request->periodicity,
                0,
                $davp_checkbox,
                $annual_return_submitted_rni,
                $pan_copy,
                $declaration_field,
                $dm_declaration_change,
            '" . $annual_return_file_name . "',
            '" . $pan_copy_file_name . "',
            '" . $declaration_field_file_name . "',
            '" . $dm_declaration_file_name . "',
            0,
            '',
            '" . $request->ca_phone . "',
            '" . $request->ca_email . "',
            '" . $request->ca_mobile . "',
                 $request->dm_declaration,
            '" . $dm_declaration_date . "',
                 $request->vendor_edition,
            '" . $request->cin_no . "',
                 $request->change_address,
                 $change_in_address_uploaded,
            '" . $change_in_address_file_name . "',
            '" . $request->name_of_editor . "',
            '" . $request->editor_email . "',
            '" . $request->editor_phone . "',
            '" . $request->editor_mobile . "',
            '" . $request->publisher_email . "',
            '" . $request->publisher_phone . "',
            '" . $request->publisher_mobile . "',
            '" . $request->printer_email . "',
            '" . $request->printer_phone . "',
            '" . $request->printer_mobile . "',
            '" . $request->press_email . "',
            '" . $request->press_phone . "',
            '" . $request->press_mobile . "',
            '" . $request->ca_unique_no . "',
            '',
            '" . $recervier_id . "',
            0,
            0,
            0,
            0,
            0,
            0,
            0,
            '" . $user_id . "',
            1,
            0,
            '',
            '" . $rate_status_date . "',
            '" . $abc_certificate_no . "',
            '" . $abc_claimed_circulation . "',
            '" . $caregistration_no . "',
            '" . $ca_claimed_circulation . "',
            $rni_claimed_circulation_verified,
            $rni_reg_no_verified,
            $rni_annual_valid,
            '" . $RNI_Validation_Date . "',
            $abc_claimed_circulation_verified,
            $abc_reg_no_verified,
            $abc_annual_valid,
            '" . $ABC_Validation_Date . "',
            '',
            '',
            '',
            0,
            'M001',
            '',
            '" . $request->GST_No . "',
            '" . $abc_certificate_no . "',
            '" . $request->account_type . "',
            $request->is_primary,
            '" . $date_of_first_publication . "',            
            $request->average_circulation_copies,
            '". $request->ca_udin_number ."',
            '','','','',''
             )"
            );
            $msg = 'Data Save Successfully! Please note the ' . $owner_id . ' reference number for future use.';
            $unique_id = array('Owner_ID' => $owner_id, 'Newspaper_Code' => $newspaper_code);
        } else {
            $newspaper_code = $request->vendorid_tab_2;

            $update = array(
                'Newspaper Name' => $request->newspaper_name,
                'Place of Publication' => $request->place_of_publication,
                'Language' => $request->language,
                'RNI Registration No_' => $rni_registration_no,
                'Claimed Circulation' => $claimed_circulation,
                'CIR Base' => $request->cir_base,
                'RNI E-filling No_' => $rni_efiling_no,
                'Address' => $request->v_address,
                'City' => $request->v_city,
                'State' => $request->v_state,
                'District' => $request->v_district,
                'Pin Code' => $request->pin_code,
                'Phone No' => $request->v_phone,
                'Fax' => $request->v_fax_no,
                'Mobile No_' => $request->v_mobile,
                'E-mail ID' => $request->v_email,
                'Page Length' => $request->page_length,
                'Page Width' => $request->page_width,
                'Page Area per page' => $request->print_area,
                'No_ Of pages' => $request->no_of_page,
                'Total Print Area' => $request->total_print_area,
                'Minimum Current Card Rate(B_W)' => $request->black_white,
                'Minimum Current Card Rate(c)' => $request->colour,
                'Annual Turn-over' => $request->total_annual_turn_over,
                'Quality of Paper' => $request->quality_paper_used,
                'Printing in colour' => $request->printing_colour,
                'No_ of pages in colour' => $request->colour_pages,
                'News Agencies Subscribed To' => $request->news_agencies_subscribed,
                'Agencies Name' => $request->agencies,
                'Price of NewsPaper' => $request->price_newspaper,
                'Publisher_s Name' => $request->publisher_name,
                'Printer_s Name' => $request->printer_name,
                'Name of Press' => $request->name_of_press,
                'Address of Press' => $request->address_of_press,
                'Distance from office to press' => $request->distance_office_to_press,
                'Press owned by owner' => $request->press_owned_by_owner,
                'CA Name' => $request->ca_name,
                'CA Address' => $request->ca_address,
                'CA Registration No_' => $request->ca_registration_no,
                'Status' => $status,
                'Application Date' => $application_date,
                'Periodicity' => $request->periodicity,
                'Any Other Publication of Owner' => $davp_checkbox,
                'CA Phone No_' => $request->ca_phone ?? '',
                'CA Email' => $request->ca_email,
                'CA Mobile No_' => $request->ca_mobile,
                'DM Declaration' => $request->dm_declaration ?? 0,
                'DM Declaration Date' => $dm_declaration_date,
                'Vendor Edition' => $request->vendor_edition,
                'CIN Number' => $request->cin_no,
                'Change In Company Address' => $request->change_address,
                'Editor Name' => $request->name_of_editor,
                'Editor Email' => $request->editor_email,
                'Editor Phone' => $request->editor_phone ?? '',
                'Editor Mobile' => $request->editor_mobile,
                'Publisher Email' => $request->publisher_email,
                'Publisher Phone' => $request->publisher_phone ?? '',
                'Publisher Mobile' => $request->publisher_mobile,
                'Printer Email' => $request->printer_email,
                'Printer Phone' => $request->printer_phone ?? '',
                'Printer Mobile' => $request->printer_mobile,
                'Press Email' => $request->press_email,
                'Press Phone' => $request->press_phone,
                'Press Mobile' => $request->press_mobile,
                'Receiver ID' => $recervier_id,
                'CA Unique No_' => $request->ca_unique_no,
                'ABC Number' => $abc_certificate_no,
                'ABC Circulation Number' => $abc_claimed_circulation,
                'CA Number' => $caregistration_no,
                'CA Circulation Number' => $ca_claimed_circulation,
                'RNI Circulation Validation' => $rni_claimed_circulation_verified,
                'RNI Registration Validation' => $rni_reg_no_verified,
                'RNI Annual Validation' => $rni_annual_valid,
                'RNI Validation Date' => $RNI_Validation_Date,
                'ABC Circulation Validation' => $abc_claimed_circulation_verified,
                'ABC Registration Validation' => $abc_reg_no_verified,
                'ABC Validation Date' => $ABC_Validation_Date,
                'GST No_' => $request->GST_No,
                'ABC Certificate No_' => $abc_certificate_no,
                'Primary Edition' => $request->is_primary,
                'Date Of First Publication' => $date_of_first_publication,
                'Average Circulation Copies' => $request->average_circulation_copies,
                'UDIN' => $request->ca_udin_number
            );
            $vendor_table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
            $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);
            $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);
            $msg = 'Data Updated Successfully! Please note the ' . $owner_id . ' reference number for future use.';
            $unique_id = array('Owner_ID' => $owner_id, 'Newspaper_Code' => $newspaper_code);
        }

        if ($sql1) {
            return $this->sendResponse($newspaper_code, $msg);

            //return $this->sendResponse('', 'Data Save Successfully! Please note the ' . $owner_id . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function freshEmpanelmentSaveVendorAccount(Request $request)
    {
        $vendor_table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_3 ?? '';

        // account information variable
        $request->bank_account_no = $request->bank_account_no ?? '';
        $request->account_holder_name = $request->account_holder_name ?? '';
        $request->address_of_account = $request->address_of_account ?? '';
        $request->ifsc_code = $request->ifsc_code ?? '';
        $request->bank_name = $request->bank_name ?? '';
        $request->branch_name = $request->branch_name ?? '';
        $request->pan_card = $request->pan_card ?? '';
        $request->ESI_account_no = $request->ESI_account_no ?? '';
        $request->ESI_no_employees = $request->ESI_no_employees ?? 0;
        $request->EPF_account_no = $request->EPF_account_no ?? '';
        $request->EPF_no_of_employees = $request->EPF_no_of_employees ?? 0;
        $request->account_type = $request->account_type ?? '';
        $update = array(
            'Bank Account No_' => $request->bank_account_no,
            'Account Holder Name' => $request->account_holder_name,
            'Account Address' => $request->address_of_account,
            'IFSC Code' => $request->ifsc_code,
            'Bank Name' => $request->bank_name,
            'Branch' => $request->branch_name,
            'ESI Account No' => $request->ESI_account_no,
            'No_of Employees covered' => $request->ESI_no_employees,
            'EPF Account No_' => $request->EPF_account_no,
            'No_ of EPF Employees covered' => $request->EPF_no_of_employees,
            'PAN' => $request->pan_card,
            'Account Type' => $request->account_type
        );
        $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);
        // dd($where);
        $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);

        // dd($where);
        if ($sql1) {
            //return $this->sendResponse($unique_id, $msg);

            return $this->sendResponse($newspaper_code, 'Data Updated Successfully! Please note the ' . $owner_id . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function freshEmpanelmentSaveVendorDocs(Request $request)
    {

        $vendor_table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_4 ?? '';
        //echo $request->user_id;exit;
        $select = array(
            'RNI Reg File Name',
            'Annexure File Name',
            'Circulation Cert File Name',
            'Specimen Copy File Name',
            'Commercial Rate File Name',
            'No Dues Cert File Name',
            'GST Reg Cert File Name',
            'Annual Return File Name',
            'PAN Copy File Name',
            'Decl_ Filed Before File Name',
            'DM Declaration File Name',
            'Change in address File Name',
            'RNI Registration Certificate',
            'Annexure - XII_A',
            'Circulation Certificate',
            'Specimen Copies',
            'Commercial Rate',
            'No Dues Certificate',
            'GST Registration Certificate',
            'Annual Return Submitted to RNI',
            'PAN Copy',
            'Declaration Filed Before Auth_',
            'DM Decl_ in case of Change',
            'Change in address uploaded'
        );

        $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);

        $response = ApiFreshEmpanelment::fetchAllRecords($vendor_table, $select, '', '', $where);

        $destinationPath = public_path() . '/uploads/fresh-empanelment/';
        $mypath = public_path() . '/uploads/fresh-empanelment/' . $newspaper_code . "/";
        if (!File::isDirectory($mypath)) {
            File::makeDirectory($mypath, 0777, true, true);
        }

        $rni_reg_file_name = $response[0]->{'RNI Reg File Name'} ?? '';
        $rni_registration_certificate = $response[0]->{'RNI Registration Certificate'} ?? 0;
        if ($request->hasFile('rni_reg_file_name') || $request->hasFile('rni_reg_file_name_modify')) {
            $file = $request->file('rni_reg_file_name') ?? $request->file('rni_reg_file_name_modify');
            $rni_reg_file_name = time() . '-' . $newspaper_code . '-RNIReg';
            $file_uploaded = $file->move($destinationPath, $rni_reg_file_name);
            File::copy($destinationPath.$rni_reg_file_name, $mypath.$rni_reg_file_name);
            if ($file_uploaded) {
                $rni_registration_certificate = 1;
            } else {
                $rni_reg_file_name = '';
            }
        }
        $annexure_file_name = $response[0]->{'Annexure File Name'} ?? '';
        $annexure_XII_A = $response[0]->{'Annexure - XII_A'} ?? 0;
        if ($request->hasFile('annexure_file_name') || $request->hasFile('annexure_file_name_modify')) {
            $file = $request->file('annexure_file_name') ?? $request->file('annexure_file_name_modify');
            $annexure_file_name = time() . '-' . $newspaper_code . '-Annexure';
            $file_uploaded = $file->move($destinationPath, $annexure_file_name);
            File::copy($destinationPath.$annexure_file_name, $mypath.$annexure_file_name);
            if ($file_uploaded) {
                $annexure_XII_A = 1;
            } else {
                $annexure_file_name = '';
            }
        }
        $circulation_cert_file_name = $response[0]->{'Circulation Cert File Name'} ?? '';
        $circulation_certificate = $response[0]->{'Circulation Certificate'} ?? 0;
        if ($request->hasFile('circulation_cert_file_name') || $request->hasFile('circulation_cert_file_name_modify')) {
            //$circulation_certificate = 1;
            $file = $request->file('circulation_cert_file_name') ?? $request->file('circulation_cert_file_name_modify');
            $circulation_cert_file_name = time() . '-' . $newspaper_code . '-CIRCert';
            $file_uploaded = $file->move($destinationPath, $circulation_cert_file_name);
            File::copy($destinationPath.$circulation_cert_file_name, $mypath.$circulation_cert_file_name);
            if ($file_uploaded) {
                $circulation_certificate = 1;
            } else {
                $circulation_cert_file_name = '';
            }
        }

        $annual_return_file_name =  $response[0]->{'Annual Return File Name'} ?? '';
        $annual_return_submitted_rni = $response[0]->{'Annual Return Submitted to RNI'} ?? 0;
        if ($request->hasFile('annual_return_file_name') || $request->hasFile('annual_return_file_name_modify')) {
            //$annual_return_submitted_rni = 1;
            $file = $request->file('annual_return_file_name') ?? $request->file('annual_return_file_name_modify');
            $annual_return_file_name = time() . '-' . $newspaper_code . '-AnnualReturn';
            $file_uploaded = $file->move($destinationPath, $annual_return_file_name);
            File::copy($destinationPath.$annual_return_file_name, $mypath.$annual_return_file_name);
            if ($file_uploaded) {
                $annual_return_submitted_rni = 1;
            } else {
                $annual_return_file_name = '';
            }
        }

        $specimen_copy_file_name = $response[0]->{'Specimen Copy File Name'} ?? '';
        $specimen_copies =  $response[0]->{'Specimen Copies'} ?? 0;
        if ($request->hasFile('specimen_copy_file_name') || $request->hasFile('specimen_copy_file_name_modify')) {
            //$specimen_copies = 1;
            $file = $request->file('specimen_copy_file_name') ?? $request->file('specimen_copy_file_name_modify');
            $specimen_copy_file_name = time() . '-' . $newspaper_code . '-SpecimenCopy';
            $file_uploaded = $file->move($destinationPath, $specimen_copy_file_name);
            File::copy($destinationPath.$specimen_copy_file_name, $mypath.$specimen_copy_file_name);
            if ($file_uploaded) {
                $specimen_copies = 1;
            } else {
                $specimen_copy_file_name = '';
            }
        }
        $commercial_rate_file_name = $response[0]->{'Commercial Rate File Name'} ?? '';
        $commercial_rate = $response[0]->{'Commercial Rate'} ?? 0;
        if ($request->hasFile('commercial_rate_file_name') || $request->hasFile('commercial_rate_file_name_modify')) {
            //$commercial_rate = 1;
            $file = $request->file('commercial_rate_file_name') ?? $request->file('commercial_rate_file_name_modify');
            $commercial_rate_file_name = time() . '-' . $newspaper_code . '-CommercialRate';
            $file_uploaded = $file->move($destinationPath, $commercial_rate_file_name);
            File::copy($destinationPath.$commercial_rate_file_name, $mypath.$commercial_rate_file_name);
            if ($file_uploaded) {
                $commercial_rate = 1;
            } else {
                $commercial_rate_file_name = '';
            }
        }
        $no_dues_cert_file_name =  $response[0]->{'No Dues Cert File Name'} ?? '';
        $no_dues_certificate = $response[0]->{'No Dues Certificate'} ?? 0;
        if ($request->hasFile('no_dues_cert_file_name') || $request->hasFile('no_dues_cert_file_name_modify')) {
            // $no_dues_certificate = 1;
            $file = $request->file('no_dues_cert_file_name') ?? $request->file('no_dues_cert_file_name_modify');
            $no_dues_cert_file_name = time() . '-' . $newspaper_code . '-NoDuesCert';
            $file_uploaded = $file->move($destinationPath, $no_dues_cert_file_name);
            File::copy($destinationPath.$no_dues_cert_file_name, $mypath.$no_dues_cert_file_name);
            if ($file_uploaded) {
                $no_dues_certificate = 1;
            } else {
                $no_dues_cert_file_name = '';
            }
        }

        $gst_reg_cert_file_name = $response[0]->{'GST Reg Cert File Name'} ?? '';
        $gst_registration_certificate = $response[0]->{'GST Registration Certificate'} ?? 0;
        if ($request->hasFile('gst_reg_cert_file_name') || $request->hasFile('gst_reg_cert_file_name_modify')) {
            // $gst_registration_certificate = 1;
            $file = $request->file('gst_reg_cert_file_name') ?? $request->file('gst_reg_cert_file_name_modify');
            $gst_reg_cert_file_name = time() . '-' . $newspaper_code . '-GSTRegCert';
            $file_uploaded = $file->move($destinationPath, $gst_reg_cert_file_name);
            File::copy($destinationPath.$gst_reg_cert_file_name, $mypath.$gst_reg_cert_file_name);
            if ($file_uploaded) {
                $gst_registration_certificate = 1;
            } else {
                $gst_reg_cert_file_name = '';
            }
        }
        $declaration_field_file_name =  $response[0]->{'Decl_ Filed Before File Name'} ?? '';
        $declaration_field = $response[0]->{'Declaration Filed Before Auth_'} ?? 0;
        if ($request->hasFile('declaration_field_file_name') || $request->hasFile('declaration_field_file_name_modify')) {
            // $declaration_field = 1;
            $file = $request->file('declaration_field_file_name') ?? $request->file('declaration_field_file_name_modify');
            $declaration_field_file_name = time() . '-' . $newspaper_code . '-DeclFiled';
            $file_uploaded = $file->move($destinationPath, $declaration_field_file_name);
            File::copy($destinationPath.$declaration_field_file_name, $mypath.$declaration_field_file_name);
            if ($file_uploaded) {
                $declaration_field = 1;
            } else {
                $declaration_field_file_name = '';
            }
        }

        $pan_copy_file_name = $response[0]->{'PAN Copy File Name'} ?? '';
        $pan_copy = $response[0]->{'PAN Copy'} ?? 0;
        if ($request->hasFile('pan_copy_file_name') || $request->hasFile('pan_copy_file_name_modify')) {
            // $pan_copy = 1;
            $file = $request->file('pan_copy_file_name') ?? $request->file('pan_copy_file_name_modify');
            $pan_copy_file_name = time() . '-' . $newspaper_code . '-PANCopy';
            $file_uploaded = $file->move($destinationPath, $pan_copy_file_name);
            File::copy($destinationPath.$pan_copy_file_name, $mypath.$pan_copy_file_name);
            if ($file_uploaded) {
                $pan_copy = 1;
            } else {
                $pan_copy_file_name = '';
            }
        }

        // $dm_declaration_file_name = $response[0]->{'DM Declaration File Name'} ?? '';
        // $dm_declaration_change = $response[0]->{'DM Decl_ in case of Change'} ?? 0;
        // if ($request->hasFile('dm_declaration_file_name') || $request->hasFile('dm_declaration_file_name_modify')) {
        //     // $dm_declaration_change = 1;
        //     $file = $request->file('dm_declaration_file_name') ?? $request->file('dm_declaration_file_name_modify');
        //     $dm_declaration_file_name = time() . '-' . $newspaper_code . '-DMDecl';
        //     $file_uploaded = $file->move($destinationPath, $dm_declaration_file_name);
        //     if ($file_uploaded) {
        //         $dm_declaration_change = 1;
        //     } else {
        //         $dm_declaration_file_name = '';
        //     }
        // }

        if ($request->change_address == 1) {
            $change_in_address_file_name = $response[0]->{'Change in address File Name'} ?? '';
            $change_in_address_uploaded = $response[0]->{'Change in address uploaded'} ?? 0;
            if ($request->hasFile('change_in_address_file_name') || $request->hasFile('change_in_address_file_name_modify')) {
                // $change_in_address_uploaded = 1;
                $file = $request->file('change_in_address_file_name') ?? $request->file('change_in_address_file_name_modify');
                $change_in_address_file_name = time() . '-' . $newspaper_code . '-ChangeAdd';
                $file_uploaded = $file->move($destinationPath, $change_in_address_file_name);
                File::copy($destinationPath.$change_in_address_file_name, $mypath.$change_in_address_file_name);
                if ($file_uploaded) {
                    $change_in_address_uploaded = 1;
                } else {
                    $change_in_address_file_name = '';
                }
            }
        } else {
            $change_in_address_uploaded = 0;
            $change_in_address_file_name = ' ';
        }

        $self_declaration = $request->self_declaration == "on" ? 1 : 0;
        $vendor_table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $owner_id = $request->ownerid ?? '';
        $newspaper_code = $request->vendorid_tab_4 ?? '';
        $update = array(
            'RNI Registration Certificate' => $rni_registration_certificate,
            'Annexure - XII_A' => $annexure_XII_A,
            'Self Declaration' => $self_declaration,
            'Circulation Certificate' => $circulation_certificate,
            'Specimen Copies' => $specimen_copies,
            'Commercial Rate' => $commercial_rate,
            'No Dues Certificate' => $no_dues_certificate,
            'GST Registration Certificate' => $gst_registration_certificate,
            'RNI Reg File Name' => $rni_reg_file_name,
            'Annexure File Name' => $annexure_file_name,
            'Circulation Cert File Name' => $circulation_cert_file_name,
            'Specimen Copy File Name' => $specimen_copy_file_name,
            'Commercial Rate File Name' => $commercial_rate_file_name,
            'No Dues Cert File Name' => $no_dues_cert_file_name,
            'GST Reg Cert File Name' => $gst_reg_cert_file_name,
            'Annual Return Submitted to RNI' => $annual_return_submitted_rni,
            'PAN Copy' => $pan_copy,
            'Declaration Filed Before Auth_' => $declaration_field,
            //'DM Decl_ in case of Change' => $dm_declaration_change,
            'Annual Return File Name' => $annual_return_file_name,
            'PAN Copy File Name' => $pan_copy_file_name,
            'Decl_ Filed Before File Name' => $declaration_field_file_name,
            // 'DM Declaration File Name' => $dm_declaration_file_name,
            'Change in address uploaded' => $change_in_address_uploaded,
            'Change in address File Name' => $change_in_address_file_name,
            'Modification' => 0
        );
        $where = array('Owner ID' => $owner_id, 'Newspaper Code' => $newspaper_code);
        $sql1 = ApiFreshEmpanelment::updateAllRecords($vendor_table, $update, $where);


        if ($sql1) {

            return $this->sendResponse($newspaper_code, 'Data Save Successfully! Please note the ' . $newspaper_code . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function getDistrictByState(Request $request)
    {
        $table = '[BOC$District$3f88596c-e20d-438c-a694-309eb14559b2]';
        $dis_name = DB::select("select [District] from $table where [State Code] = '" . $request->state_id . "'");
        if (!empty($dis_name)) {
            $data = "<option value=''>Select District</option>";
            foreach ($dis_name as $item) {
                $data .= "<option value='" . $item->{'District'} . "'>" . $item->{'District'} . "</option>";
            }
            return response()->json(['status' => 0, 'message' => $data]);
        } else {
            return response()->json(['status' => 1, 'message' => "<option value=''>No Data Found!</option>"]);
        }
    }
    public function existingOwnerData(Request $request)
    {
        $owner_datas = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2 as own')
            ->join('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c as st', 'st.Code', '=', 'own.State')
            ->select('own.Owner Name', 'own.Owner Type', 'own.Mobile No_', 'own.Email ID', 'own.Phone No_', 'own.Fax No_', 'own.Address 1', 'own.City', 'own.District', 'st.Description', 'st.Code')
            ->WhereIn('own.Owner ID', [$request->owner_id])
            ->get();
          
        $owner_other_datas = DB::table('BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2 as bvp')
            ->join('BOC$Language$63ca2fa4-4f03-4f2b-a480-172fef340d3f as bl', 'bl.Code', '=', 'bvp.Language')
            ->select('bvp.Newspaper Code', 'bvp.Newspaper Name', 'bvp.Place of Publication', 'bvp.Language', 'bvp.Periodicity', 'bvp.Distance from office to press', 'bvp.Date Of First Publication','bl.Name as lang_name')
            ->WhereIn('bvp.Owner ID', [$request->owner_id])
            ->get();
           
        if (count($owner_datas) > 0 || count($owner_other_datas) > 0) {
            $data = array('owner_datas' => $owner_datas[0], 'owner_other_datas' => $owner_other_datas);
            return response()->json(['status' => 0, 'message' => $data]);
        } else {
            return response()->json(['status' => 1, 'message' => "No Data Found!"]);
        }
    }
    public function checkFile(Request $request)
    {
        $file = public_path('uploads/fresh-empanelment/' . $request->file_name);
        if (file_exists($file)) {
            return response()->json(['status' => 1, 'message' => $request->file_name]);
        } else {
            return response()->json(['status' => 0, 'message' => $request->file_name]);
        }
    }
    public function fetchVendorRecord(Request $request)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('User ID' => $request->user_id);
        //echo $request->user_id;exit;
        $response = ApiFreshEmpanelment::fetchAllRecords($table, '*', '', '', $where);
        // dd($response);
        if (count($response) > 0) {
            unset($response[0]->{'timestamp'});
            // dd($response);
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function fetchOwnerRecord(Request $request)
    {
        $table = 'BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('Owner ID', 'Owner Name', 'Owner Type', 'Mobile No_', 'Email ID', 'Phone No_', 'Fax No_', 'Address 1', 'City', 'District', 'State');
        //$where = array('User ID' => $request->user_id);
        $where = array($request->key => $request->owner_id);
        //echo $request->user_id;exit;
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
   
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function getAllDistricts()
    {
        $table = 'BOC$District$3f88596c-e20d-438c-a694-309eb14559b2';
        $select = array('District');
        //echo $request->user_id;exit;
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, 'District', 'ASC', '');
        // dd($response);
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function fetchOwnerOtherRecord(Request $request)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';

        $where = array(
            ['User ID', '!=', $request->user_id],
            ['Owner ID', '=', $request->owner_id]
        ); //dd($where);
        $select = array('Newspaper Name', 'Language', 'Place of Publication', 'Periodicity', 'Newspaper Code', 'Distance from office to press');
        //echo $request->user_id;exit;
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        // dd($response);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function countVendorRecords(Request $request)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('Owner ID' => $request->Owner_ID);
        $select = array('Newspaper Name', 'Language', 'Place of Publication', 'Periodicity', 'Newspaper Code', 'Distance from office to press', 'Date Of First Publication');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function printRateOffered()
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('Newspaper Code' => session('UserName'));
        $select = array('Newspaper Name', 'Newspaper Code', 'Rate', 'Rate Status', 'Rate Remark');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function printRateStatusupdate(Request $request)
    {
        $mytime = Carbon::now();
        $date = $mytime->format('Y-m-d');
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $update = array(
            'Rate Status' => $request->rate_status,
            'Rate Remark' => $request->rate_remark,
            'Rate Status Date' => $date,
        );
        $where = array('Newspaper Code' => session('UserName'));
        $sql = ApiFreshEmpanelment::updateAllRecords($table, $update, $where);

        if ($sql) {
            return $this->sendResponse('', 'Data Updated Successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }
    public function checkRegCirBase(Request $request)
    {
        $res = $this->checkRegistrationNo($request->cir_no, $request->reg_no);
        if ($res == false) {
            return $this->sendError('Data already exist!');
        } else {
            $response = [];
            if ($request->cir_no == 0) {
                $table = 'BOC$RNI Efilling';
                $where = array('Regn Number' => $request->reg_no);
                $select = array('Efile Number', 'Sold Circulation', 'Efiling Number Valid', 'Efiling veryfied', 'Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
            }
            if ($request->cir_no == 3) {
                $table = 'BOC$ABC Circulations';
                $where = array('Certificate No_' => $request->reg_no);
                $select = array('Average Circulation Jan - Jun 2019', 'Average Circulation Jul - Dec 2019');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

                if (!empty($response[0])) {
                    $response[0]->{'Sold Circulation'} = $response[0]->{'Average Circulation Jul - Dec 2019'} != 0 ? $response[0]->{'Average Circulation Jul - Dec 2019'} : $response[0]->{'Average Circulation Jan - Jun 2019'};
                    //dd($response);
                }
            }
            if (count($response) > 0) {
                return $this->sendResponse($response, 'Verified!');
            } else {
                return $this->sendError('Not Verified!');
                exit;
            }
        }
    }

    public function checkRenewalRegCirBase($cir_no, $reg_no, $np_code)
    {
        if ($cir_no == 0) {
            $where = array(['RNI Registration No_', '=', $reg_no], ['NP Code', '!=', $np_code]);
        }
        if ($cir_no == 3) {
            $where = array(['ABC Certificate No_', '=', $reg_no], ['NP Code', '!=', $np_code]);
        }
        $response = DB::table('BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->select('NP Code')->where($where)->get();
        if (count($response) > 0) {
            return $this->sendError('Data already exist!');
        } else {
            $response = [];
            if ($cir_no == 0) {
                $table = 'BOC$RNI Efilling';
                $where = array('Regn Number' => $reg_no);
                $select = array('Efile Number', 'Sold Circulation', 'Efiling Number Valid', 'Efiling veryfied', 'Publication Name');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
            }
            if ($cir_no == 3) {
                $table = 'BOC$ABC Circulations';
                $where = array('Certificate No_' => $reg_no);
                $select = array('Average Circulation Jan - Jun 2019', 'Average Circulation Jul - Dec 2019');
                $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);

                if (!empty($response[0])) {
                    $response[0]->{'Sold Circulation'} = $response[0]->{'Average Circulation Jul - Dec 2019'} != 0 ? $response[0]->{'Average Circulation Jul - Dec 2019'} : $response[0]->{'Average Circulation Jan - Jun 2019'};
                    //dd($response);
                }
            }
            if (count($response) > 0) {
                return $this->sendResponse($response, 'Verified!');
            } else {
                return $this->sendError('Not Verified!');
                exit;
            }
        }
    }

    public function getPressOwnerData(Request $request)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('Owner ID' => $request->owner_id);
        $select = array('Name of Press', 'Press Email', 'Press Mobile', 'Press Phone', 'Address of Press', 'Distance from office to press');
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if ($response) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function printRenewalSave(Request $request)
    {
        $renewal_table = '[BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2]';

        $request->total_print_area = $request->total_print_area ?? 0;
        $request->colour_pages = $request->colour_pages ?? 0;
        if ($request->dm_declaration_date != '') {
            $dm_declaration_date = date('Y-m-d', strtotime($request->dm_declaration_date));
        }

        $mytime = Carbon::now();
        $year = $mytime->format('Y');
        $start_date = $mytime->format('Y-m-d');
        $application_date = $mytime->format('Y-m-d');
        // $daysToAdd = 364;
        $end_date = date('Y-m-d', strtotime($mytime->addDays(364)));

        $destinationPath = public_path() . '/uploads/fresh-empanelment/';
        $dm_declaration = 0;
        $dm_declaration_file_name = '';
        if ($request->hasFile('DMD_File_Name')) {
            $file = $request->file('DMD_File_Name');
            $dm_declaration_file_name = time() . '-' . $request->newspaper_code . '-DMDFile';
            $file_uploaded = $file->move($destinationPath, $dm_declaration_file_name);
            if ($file_uploaded) {
                $dm_declaration = 1;
            } else {
                $dm_declaration_file_name = '';
            }
        }

        $no_dues_cert = 0;
        $no_dues_cert_file_name = '';
        if ($request->hasFile('no_dues_cert_file_name')) {
            $file = $request->file('no_dues_cert_file_name');
            $no_dues_cert_file_name = time() . '-' . $request->newspaper_code . '-NoDuesCert';
            $file_uploaded = $file->move($destinationPath, $no_dues_cert_file_name);
            if ($file_uploaded) {
                $no_dues_cert = 1;
            } else {
                $no_dues_cert_file_name = '';
            }
        }

        $RNI_Circulation = 0;
        $ABC_Circulation = 0;
        $CA_Circulation = 0;
        $Circulation_File_Name = '';
        if ($request->hasFile('Circulation_File_Name')) {
            $file = $request->file('Circulation_File_Name');
            $Circulation_File_Name = time() . '-' . $request->newspaper_code . '-CIRBase';
            $file_uploaded = $file->move($destinationPath, $Circulation_File_Name);
            if ($file_uploaded) {
                if ($request->cir_base == 0) {
                    $RNI_Circulation = 1;
                }
                if ($request->cir_base == 1) {
                    $CA_Circulation = 1;
                }
                if ($request->cir_base == 3) {
                    $ABC_Circulation = 1;
                }
            } else {
                $Circulation_File_Name = '';
            }
        }
        $rni_registration_no = '';
        $rni_efiling_no = '';
        $claimed_circulation = 0;
        $caregistration_no = '';
        $ca_claimed_circulation = '';
        $abc_certificate_no = '';
        $abc_claimed_circulation = '';

        $rni_reg_no_verified = 0;
        $rni_annual_valid = 0;
        $rni_claimed_circulation_verified = 0;
        $RNI_Validation_Date = '1970-01-01';

        $abc_reg_no_verified = 0;
        $abc_annual_valid = 0;
        $abc_claimed_circulation_verified = 0;
        $ABC_Validation_Date = '1970-01-01';

        if ($request->cir_base == 0) {

            $rni_reg_no_verified = $request->rni_reg_no_verified ?? 0;
            $rni_annual_valid = $request->rni_annual_valid ?? 0;
            $rni_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old && $request->date_verified_old != '1753-01-01 00:00:00.000') {
                $RNI_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $RNI_Validation_Date = $mytime->format('Y-m-d');
            }
        }

        if ($request->cir_base == 3) {

            $abc_reg_no_verified = $request->abc_reg_no_verified ?? 0;
            $abc_claimed_circulation_verified = $request->claimed_circulation_verified ?? 0;

            if ($request->cir_base == $request->cir_base_old && $request->date_verified_old != '1753-01-01 00:00:00.000') {
                $ABC_Validation_Date = date('Y-m-d', strtotime($request->date_verified_old));
            } else {
                $ABC_Validation_Date = $mytime->format('Y-m-d');
            }
        }

        $line_code = DB::select("select TOP 1 [Line No_],[Status],[NP Code] from dbo.$renewal_table where [NP Code] = '" . $request->newspaper_code . "' order by [Line No_] desc");

        if (empty($line_code)) {
            $line_no = "10000";
        } else {
            $line_no = $line_code[0]->{"Line No_"};
            $line_no = $line_no + 10000;
        }

        //Get value for Receiver ID.
        $receiver_table = '[BOC$Media Plan Setup$3f88596c-e20d-438c-a694-309eb14559b2]';
        $get_receiver_code = DB::select("select TOP 1 [Print Renewal Landing UID] from dbo.$receiver_table");
        $recervier_id = $get_receiver_code[0]->{"Print Renewal Landing UID"};


        if ($request->next_tab_2 == 1) {
            if (@$line_code[0]->{"Status"} == 6 || @$line_code[0]->{"NP Code"} == '') {
                $insert_array = array(
                    'NP Code' => $request->newspaper_code,
                    'Line No_' => $line_no,
                    'Renewal Year' => $year,
                    'Contract Start Date' => '',
                    'Contract End Date' => '',
                    'New Rate' => 0,
                    'circulation' => $request->claimed_circulation,
                    'Length' => $request->page_length,
                    'Breadth' => $request->page_width,
                    'Color' => $request->printing_colour,
                    'DM Declaration' => $dm_declaration,
                    'DMD File Name' => $dm_declaration_file_name,
                    'RNI Circulation' => $RNI_Circulation,
                    'Publisher Email' => $request->publisher_email,
                    'Publisher Mobile' => $request->publisher_mobile,
                    'Printer Email' => $request->printer_email,
                    'Printer Phone' => $request->printer_phone,
                    'Phone No' => $request->v_phone ?? '',
                    'E-mail ID' => $request->v_email,
                    'Address' => $request->v_address,
                    'Printer Name' => $request->printer_name,
                    'Printer Address' => $request->printer_address,
                    'Publisher Name' => $request->publisher_name,
                    'Publisher Address' => $request->publisher_address,
                    'No_ Of pages' => $request->colour_pages,
                    'DM Declaration Date' => $dm_declaration_date,
                    'ABC Circulation' => $ABC_Circulation,
                    'CA Circulation' => $CA_Circulation,
                    'Circulation File Name' => $Circulation_File_Name,
                    'No Dues Certificate' => $no_dues_cert,
                    'No Dues Cert File Name' => $no_dues_cert_file_name,
                    'Print Area' => $request->total_print_area,
                    'Status' => 0,
                    'Sender ID' => '',
                    'Receiver ID' => $recervier_id,
                    'Agr File Name' => '',
                    'Agr File Path' => '',
                    'Approval Document' => '',
                    'GST No_' => $request->GST_No ?? '',
                    'ABC Certificate No_' => $request->abc_certificate_no ?? '',
                    'RNI Registration No_' => $request->rni_registration_no ?? '',
                    'RNI E-filling No_' => $request->rni_efiling_no  ?? '',
                    'CIR Base' => $request->cir_base,
                    'RNI Validation Date' => $RNI_Validation_Date,
                    'RNI Registration Validation' => $rni_reg_no_verified,
                    'RNI Circulation Validation' => $rni_claimed_circulation_verified,
                    'RNI Annual Validation' => $rni_annual_valid,
                    'ABC Validation Date' => $ABC_Validation_Date,
                    'ABC Registration Validation' => $abc_reg_no_verified,
                    'ABC Circulation Validation' => $abc_claimed_circulation_verified,
                    'Application Date' => $application_date
                );
                $sql = DB::table('BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->insert($insert_array);
            } else {
                $update_array = array(
                    'Renewal Year' => $year,
                    'Contract Start Date' => '',
                    'Contract End Date' => '',
                    'New Rate' => 0,
                    'circulation' => $request->claimed_circulation,
                    'Length' => $request->page_length,
                    'Breadth' => $request->page_width,
                    'Color' => $request->printing_colour,
                    'DM Declaration' => $dm_declaration,
                    'DMD File Name' => $dm_declaration_file_name,
                    'RNI Circulation' => $RNI_Circulation,
                    'Publisher Email' => $request->publisher_email,
                    'Publisher Mobile' => $request->publisher_mobile,
                    'Printer Email' => $request->printer_email,
                    'Printer Phone' => $request->printer_phone,
                    'Phone No' => $request->v_phone ?? '',
                    'E-mail ID' => $request->v_email,
                    'Address' => $request->v_address,
                    'Printer Name' => $request->printer_name,
                    'Printer Address' => $request->printer_address,
                    'Publisher Name' => $request->publisher_name,
                    'Publisher Address' => $request->publisher_address,
                    'No_ Of pages' => $request->colour_pages,
                    'DM Declaration Date' => $dm_declaration_date,
                    'ABC Circulation' => $ABC_Circulation,
                    'CA Circulation' => $CA_Circulation,
                    'Circulation File Name' => $Circulation_File_Name,
                    'No Dues Certificate' => $no_dues_cert,
                    'No Dues Cert File Name' => $no_dues_cert_file_name,
                    'Print Area' => $request->total_print_area,
                    'Status' => 0,
                    'Sender ID' => '',
                    'Receiver ID' => 'MKRT',
                    'Agr File Name' => '',
                    'Agr File Path' => '',
                    'Approval Document' => '',
                    'GST No_' => $request->GST_No ?? '',
                    'ABC Certificate No_' => $request->abc_certificate_no ?? '',
                    'RNI Registration No_' => $request->rni_registration_no ?? '',
                    'RNI E-filling No_' => $request->rni_efiling_no  ?? '',
                    'CIR Base' => $request->cir_base,
                    'RNI Validation Date' => $RNI_Validation_Date,
                    'RNI Registration Validation' => $rni_reg_no_verified,
                    'RNI Circulation Validation' => $rni_claimed_circulation_verified,
                    'RNI Annual Validation' => $rni_annual_valid,
                    'ABC Validation Date' => $ABC_Validation_Date,
                    'ABC Registration Validation' => $abc_reg_no_verified,
                    'ABC Circulation Validation' => $abc_claimed_circulation_verified,
                    'Application Date' => $application_date
                );
                $where = array('NP Code' => $request->newspaper_code, 'Line No_' => $line_code[0]->{"Line No_"}, 'Status' => 0);
                $sql = DB::table('BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update($update_array);
            }
        } else if ($request->submit_btn == 1) {
            $update_array = array(
                'DM Declaration' => $dm_declaration,
                'DMD File Name' => $dm_declaration_file_name,
                'RNI Circulation' => $RNI_Circulation,
                'ABC Circulation' => $ABC_Circulation,
                'CA Circulation' => $CA_Circulation,
                'Circulation File Name' => $Circulation_File_Name,
                'No Dues Certificate' => $no_dues_cert,
                'No Dues Cert File Name' => $no_dues_cert_file_name,
                'Status' => 1
            );
            $where = array('NP Code' => $request->newspaper_code, 'Line No_' => $line_code[0]->{"Line No_"}, 'Status' => 0);
            $sql = DB::table('BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2')->where($where)->update($update_array);
        }
        if ($sql) {
            return $this->sendResponse($request->newspaper_code, 'Data Save Successfully! Please note the ' . $request->newspaper_code . ' reference number for future use.');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }

    public function checkUniqueEmailVendor($email, $np_code)
    {
        $response = DB::table('BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2')
            ->select('E-mail ID')
            ->where([['E-mail ID', '=', $email], ['NP Code', '!=', $np_code]])
            ->get();
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function checkGSTNo(Request $request)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $owner_id = DB::table($table)->select('Owner ID')->where('User ID', Session::get('id'))->first();
        if (!empty($owner_id)) {
            $where = array(['GST No_', '=', $request->gst_no], ['Owner ID', '!=', $owner_id->{'Owner ID'}]);
        } else {
            $where = array('GST No_' => $request->gst_no);
        }

        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'GST No_', '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }
    public function checkRenewalGSTNo($gst_no, $ownerid)
    {
        $table = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
        $Vendor_Codes = DB::table($table)->select('Newspaper Code')->where('Owner ID', $ownerid)->get()->toArray();
        $np_array = [];
        foreach ($Vendor_Codes as $Vendor_Code) {
            $np_array[] = $Vendor_Code->{'Newspaper Code'};
        }
        //  dd($np_array);
        $response = DB::table('BOC$NP Rate Renewal$3f88596c-e20d-438c-a694-309eb14559b2')
            ->select('GST No_')
            ->where('GST No_', $gst_no)
            ->whereNotIn('NP Code', $np_array)
            ->get();
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
            exit;
        }
    }

    public function checkRegistrationNo($cir_no, $reg_no)
    {
        $table = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = '';
        if ($cir_no == 0) {
            $where = array('RNI Registration No_' => $reg_no);
        }
        if ($cir_no == 3) {
            $where = array('ABC Number' => $reg_no);
        }
        //dd($reg_no);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'Newspaper Code', '', '', $where);
        // $response = DB::select("select * from $table where [ABC Number] = '" . $reg_no . "'");
        // dd($response);
        if (count($response) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function accountDetail($table = '', $select = '', $where = '')
    {
        $response = ApiFreshEmpanelment::fetchAllRecords($table, $select, '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
        }
    }

    public function accountDetailSave(Request $request)
    {

        if (Session::has('UserName') && Session('UserName') != '') {
            $table = 'BOC$Main Newspaper Master$3f88596c-e20d-438c-a694-309eb14559b2';
            $where = array('Newspaper Code' => Session('UserName'));
            $owner_id = ApiFreshEmpanelment::fetchAllRecords($table, 'Owner ID', '', '', $where);
        } else {
            $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
            $where = array('User ID' => Session('id'));
            $owner_id = ApiFreshEmpanelment::fetchAllRecords($table, 'Owner ID', '', '', $where);
        }

        // account information variable
        $request->bank_account_no = $request->bank_account_no ?? '';
        $request->account_holder_name = $request->account_holder_name ?? '';
        $request->address_of_account = $request->address_of_account ?? '';
        $request->ifsc_code = $request->ifsc_code ?? '';
        $request->bank_name = $request->bank_name ?? '';
        $request->branch_name = $request->branch_name ?? '';
        $request->pan_card = $request->pan_card ?? '';
        $request->ESI_account_no = $request->ESI_account_no ?? '';
        $request->ESI_no_employees = $request->ESI_no_employees ?? 0;
        $request->EPF_account_no = $request->EPF_account_no ?? '';
        $request->EPF_no_of_employees = $request->EPF_no_of_employees ?? 0;
        $request->account_type = $request->account_type ?? '';
        $update = array(
            'Bank Account No_' => $request->bank_account_no,
            'Account Holder Name' => $request->account_holder_name,
            'Account Address' => $request->address_of_account,
            'IFSC Code' => $request->ifsc_code,
            'Bank Name' => $request->bank_name,
            'Branch' => $request->branch_name,
            'ESI Account No' => $request->ESI_account_no,
            'No_of Employees covered' => $request->ESI_no_employees,
            'EPF Account No_' => $request->EPF_account_no,
            'No_ of EPF Employees covered' => $request->EPF_no_of_employees,
            'PAN' => $request->pan_card,
            'Account Type' => $request->account_type
        );
        // dd($where);
        $sql = ApiFreshEmpanelment::updateAllRecords($table, $update, $where);

        if ($sql) {
            $where = array('Owner ID' => $owner_id[0]->{'Owner ID'});
            $email_id = ApiFreshEmpanelment::fetchAllRecords('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2', 'Email ID', '', '', $where);
            if (!empty($email_id)) {
                $details = [
                    'subject' => 'Account Information changed',
                    'body' => 'Your account information has been changed. If you have not changed your account information then please contact administrator.'
                ];
                // $res = $this->mailSend($details, $email_id[0]->{'Email ID'});
            }
            return $this->sendResponse('', 'Data Updated Successfully!');
        } else {
            return $this->sendError('Some Error Occurred!.');
            exit;
        }
    }

    public function isPrimaryEdition($owner_id)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('Owner ID' => $owner_id, 'Primary Edition' => 1);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'Newspaper Name', '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
        }
    }

    public function dateOfFirstPublication($owner_id)
    {
        $table = 'BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
        $where = array('Owner ID' => $owner_id);
        $response = ApiFreshEmpanelment::fetchAllRecords($table, 'Date Of First Publication', '', '', $where);
        if (count($response) > 0) {
            return $this->sendResponse($response, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
        }
    }
    public function printPDFData($np_code)
    {
        $vendor_details = DB::table('BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2 as bvp')
            ->join('BOC$Language$63ca2fa4-4f03-4f2b-a480-172fef340d3f as bl', 'bl.Code', '=', 'bvp.Language')
            ->join('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c as st', 'st.Code', '=', 'bvp.State')
            ->select('bvp.*', 'st.Description as state_name','bl.Code','bl.Name as lang_name', 'st.Code as state_code','bvp.Language')
            ->Where('bvp.Newspaper Code', [$np_code])
            ->get();
            ($vendor_details);
        $owner_details = DB::table('BOC$Owner$3f88596c-e20d-438c-a694-309eb14559b2 as own')
            ->join('BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c as st', 'st.Code', '=', 'own.State')
            ->select('own.Owner ID', 'own.Owner Name', 'own.Owner Type', 'own.Mobile No_', 'own.Email ID', 'own.Phone No_', 'own.Fax No_', 'own.Address 1', 'own.City', 'own.District', 'st.Description as state_name', 'st.Code as state_code')
            ->Where('own.Owner ID', [@$vendor_details[0]->{'Owner ID'}])
            ->get();
        if (count($owner_details) > 0 || count($vendor_details) > 0) {
            $data = array('owner_details' => $owner_details[0], 'vendor_details' => $vendor_details[0]);
            unset($vendor_details[0]->timestamp);
            return $this->sendResponse($data, 'Data retrieved successfully');
        } else {
            return $this->sendError('Data not found!.');
        }
    }
}
