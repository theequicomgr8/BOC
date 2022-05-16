<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Digital Cinema Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }
        body{
            font-size:12px;
        }
        table, th, td {
  border:1px solid #dee2e6;
  border-collapse: collapse;
}

    </style>
</head>
<body>
@php
$vendorData =$vendorData ?? '1';
$DigitalScreen_dTA=@$DigitalScreen ?? [1]; 
@endphp
<div class="card-body">
     <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover order-list text-size" id="myTable" width="100%"> 
                <thead>
                <tr>
                        <td align="center" colspan="7"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="50">
                            <p><strong>GOVERNMENT OF INDIA <br />
                                    BUREAU OF OUTREACH & COMMUNICATION<br />
                                    Ministry of Information & Broadcasting</strong><br />
                                Phase IV, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                            </p>
                        </td>
                    </tr>
                </thead>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="150px"><strong>Profile Photo</strong></td>
                        <td><strong>:</strong></td>
                        <td colspan="4">
                            <div style="width:100px; height:100px; border:solid 1px #000;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Agency Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $AName =strtolower($vendorData->{'Agency Name'}); @endphp
                        <td>{{ucwords($AName) ?? ''}}</td>
                        <td><strong>E-mail ID</strong></td>
                        <td width="10px"><strong>:</strong></td>
                        <td>{{@$vendorData->{'E-Mail'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Mobile'} ?? ''}}</td>
                        <td><strong>Address</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Address 1'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        @if($states > 0)
                              @foreach($states as $state)
                              @if(@$vendorData->{'State'} == $state['Code']) 
                              <td>{{$state['Description'] ?? ''}}</td>
                              @endif
                              @endforeach
                              @endif
                        <td><strong>District</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'District'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    @if(count($DigitalScreen_dTA) > 0)
                    @foreach($DigitalScreen_dTA as $DigitalSc)
                    <tr>
                        <td><strong>Screen Unique Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'Screen Unique Code'} ?? ''}}</td>
                        <td><strong>Number of seats</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$DigitalSc->{'No_ Of Seats'} ?? ''}}</td>
                      
                    </tr>
                    @endforeach
                        @endif
                        <tr>
                        <th colspan="6"><hr /></th>
                    </tr>
                    <tr>
                        <td><strong>Account Holder
                                Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $AccountHolderName =strtolower(@$vendorData->{'A_C Holder Name'}); @endphp
                        <td colspan="4">{{ ucwords($AccountHolderName) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank account number for receiving payment</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'Account No_'} ?? ''}}</td>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $vendorData->{'IFSC Code'} ?? ''}}</td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        @php $BankName =strtolower(@$vendorData->{'Bank Name'}); @endphp
                        <td>{{ ucwords($BankName) }}</td>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        @php $branch_name = strtolower(@$vendorData->{'Branch Name'})@endphp
                        <td>{{ ucwords($branch_name) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address of Account</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ strtolower(@$vendorData->{'Account Address'}) }}</td>
                        <td><strong>PAN Card No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendorData->{'PAN'} }}</< /td>
                    </tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendorData->{'ESI A_C No_'} ?? ''}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$vendorData->{'No_ Of Emp in ESI'} >0){{@$vendorData->{'No_ Of Emp in ESI'} ?? ''}}@endif</td>
                    </tr>
                    <tr>
                        <td><strong>Account No.</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{@$vendorData->{'EPF A_c No_'} ?? ''}}</td>
                        <td><strong>No of Employees Covered</strong></td>
                        <td><strong>:</strong></td>
                        <td>@if(@$vendorData->{'No_ Of Emp in EPF'} > 0){{@$vendorData->{'No_ Of Emp in EPF'} ?? ''}}@endif</td>
                    </tr>
                <tr>
                    <th colspan="6" align="left"><h3>Uploaded Documents</h3></th>
                </tr>
                    <tr>
                        <td width="35%"><strong>Agreement between parties (Owner & Agencies)</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td>{{ @$vendorData->{'Agreement File Name'} != '' ? 'Yes' : 'No'}}</td>
                        <td><strong>Self Declaration</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ @$vendorData->{'Self Declaration'} != '' ? 'Yes' : 'No'}}</td>
                    </tr>
                  
                </table>
                </div>
                </div>
</body>

</html>