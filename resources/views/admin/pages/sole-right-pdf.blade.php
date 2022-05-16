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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solepdfdata as $key => $soledata)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            {{ $soledata->media_id }}
                        </td>
                        <td>
                            {{ $soledata->ho_email }}
                        </td>
                        <td>
                            {{ $soledata->media_id }}
                        </td>
                        <td>
                            {{ $soledata->mobile }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
