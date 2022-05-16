<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Release Order cum Bill List</title>
    <style type="text/css">
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table {
            font-size: 13px;
        }
    </style>
</head>
@php
$response=isset($response)? $response:'';
@endphp

<body>
    <div class="card-body">
        <h5 style="margin-left:250px"><i class="fa fa-user" aria-hidden="true"></i>Empanelled Media List</h5>
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Reference</th>
                        <th>Email</th>
                        <th>Sub category</th>
                        <th>Mobile</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Agreement</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solepdfdata as $key => $soledata )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            {{ $soledata->media_id }}
                        </td>
                        <td>
                            {{ $soledata->ho_email }}
                            {{-- @if (@$soledata->category==0)
                                            {{ 'Airport' }}
                            @elseif(@$soledata->category==1)
                            {{ 'Railway' }}
                            @elseif(@$soledata->category==2)
                            {{ 'Road side' }}
                            @elseif(@$soledata->category==3)
                            {{ 'Moving Media' }}
                            @elseif(@$soledata->category==4)
                            {{ 'Public utility' }}
                            @endif --}}
                            {{-- <a href="#" cat-id="{{ $soledata->media_id }}" class="text-info cat-modal" data-toggle="modal" data-target="#myModal">View</a> --}}
                        </td>
                        <td>
                            <!-- {{ $soledata->gst }} -->
                            <!-- {{-- {{ $soledata->{'name'} }} --}} -->
                            <a href="#" sub-cat-id="{{ $soledata->media_id }}" class="text-info sub-modal" id="" data-toggle="modal" data-target="#myModal2">View</a>
                        </td>
                        <td>
                            {{ $soledata->mobile }}
                        </td>
                        <td>
                            <a href="sole-right-media/{{ $soledata->media_id }}" id="view"><i class="fa fa-eye" style="font-size:17px;color:#f8b739"></i></a>
                        </td>
                        <td>
                            @if($soledata->to_date >=$today)
                            {{'Active'}}
                            @else
                            <a href="sole-right-renewal/{{ $soledata->vendor_code }}" class="text-info">Renewal </a>
                            @endif
                        </td>
                        <td>
                            <a href="soleright-fileupload/{{ $soledata->media_id }}" class="text-info">Agreement</a>
                        </td>
                        <td>
                            @if($soledata->payment_status == 'Pending')
                            <a href="/vendor-payment/{{$soledata->media_id}}" target="_blank" class="blinking">{{ $soledata->payment_status }}</a>
                            @else
                            <a href="#" payment-odmediaid="{{ $soledata->media_id }}" class="text-info payment-modal" id="" data-toggle="modal" data-target="#paymentModal">View</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
