<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pvt. FM Application Receipt</title>
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
                        <td>@if( $OD_owners->{'State'} !=''){{ $Owner_State ?? ''}}@endif</td>
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
                        <td>{{ $OD_owners->{'City'} ?? ''}}</td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                 <h3 style="text-align: center; color: #fff;"><strong>Pvt. FM Information :-</strong></h3>
            </td>
        </tr>
      
           
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>FM station name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'FM Station Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Broadcast City </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Broadcast City'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Group belong to</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Media Group'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Language of broadcast</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if($FMdata->{'Language'} !=''){{$getlang ?? '' }}@endif</td>
                    </tr>
                </table>
            </td> 
        </tr>   
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                <!-----Start Time Band--------->
                <tr style="padding-top:100px;"></tr>
                <tr>
                        <td><strong> Week Days : <strong></td>
                        <td colspan="2">Time Band 1</td>
                        <td colspan="2">Time Band 2</td>
                        <td colspan="2">Time Band 3</td>
                    </tr>
                    <tr>
                        <td><strong>Monday :</strong></td>
                       @php
                        $Mon_TB1_From =substr(@$Time_band->{'Mon TB1 From'}, 11,8);
                        $m_tb1_f ='';
                        if($Mon_TB1_From != '00:00:00.000'){
                            $m_tb1_f = $Mon_TB1_From;
                            }else{
                            $m_tb1_f ='';
                            }

                        @endphp
                        <td>{{ $m_tb1_f ?? ''}}</td>
                        @php
                        $Mon_TB1_To =substr(@$Time_band->{'Mon TB1 To'}, 11,8);
                        $m_tb1_t ='';
                        if($Mon_TB1_To != '00:00:00.000'){
                            $m_tb1_t = $Mon_TB1_To;
                            }else{
                            $m_tb1_t ='';
                            }

                        @endphp
                        <td>{{$m_tb1_t ?? ''}}</td>
                        @php
                            $Mon_TB2_From =substr(@$Time_band->{'Mon TB2 From'}, 11,8);
                            $m_tb2_f ='';
                            if($Mon_TB2_From != '00:00:00.000'){
                                $m_tb2_f = $Mon_TB2_From;
                                }else{
                                $m_tb2_f ='';
                                }
                            @endphp
                        <td>{{ $m_tb2_f ?? ''}}</td>
                        @php
                        $Mon_TB2_To =substr(@$Time_band->{'Mon TB2 To'}, 11,8);
                        $m_tb2_t ='';
                        if($Mon_TB2_From != '00:00:00.000'){
                            $m_tb2_t = $Mon_TB2_To;
                            }else{
                            $m_tb2_t ='';
                            }

                        @endphp
                        <td>{{ $m_tb2_t ?? ''}}</td>
                        @php
                        $Mon_TB3_From =substr(@$Time_band->{'Mon TB3 From'}, 11,8);
                        $m_tb3_f ='';
                        if($Mon_TB3_From != '00:00:00.000'){
                            $m_tb3_f = $Mon_TB3_From;
                            }else{
                            $m_tb3_f ='';
                            }

                        @endphp
                        <td>{{ $m_tb3_f ?? ''}}</td>
                        @php
                        $Mon_TB3_To =substr(@$Time_band->{'Mon TB3 To'}, 11,8);
                        $m_tb3_t ='';
                        if($Mon_TB3_To != '00:00:00.000'){
                            $m_tb3_t = $Mon_TB3_To;
                            }else{
                            $m_tb3_t ='';
                            }

                        @endphp
                        <td>{{$m_tb3_t ?? ''}}</td>
                    </tr>
                    <!---Tuesday time band -->
                    <tr>
                        <td><strong>Tuesday :</strong></td>
                        @php
                        $Tue_TB1_From =substr(@$Time_band->{'Tue TB1 From'}, 11,8);
                        $t_tb1_f ='';
                        if($Tue_TB1_From != '00:00:00.000'){
                            $t_tb1_f = $Tue_TB1_From;
                            }else{
                            $t_tb1_f ='';
                            }

                        @endphp
                        <td>{{ $t_tb1_f ?? ''}}</td>

                        @php
                        $Tue_TB1_To =substr(@$Time_band->{'Tue TB1 To'}, 11,8);
                        $t_tb1_t ='';
                        if($Tue_TB1_To != '00:00:00.000'){
                            $t_tb1_t = $Tue_TB1_To;
                            }else{
                            $t_tb1_t ='';
                            }
                        @endphp
                        <td>{{$Tue_TB1_To ?? ''}}</td>
                        @php
                            $Tue_TB2_From =substr(@$Time_band->{'Tue TB2 From'}, 11,8);
                            $t_tb2_f ='';
                            if($Tue_TB2_From != '00:00:00.000'){
                                $t_tb2_f = $Tue_TB2_From;
                                }else{
                                $t_tb2_f ='';
                                }

                            @endphp
                        <td>{{$t_tb2_f ?? ''}}</td>
                        @php
                        $Tue_TB2_To =substr(@$Time_band->{'Tue TB2 To'}, 11,8);
                        $t_tb2_t ='';
                        if($Tue_TB2_To != '00:00:00.000'){
                            $t_tb2_t = $Tue_TB2_To;
                            }else{
                            $t_tb2_t ='';
                            }

                        @endphp
                        <td>{{$t_tb2_t ?? ''}}</td>
                        @php
                        $Tue_TB3_From =substr(@$Time_band->{'Tue TB3 From'}, 11,8);
                        $t_tb3_f ='';
                        if($Tue_TB3_From != '00:00:00.000'){
                            $t_tb3_f = $Tue_TB3_From;
                            }else{
                            $t_tb3_f ='';
                            }

                        @endphp
                        <td>{{ $t_tb3_f ?? ''}}</td>
                        @php
                        $Tue_TB3_To =substr(@$Time_band->{'Tue TB3 To'}, 11,8);
                        $t_tb3_t ='';
                        if($Tue_TB3_To != '00:00:00.000'){
                            $t_tb3_t = $Tue_TB3_To;
                            }else{
                            $t_tb3_t ='';
                            }

                        @endphp
                        <td>{{$t_tb3_t ?? ''}}</td>
                    </tr>
                   
                     <!-- Wednesday time band -->
                    <tr>
                        <td><strong>Wednesday :</strong></td>
                        @php
                        $Wed_TB1_From =substr(@$Time_band->{'Wed TB1 From'}, 11,8);
                        $w_tb1_f ='';
                        if($Wed_TB1_From != '00:00:00.000'){
                            $w_tb1_f = $Wed_TB1_From;
                            }else{
                            $w_tb1_f ='';
                            }

                        @endphp
                        <td>{{ $w_tb1_f ?? ''}}</td>
                        @php
                        $Wed_TB1_To =substr(@$Time_band->{'Wed TB1 To'}, 11,8);
                        $w_tb1_t ='';
                        if($Wed_TB1_To != '00:00:00.000'){
                            $w_tb1_t = $Wed_TB1_To;
                            }else{
                            $w_tb1_t ='';
                            }

                        @endphp
                        <td>{{$w_tb1_t ?? ''}}</td>
                        @php
                        $Wed_TB2_From =substr(@$Time_band->{'Wed TB2 From'}, 11,8);
                        $w_tb2_f ='';
                        if($Wed_TB2_From != '00:00:00.000'){
                            $w_tb2_f = $Wed_TB2_From;
                            }else{
                            $w_tb2_f ='';
                            }

                        @endphp
                        <td>{{$w_tb2_f ?? ''}}</td>
                        @php
                        $Wed_TB2_To =substr(@$Time_band->{'Wed TB2 To'}, 11,8);
                        $w_tb2_t ='';
                        if($Wed_TB2_To != '00:00:00.000'){
                            $w_tb2_t = $Wed_TB2_To;
                            }else{
                            $w_tb2_t ='';
                            }

                        @endphp
                        <td>{{$w_tb2_t ?? ''}}</td>
                        @php
                        $Wed_TB3_From =substr(@$Time_band->{'Wed TB3 From'}, 11,8);
                        $w_tb3_f ='';
                        if($Wed_TB3_From != '00:00:00.000'){
                            $w_tb3_f = $Wed_TB3_From;
                            }else{
                            $w_tb3_f ='';
                            }
                        @endphp
                        <td>{{ $w_tb3_f ?? ''}}</td>
                        @php
                        $Wed_TB3_To =substr(@$Time_band->{'Wed TB3 To'}, 11,8);
                        $w_tb3_t ='';
                        if($Wed_TB3_To != '00:00:00.000'){
                            $w_tb3_t = $Wed_TB3_To;
                            }else{
                            $w_tb3_t ='';
                            }
                        @endphp
                        <td>{{$w_tb3_t ?? ''}}</td>
                    </tr>
                     <!------- Thursday ------->
                     <tr>
                        <td><strong>Thursday :</strong></td>
                        @php
                            $Thur_TB1_From =substr(@$Time_band->{'Thur TB1 From'}, 11,8);
                            $thur_tb1_f ='';
                            if($Thur_TB1_From != '00:00:00.000'){
                                $thur_tb1_f = $Thur_TB1_From;
                                }else{
                                $thur_tb1_f ='';
                                }
                            @endphp
                        <td>{{  $thur_tb1_f ?? ''}}</td>
                        @php
                        $Thur_TB1_From =substr(@$Time_band->{'Thur TB1 To'}, 11,8);
                        $thur_tb1_t ='';
                        if($Thur_TB1_From != '00:00:00.000'){
                            $thur_tb1_t = $Thur_TB1_From;
                            }else{
                            $thur_tb1_t ='';
                            }
                        @endphp
                        <td>{{$thur_tb1_t ?? ''}}</td>
                        @php
                        $Thur_TB2_From =substr(@$Time_band->{'Thur TB2 From'}, 11,8);
                        $thur_tb2_f ='';
                        if($Thur_TB2_From != '00:00:00.000'){
                            $thur_tb2_f = $Thur_TB2_From;
                            }else{
                            $thur_tb2_f ='';
                            }
                        @endphp
                        <td>{{ $thur_tb2_f ?? ''}}</td>
                        @php
                        $Thur_TB2_To =substr(@$Time_band->{'Thur TB2 To'}, 11,8);
                        $thur_tb2_t ='';
                        if($Thur_TB2_To != '00:00:00.000'){
                            $thur_tb2_t = $Thur_TB2_To;
                            }else{
                            $thur_tb2_t ='';
                            }
                        @endphp
                        <td>{{$thur_tb2_t ?? ''}}</td>
                        @php
                        $Thur_TB3_From =substr(@$Time_band->{'Thur TB3 From'}, 11,8);
                        $thur_tb3_f ='';
                        if($Thur_TB3_From != '00:00:00.000'){
                            $thur_tb3_f = $Thur_TB3_From;
                            }else{
                            $thur_tb3_f ='';
                            }
                        @endphp
                        <td>{{ $thur_tb3_f ?? ''}}</td>
                        @php
                        $Thur_TB3_To =substr(@$Time_band->{'Thur TB3 To'}, 11,8);
                        $thur_tb3_t ='';
                        if($Thur_TB3_To != '00:00:00.000'){
                            $thur_tb3_t = $Thur_TB3_To;
                            }else{
                            $thur_tb3_t ='';
                            }
                        @endphp
                        <td>{{$thur_tb3_t ?? ''}}</td>
                    </tr>
                    <!---Friday--->
                    <tr>
                        <td><strong>Friday :</strong></td>
                        @php
                            $Fri_TB1_From =substr(@$Time_band->{'Fri TB1 From'}, 11,8);
                            $fri_tb1_f ='';
                            if($Fri_TB1_From != '00:00:00.000'){
                                $fri_tb1_f = $Fri_TB1_From;
                                }else{
                                $fri_tb1_f ='';
                                }
                            @endphp
                        <td>{{ $fri_tb1_f ?? ''}}</td>
                        @php
                            $Fri_TB1_To =substr(@$Time_band->{'Fri TB1 To'}, 11,8);
                            $fri_tb1_t ='';
                            if($Fri_TB1_To != '00:00:00.000'){
                                $fri_tb1_t = $Fri_TB1_To;
                                }else{
                                $fri_tb1_t ='';
                                }
                            @endphp
                        <td>{{ $fri_tb1_t ?? ''}}</td>
                        @php
                        $Fri_TB2_From =substr(@$Time_band->{'Fri TB2 From'}, 11,8);
                        $fri_tb2_f ='';
                        if($Fri_TB2_From != '00:00:00.000'){
                            $fri_tb2_f = $Fri_TB2_From;
                            }else{
                            $fri_tb2_f ='';
                            }
                        @endphp
                        <td>{{ $fri_tb2_f ?? ''}}</td>
                        @php
                        $Fri_TB2_To =substr(@$Time_band->{'Fri TB2 To'}, 11,8);
                        $fri_tb2_t ='';
                        if($Fri_TB2_To != '00:00:00.000'){
                            $fri_tb2_t = $Fri_TB2_To;
                            }else{
                            $fri_tb2_t ='';
                            }
                        @endphp
                        <td>{{$fri_tb2_t ?? ''}}</td>
                        @php
                        $Fri_TB3_From =substr(@$Time_band->{'Fri TB3 From'}, 11,8);
                        $fri_tb3_f ='';
                        if($Fri_TB3_From != '00:00:00.000'){
                            $fri_tb3_f = $Fri_TB3_From;
                            }else{
                            $fri_tb3_f ='';
                            }
                        @endphp
                        <td>{{ $fri_tb3_f ?? ''}}</td>
                        @php
                        $Fri_TB3_To =substr(@$Time_band->{'Fri TB3 To'}, 11,8);
                        $fri_tb3_t ='';
                        if($Fri_TB3_To != '00:00:00.000'){
                            $fri_tb3_t = $Fri_TB3_To;
                            }else{
                            $fri_tb3_t ='';
                            }
                        @endphp
                        <td>{{$fri_tb3_t ?? ''}}</td>
                    </tr>
                    <!------Saturday----->
                    <tr>
                        <td><strong>Saturday :</strong></td>
                        @php
                        $Sat_TB1_From =substr(@$Time_band->{'Sat TB1 From'}, 11,8);
                        $sat_tb1_f ='';
                        if($Sat_TB1_From != '00:00:00.000'){
                            $sat_tb1_f = $Sat_TB1_From;
                            }else{
                            $sat_tb1_f ='';
                            }
                        @endphp
                        <td>{{ $sat_tb1_f ?? ''}}</td>
                        @php
                        $Sat_TB1_To =substr(@$Time_band->{'Sat TB1 To'}, 11,8);
                        $sat_tb1_t ='';
                        if($Sat_TB1_To != '00:00:00.000'){
                            $sat_tb1_t = $Sat_TB1_To;
                            }else{
                            $sat_tb1_t ='';
                            }
                        @endphp
                        <td>{{$sat_tb1_t  ?? ''}}</td>
                        @php
                            $Sat_TB2_From =substr(@$Time_band->{'Sat TB2 From'}, 11,8);
                            $sat_tb2_f ='';
                            if($Sat_TB2_From != '00:00:00.000'){
                                $sat_tb2_f = $Sat_TB2_From;
                                }else{
                                $sat_tb2_f ='';
                                }
                            @endphp
                        <td>{{ $sat_tb2_f ?? ''}}</td>
                        @php
                            $Sat_TB2_To =substr(@$Time_band->{'Sat TB2 To'}, 11,8);
                            $sat_tb2_t ='';
                            if($Sat_TB2_To != '00:00:00.000'){
                                $sat_tb2_t = $Sat_TB2_To;
                                }else{
                                $sat_tb2_t ='';
                                }
                            @endphp
                        <td>{{ $sat_tb2_t ?? ''}}</td>
                        @php
                        $Sat_TB3_From =substr(@$Time_band->{'Sat TB3 From'}, 11,8);
                        $sat_tb3_f ='';
                        if($Sat_TB3_From != '00:00:00.000'){
                            $sat_tb3_f = $Sat_TB3_From;
                            }else{
                            $sat_tb3_f ='';
                            }
                        @endphp
                        <td>{{ $sat_tb3_f ?? ''}}</td>
                        @php
                        $Sat_TB3_To =substr(@$Time_band->{'Sat TB3 To'}, 11,8);
                        $sat_tb3_t ='';
                        if($Sat_TB3_To != '00:00:00.000'){
                            $sat_tb3_t = $Sat_TB3_To;
                            }else{
                            $sat_tb3_t ='';
                            }
                        @endphp
                        <td>{{$sat_tb3_t ?? ''}}</td>
                    </tr>
                    <!------sunday-------->
                    <tr>
                        <td><strong>Sunday :</strong></td>
                        @php
                        $Sun_TB1_From =substr(@$Time_band->{'Sun TB1 From'}, 11,8);
                        $sun_tb1_f ='';
                        if($Sun_TB1_From != '00:00:00.000'){
                            $sun_tb1_f = $Sun_TB1_From;
                            }else{
                            $sun_tb1_f ='';
                            }
                        @endphp
                        <td>{{$sun_tb1_f ?? ''}}</td>
                        @php
                        $Sun_TB1_To =substr(@$Time_band->{'Sun TB1 To'}, 11,8);
                        $sun_tb1_t ='';
                        if($Sun_TB1_To != '00:00:00.000'){
                            $sun_tb1_t = $Sun_TB1_To;
                            }else{
                            $sun_tb1_t ='';
                            }
                        @endphp
                        <td>{{$sun_tb1_t  ?? ''}}</td>
                        @php
                        $Sun_TB2_From =substr(@$Time_band->{'Sun TB2 From'}, 11,8);
                        $sun_tb2_f ='';
                        if($Sun_TB2_From != '00:00:00.000'){
                            $sun_tb2_f = $Sun_TB2_From;
                            }else{
                            $sun_tb2_f ='';
                            }
                        @endphp
                        <td>{{$sun_tb2_f ?? ''}}</td>
                        @php
                        $Sun_TB2_To =substr(@$Time_band->{'Sun TB2 To'}, 11,8);
                        $sun_tb2_t ='';
                        if($Sun_TB2_To != '00:00:00.000'){
                            $sun_tb2_t = $Sun_TB2_To;
                            }else{
                            $sun_tb2_t ='';
                            }
                        @endphp
                        <td>{{$sun_tb2_t ?? ''}}</td>
                        @php
                        $Sun_TB3_From =substr(@$Time_band->{'Sun TB3 From'}, 11,8);
                        $sun_tb3_f ='';
                        if($Sun_TB3_From != '00:00:00.000'){
                            $sun_tb3_f = $Sun_TB3_From;
                            }else{
                            $sun_tb3_f ='';
                            }
                        @endphp
                        <td>{{$sun_tb3_f ?? ''}}</td>
                        @php
                        $Sun_TB3_To =substr(@$Time_band->{'Sun TB3 To'}, 11,8);
                        $sun_tb3_t ='';
                        if($Sun_TB3_To != '00:00:00.000'){
                            $sun_tb3_t = $Sun_TB3_To;
                            }else{
                            $sun_tb3_t ='';
                            }
                        @endphp
                        <td>{{ $sun_tb3_t ?? ''}}</td>
                         <br >
                    </tr>
                   
            
                    </table>
                </td>
            </tr>
                <!-----End Time Band--------->
                            
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    @php
                    $GOPA_Validity_Date =substr(@$FMdata->{'GOPA Validity Date'}, 0,10);
                    $gopa_v_d ='';
                    if($GOPA_Validity_Date != '1970-01-01'){
                        $gopa_v_d = $GOPA_Validity_Date;
                        }else{
                        $gopa_v_d ='';
                        }
                        
                    @endphp
                    <tr>
                        <td><strong>GOPA valid upto </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="7">{{  $gopa_v_d ?? ''}}</td>
                    </tr>
                    @php
                    $WOL_Validity_Date =substr(@$FMdata->{'WOL Validity Date'},0,10);
                    $WOL_v_d ='';
                    if($WOL_Validity_Date != '1970-01-01'){
                    $WOL_v_d = $WOL_Validity_Date;
                    }else{
                    $WOL_v_d ='';

                    }
                    @endphp
                    <tr>
                        <td><strong>WOL valid upto</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="7">{{ $WOL_v_d ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Legal status of company</strong></td>
                        <td><strong>:</strong></td>
                        @php
                            $legal ='';
                            if($FMdata->{'Company Legal Status'} == 1){
                                $legal ='Pvt';
                            }elseif($FMdata->{'Company Legal Status'} == 2) {
                                $legal ='Ltd';
                            }elseif($FMdata->{'Company Legal Status'} == 3){
                                $legal ='Others';
                            }else{
                                $legal ='';
                            }
                            
                            @endphp
                        <td colspan="7">{{$legal ?? ''}}</td>
                    </tr>
                    @php 
                    $Commercial_Launch_Date =substr(@$FMdata->{'WOL Validity Date'}, 0,10);
                    $Comm_v_d ='';
                    if($Commercial_Launch_Date != '1970-01-01'){
                    $Comm_v_d = $Commercial_Launch_Date;
                    }else{
                    $Comm_v_d ='';
                    }
                    @endphp
                    <tr>
                        <td><strong>Pvt. FM commercial launch date</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="7">{{ $Comm_v_d ?? ''}}</td>
                    </tr>

                </table>
                </td>
                </tr>    
                    <!-- <tr>
                    <td style="background:#f2f2f2;" colspan="7">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Delhi office address:-</strong></h4>
                        </td>
                    </tr> -->
                     <tr>
                    <th style="background:#f2f2f2;" colspan="7">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Operating address of Pvt. FM station:-</strong></h4>
                        </th>
                    </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'DO Contact Name'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'DO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'DO Designation'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Landline No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'DO Landline No_(with STD)'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'DO Mobile No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Email Id</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'DO E-Mail                                                                    '} ?? '' }}</td>
                    </tr>
                </table>
                </td>
                </tr>

                    <tr>
                    <th style="background:#f2f2f2;" colspan="7">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Operating address of Pvt. FM station:-</strong></h4>
                        </th>
                    </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'OP Contact Name'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'OP Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'OP Designation'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Landline No. </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'OP Landline No_(with STD)'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'OP Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'OP E-Mail'} ?? '' }}</td>
                    </tr>
                    <tr>
                </table>
                </td>
                </tr>      
                    <th style="background:#f2f2f2;" colspan="7">
                            <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Address of head office:-</strong></h4>
                        </th>
                    </tr>
                    <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="7">
                    <tr>
                        <td><strong>Contact Name</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'HO Contact Name'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'HO Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Designation</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'HO Designation'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Landline No. </strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'HO Landline No_(with STD)'} }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'HO Mobile No_'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="5">{{ $FMdata->{'HO E-Mail'} ?? '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Account Details</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>Bank account number for receiving payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Bank A_C Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Account Holder
                                Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$FMdata->{'A_C Holder Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'IFSC Code'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Bank Name'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Bank Branch'} ?? '' }}</< /td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Bank A_C Address'} ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'PAN'} ?? ''}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #f2f2f2;" colspan="3">
                <h3 style="text-align: center; color:#000; font-size:17px;"><strong>ESI Account Details</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'ESI A_C No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$FMdata->{'ESI - No_ Of Employee'} !=0 ? @$FMdata->{'ESI - No_ Of Employee'} : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #f2f2f2;" colspan="3">
                <h3 style="text-align: center; color:#000; font-size:17px;"><strong>EPF Account Details</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'EPF A_C No_'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$FMdata->{'EPF - No_ Of Employee'} !=0 ? @$FMdata->{'EPF - No_ Of Employee'} : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color:#fff;"><strong>Upload Document</strong></h3>
            </th>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Copy of valid wireless operating license (WOL) issued by WPC wing of ministry of communication and IT.</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $FMdata->{'WOL File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Copy of grant of permission agreement (GOPA) signed with the Ministry of information & broadcasting</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'GOPA File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>An undertaking mentioning a Minimum Broadcast Period-The minimum broadcast period of 6 months of commercial broadcast with at least 16 hours broadcast per day i.e. 7 AM to 11 PM shall be the criterion for a private FM Radio Stations to be empanelled with DAVP.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$FMdata->{'Undertaking File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>The programme scheduling for the previous 06 months from 7 AM to 11 PM, during which the FM stations operated. An external hard disk/ CD,station wise/Date wise in mp3 format, minimum 128 kbps (Bit rate) containing the programmes broadcast for the last one month preceding the date of
                        application.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$FMdata->{'Program Scheduling File Name'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Upload scan copy Of cancelled cheque</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Cancelled Cheque File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Certificate duly signed by the Auditor/Company secretary for the prescribed revenue details, latest profit & loss accounts, balance sheet and actual tax payment including service tax for previous financial year and the amount of advertisement revenue generated by the private FM radio stations during the previous financial year preceding the date of application.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Auditor File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>The private FM radio stations either provide the documentary proof of broadcast certificate (BC) or give an undertaking that they would provide the broadcasting certificate along with physical bills at the time of submission of application.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Broadcasting Cert File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A letter attested by Senior Management level executive of the FM Radio Station mention name, designation and signature of the authorized signature for bills/TC.</strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'SMA File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>A signed list mention the name of station, frequency and state of operation to be provided by the group/holding company/media house to which the applicant FM radio station belongs.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $FMdata->{'Signed List File Name'} != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                   
                </table>
            </td>
        </tr>
    </table>
</body>

</html>