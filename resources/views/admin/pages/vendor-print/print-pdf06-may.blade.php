<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Application Receipt</title>
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
$ownerdatas = $owner_datas['owner'];
$vendordatas = $vendor_datas['vendor'];
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
                        <td width="35%"><strong>Group Code</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $ownerdatas['Owner ID'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Reference Code </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Newspaper Code'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>GST No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['GST No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Owner Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['Owner Name'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID(Owner)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['Email ID'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['Mobile No_'] }}</td>
                    </tr>
                    <tr>
                        @php
                        $owner_type = '';
                        $owner_type_arr = array(0 => 'Individual', 1 => 'Partnership', 2 => 'Trust', 3 => 'Society', 4
                        => 'Proprietorship', 5 => 'Public Ltd', 6 => 'Pvt Ltd');
                        foreach($owner_type_arr as $key => $val){
                        if($ownerdatas['Owner Type'] == $key){
                        $owner_type = $val;
                        }
                        }
                        @endphp
                        <td><strong>Owner Type</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $owner_type }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['Address 1'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['state_code'] }} ~ {{ $ownerdatas['state_name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['District'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['City'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['Phone No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Fax</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $ownerdatas['Fax No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        @php
                        $cir_base = '';
                        $cir_base_arr = array(0 => 'RNI', 1 => 'CA', 2 => 'PIB', 3 => 'ABC');
                        foreach($cir_base_arr as $key => $val){
                        if($vendordatas['CIR Base'] == $key){
                        $cir_base = $val;
                        }
                        }
                        @endphp
                        <td><strong>Circulation Base</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$cir_base}}</td>
                    </tr>
                    @if(@$vendordatas['CIR Base'] == 0)
                    <tr>
                        <td><strong>RNI Registration No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['RNI Registration No_'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>RNI E-filing Number</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['RNI E-filling No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Claimed Circulation No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Claimed Circulation'] ?? ''}}</td>
                    </tr>
                    @endif
                    @if(@$vendordatas['CIR Base'] == 1)
                    <tr>
                        <td><strong>UDIN No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['UDIN'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Claimed Circulation No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['CA Circulation Number'] ?? ''}}</td>
                    </tr>
                    @endif
                    @if(@$vendordatas['CIR Base'] == 3)
                    <tr>
                        <td><strong>ABC Certificate No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['ABC Number'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Claimed Circulation No. </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['ABC Circulation Number'] ?? ''}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>Average Circulation Copies</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Average Circulation Copies'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Date of First Publication</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Date Of First Publication'] !='1753-01-01 00:00:00.000' && $vendordatas != null) ? date('d-m-Y', strtotime(@$vendordatas['Date Of First Publication'] )) : '' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color: #fff;"><strong>Print Information</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Newspaper Name</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $vendordatas['Newspaper Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Place of Publication</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Place of Publication'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>E-mail ID(Vendor)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['E-mail ID'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Mobile No_'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Address'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['state_name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['District'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>City</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['City'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pin Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Pin Code'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Phone No'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Fax</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Fax'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Language</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['lang_name'] }}</td>
                    </tr>
                    @php
                    $Periodicity = '';
                    $Periodicity_arr = array(0 => 'Daily(M)', 1 => 'Daily(E)', 2 => 'Daily Except Sunday', 3 => 'Bi-Weekly', 4 => 'Weekly', 5 => 'Fortnightly', 6 => 'Monthly');
                    foreach($Periodicity_arr as $key => $val){
                    if($vendordatas['Periodicity'] == $key){
                    $Periodicity = $val;
                    }
                    }
                    @endphp
                    <tr>
                        <td><strong>Periodicity</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Periodicity }}</td>
                    </tr>
                    <tr>
                        <td><strong>Page Length (in Cms.)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Page Length'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Length'])),0),'.') : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Page Width (in Cms.)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Page Width'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Width'])),0),'.') : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Print Area Per Page (in SQ.CM)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Page Area per page'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Page Area per page'])),0),'.') : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>No. Of Pages</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['No_ Of pages'] !=0 ? @$vendordatas['No_ Of pages'] : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Print Area (in Sq. Cms.)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Total Print Area'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Total Print Area'])),0),'.') : '') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Minimum Current Card Rate</strong></h4>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Black & White (Rs per SQ CM)</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Minimum Current Card Rate(B_W)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(B_W)'] )),0),'.') : '' ) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Color (Rs per SQ CM)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Minimum Current Card Rate(c)'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Minimum Current Card Rate(c)'] )),0),'.') : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Price of Newspaper (Rs) </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Price of NewsPaper'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Price of NewsPaper'] )),0),'.') : '') }}</td>
                    </tr>
                    @php
                    $Quality = '';
                    $Quality_arr = array(0 => 'Standard Newspaper', 1 => 'Glazed', 2 => 'Ordinary');
                    foreach($Quality_arr as $key => $val){
                    if($vendordatas['Quality of Paper'] == $key){
                    $Quality = $val;
                    }
                    }
                    $printing_color = '';
                    if($vendordatas['Printing in colour'] == 0){
                    $printing_color = 'Color';
                    }
                    if($vendordatas['Printing in colour'] == 1){
                    $printing_color = 'B/W';
                    }
                    @endphp
                    <tr>
                        <td><strong>Quality of Paper Used</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $Quality }}</td>
                    </tr>
                    <tr>
                        <td><strong>Printing in Color</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $printing_color }}</td>
                    </tr>
                    @if($printing_color == 'Color')
                    <tr>
                        <td><strong>How many Pages in Color</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['No_ of pages in colour'] }}</td>
                    </tr>
                    @endif
                    @php
                    $Agencies = '';
                    $Agencies_arr = array(0 => 'PTI', 1 => 'ANI', 2 => 'UNI', 3 => 'VAARTA', 4 => 'BHASHA', 5 => 'IANS', 6 => 'WEB VAARTA', 7 => 'GNS', 8 => 'Others');
                    foreach($Agencies_arr as $key => $val){
                    if($vendordatas['News Agencies Subscribed To'] == $key){
                    $Agencies = $val;
                    }
                    }
                    @endphp
                    <tr>
                        <td><strong>News Agencies Subscribed to</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$Agencies}}</td>
                    </tr>
                    <tr>
                        <td><strong>Other Agency</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Agencies Name'] !='' ? $vendordatas['Agencies Name'] : '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Annual Turnover of The Newspaper in Rs</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Annual Turn-over'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Annual Turn-over'])),0),'.') : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Editor Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Editor Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Editor Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Editor Mobile'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Editor Email ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Editor Email'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Publisher Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Publisher_s Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Publisher Mobile</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Publisher Mobile'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Publisher Email ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Publisher Email'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Printer Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Printer_s Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Printer Mobile</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Printer Mobile'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Printer Email ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Printer Email'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Press Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Name of Press'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Press Mobile </strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Press Mobile'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Press Email ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Press Email'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Press Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Press Phone'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address of Press</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Address of Press'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Distance from Office to Press (In Km)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ (@$vendordatas['Distance from office to press'] !=0 ? rtrim(rtrim(sprintf('%f', floatval($vendordatas['Distance from office to press'] )),0),'.') : '') }}</td>
                    </tr>
                    <tr>
                        <td><strong>CA Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['CA Name'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>CA Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['CA Address'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>CA Registration No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['CA Registration No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>CA Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['CA Mobile No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>CA Email ID</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['CA Email'] ?? ''}}</td>
                    </tr>
                    @php
                    $dm_date = ' ';
                    if((@$vendordatas['DM Declaration Date'] != '1970-01-01 00:00:00.000') && $vendordatas != null){
                    $dm_date = date('d-m-Y', strtotime(@$vendordatas['DM Declaration Date'] ));
                    }
                    @endphp
                    <tr>
                        <td><strong>DM Declaration End Date</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$dm_date}}</td>
                    </tr>
                    <tr>
                        <td><strong>Is Past Address Changed ?</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Change In Company Address'] == "0" ? 'No' : 'Yes'}}</td>
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
                        <td width="35%"><strong>Account Type</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $vendordatas['Account Type'] == 0 ? 'Savings' : 'Corporate'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Account Number For Receiving Number*Bank Account No. For Receiving
                                Payments</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Bank Account No_'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Account Holder
                                Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Account Holder Name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['IFSC Code'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Bank Name'] }}/td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Branch'] }}</< /td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Account Address'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['PAN'] }}</< /td>
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
                        <td>{{ $vendordatas['ESI Account No'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['No_of Employees covered'] !=0 ? @$vendordatas['No_of Employees covered'] : '' }}</td>
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
                        <td>{{ $vendordatas['EPF Account No_'] ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendordatas['No_ of EPF Employees covered'] !=0 ? @$vendordatas['No_ of EPF Employees covered'] : '' }}</td>
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
                        <td width="35%"><strong>Annexure – A (signed byC.A) (only PDF) max size2MB</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ $vendordatas['Annexure File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Specimen copies to be sent withapplication</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Specimen Copy File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Copy of declaration field by beforeDM/DCP or other competent authority</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendordatas['Decl_ Filed Before File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Owner’s PAN number selfattested copy</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{$vendordatas['PAN Copy File Name'] != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                    <tr>
                        <td><strong>No dues Certificates of PressCouncil of India for the lastfinancial year
                                registration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['No Dues Cert File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Circulation Certificate as per policy (self-attested) (If more than 25,000 than
                                RNI/ABC is mandatory)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Circulation Cert File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>RNI (self-attested) Registration Certificate (Upload only PDF)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['RNI Reg File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Copy of Annual Return Form-2submitted to RNI along with receiving proof </strong>
                        </td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Annual Return File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Copy of commercial rate card of the publication (1 copy)</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Specimen Copy File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Owner’s GST registration Certificate</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['GST Reg Cert File Name'] != '' ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Change of information for existing company</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Change in address File Name'] != '' && $vendordatas['Change in address uploaded'] == '1'? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Self declaration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendordatas['Self Declaration'] == 1 ? 'Yes' : 'No' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>