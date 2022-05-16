<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>AVTV Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }

    </style>
</head>
@php

@endphp
<body>
    <table width="100%" border="1" style="border-collapse: collapse;" cellspacing="0" cellpadding="5" class="tree">
        <tr>
            <td align="center"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                <p><strong>GOVERNMENT OF INDIA <br />
                        BUREAU OF OUTREACH & COMMUNICATION<br />
                        Ministry of Information & Broadcasting</strong><br />
                    Phase IV, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                </p>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Basic Information</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Profile Photo</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>
                            <div style="width:180px; height:220px; border:solid 1px #000;"></div>
                        </td>
                    </tr>
                    <tr>
                     
                        <td width="35%"><strong>Owner Name</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{$OD_owners->{'Owner Name'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Id </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Email ID'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Mobile No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Phone No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($OD_owners->{'State'} !=''){{$Owner_State ?? ''}}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'District'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'City'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $OD_owners->{'Address 1'} ?? ''}}</td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                 <h3 style="text-align: center; color: #fff;"><strong>AVTV Information :-</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Name of parent Company/Group</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Parent Company Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Channel Name </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Channel Name'} ?? ''}}</td>
                    </tr>
                    @php 
                        $Uplinking_Validity_Date =substr(@$Chanal_Details->{'Uplinking Validity Date'}, 0,10);
                        $U_V_D ='';
                        if($Uplinking_Validity_Date != '1970-01-01'){
                          $U_V_D  = $Uplinking_Validity_Date;
                          }else{
                          $U_V_D  ='';
                          }
                        @endphp
                    <tr>
                        <td><strong>Uplinking valid upto </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$U_V_D  ?? ''}}</td>
                    </tr>
                    @php 
                        $Downlinking_Validity_Date =substr(@$Chanal_Details->{'Downlinking Validity Date'}, 0,10);
                        $D_V_D ='';
                        if($Downlinking_Validity_Date != '1970-01-01'){
                          $D_V_D  = $Downlinking_Validity_Date;
                          }else{
                          $D_V_D  ='';
                          }
                        @endphp
                    <tr>
                        <td><strong>Down-linking valid upto </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{  $D_V_D  ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>EMMC license no.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'EMMC License No_'} ?? '' }}</td>
                    </tr>

                    @php 
                        $EMMC_Date =substr(@$Chanal_Details->{'EMMC Date'}, 0,10);
                        $EM_DA ='';
                        if($EMMC_Date != '1970-01-01'){
                          $EM_DA  = $EMMC_Date;
                          }else{
                          $EM_DA  ='';
                          }
                      @endphp
                    <tr>
                        <td><strong>EMMC Date </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $EM_DA ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Regional/Language of classification (in case of regional channel)</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($Chanal_Details->{'Regional_Language Type'}){{ $getlang ?? ''}}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>Legal status of company</strong></td>
                        <td><strong>:</strong></td>
                        @php
                            $legal ='';
                            if($Chanal_Details->{'Company Legal Status'} == 1){
                                $legal ='Pvt';
                            }elseif($Chanal_Details->{'Company Legal Status'} == 2) {
                                $legal ='Ltd';
                            }elseif($Chanal_Details->{'Company Legal Status'} == 3){
                                $legal ='Others';
                            }else{
                                $legal ='';
                            }
                            
                            @endphp
                        <td>{{  $legal ?? '' }}</td>
                    </tr>
                    <tr>
                        <td width="35%"><strong>Director/CEO/Head of Company /Channel</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Channel Director_CEO'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Launch of month </strong></td>
                        <td><strong>:</strong></td>
                        @php 
                        $months ='';
                        if($Chanal_Details->{'Launch Month'} == 1){$months ='January';}
                        elseif($Chanal_Details->{'Launch Month'} == 2){$months ='February';}
                        elseif($Chanal_Details->{'Launch Month'} == 3){$months ='March';}
                        elseif($Chanal_Details->{'Launch Month'} == 4){$months ='April';}
                        elseif($Chanal_Details->{'Launch Month'} == 5){$months ='May';}
                        elseif($Chanal_Details->{'Launch Month'} == 6){$months ='June';}
                        elseif($Chanal_Details->{'Launch Month'} == 7){$months ='July';}
                        elseif($Chanal_Details->{'Launch Month'} == 8){$months ='August';}
                        elseif($Chanal_Details->{'Launch Month'} == 9){$months ='September';}
                        elseif($Chanal_Details->{'Launch Month'} == 10){$months ='October';}
                        elseif($Chanal_Details->{'Launch Month'} == 11){$months ='November';}
                        elseif($Chanal_Details->{'Launch Month'} == 12){$months ='December';}
                        else{$months ='';}
                        @endphp
                        <td>{{ $months ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Launch of year </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Launch Year'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Genre of channel </strong></td>
                        <td><strong>:</strong></td>
                        @php
                        $Genre ='';
                        if($Chanal_Details->{'Channel Genre'} == 1){
                           $Genre ='NON-GEC';
                        }else{
                            $Genre ='GEC';
                        }
                        @endphp
                        <td>{{ $Genre ?? ''}}</td>
                    </tr>
                    <tr>
                    @php 
                        $Strimg_start =substr(@$Chanal_Details->{'Streaming Start Date'}, 0,10);
                        $streaming ='';
                        if($Strimg_start != '1970-01-01'){
                          $streaming  = $Strimg_start;
                          }else{
                          $streaming  ='';
                          }
                      @endphp
                        <td><strong>Streaming Start Date</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $streaming ?? '' }}</td>
                    </tr>
                        </table>
                </td>  
            </tr>  
                    <tr>
                    <td style="background:#f2f2f2;" colspan="3">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Delhi Office:-</strong></h4>
                        </td>
                    </tr>
            <tr>
                <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State </strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($Chanal_Details->{'DO State'} != ''){{ $DO_State ?? '' }}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>District </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO District'} }}</td>
                    </tr>
 
                        <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO City'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Landline No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DO Landline No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr>
                </table>
            </td>
        </tr>
                        <tr>
                    <td style="background:#f2f2f2;" colspan="3">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Head Office:-</strong></h4>
                        </td>
                    </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($Chanal_Details->{'HO State'} !=''){{$HO_State ?? '' }}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO District'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO City'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Landline No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'HO Landline No_(with STD)'} ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Account Details</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Bank account number for receiving payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank A_C Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Account Holder
                                Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Chanal_Details->{'A_C Holder Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'IFSC Code'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank Branch'} ?? '' }}</< /td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Bank A_C Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'PAN'} ?? ''}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #f2f2f2;" colspan="3">
                <h3 style="text-align: center; color:#000; font-size:17px;"><strong>ESI Account Details</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'ESI A_C No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$Chanal_Details->{'ESI - No_ Of Employee'} !=0 ? @$Chanal_Details->{'ESI - No_ Of Employee'} : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #f2f2f2;" colspan="3">
                <h3 style="text-align: center; color:#000; font-size:17px;"><strong>EPF Account Details</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'EPF A_C No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$Chanal_Details->{'EPF - No_ Of Employee'} !=0 ? @$Chanal_Details->{'EPF - No_ Of Employee'} : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Upload Document</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Uplinking & Down-linking certificate of the channel</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Linking Certificate File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>EMMC certificate telecasting over the last 6 months </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'EMMC File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Fixed point chart (FPC) for the previous 6 months from 6AM to 11PM,  during which the channel operated</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Chanal_Details->{'FP Chart File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Scan copy of cancelled cheque</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Chanal_Details->{'Cancelled Cheque File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Teleport operator certificatee</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'TOC File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Last year's certificate duly signed by the Auditor</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'Auditor File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A letter attested by Senior Management Level Executive,Giving Name, Designation &  Signatures</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'SMA File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A letter indicating whether or not the channel would be able to provide a third party certification of the Advertisement telecast for DAVP/ Government of India.</strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'TPC File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A signed list of the different C&S. TV Channel in the Group/Holding Company/ Company to which the applicant channel belongs to </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Chanal_Details->{'DC&SL File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>
</body>

</html>