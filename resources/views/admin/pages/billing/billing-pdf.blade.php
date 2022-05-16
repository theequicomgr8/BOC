<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    $results = isset($response) ? $response:'';
@endphp

<body>
    <div class="card-body">
        <h5 style="margin-left:250px"><i class="fa fa-user" aria-hidden="true"></i></h5>
        <div style="overflow-x: auto;">
            <table width="100%" border="1" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <td align="center" colspan="3"><img style="margin-top: 15px" src="{{ public_path('/email-images/BOC.png') }}" width="80" height="80">
                            <p><strong>GOVERNMENT OF INDIA <br />
                                    BUREAU OF OUTREACH & COMMUNICATION<br />
                                    Ministry of Information & Broadcasting</strong><br />
                                Phase IV, Soochna Bhavan, CGO Complex, Lodhi Road, New Delhi 110003
                            </p>
                        </td>
                    </tr>
                    <tr>
                    <td align="center" colspan="3">
                    <h4 class="text-left"><u>Compliance Details</h6>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left" style="width: 10%">S No.</th>
                        <th class="text-left">Description</th>
                        <th class="text-left">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Bill No.</td>
                      <td>{{ $results->{'Control No_'} }}</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Bill Date</td>
                      <td>{{ $results->{'Vendor Bill Date'} }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Publication Date</td>
                        <td>{{ $results->{'Publishing Date'} }}</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>GST No</td>
                        <td>{{ $results->{'Vendor GST No_'} }}</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Published In</td>
                        <td>{{ $results->{'Billing Advertisement Type'} == 'Color' ? 'Color' : 'Black & white' }}</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Page No. on which Ad. Published</td>
                        <td>{{ $results->{'Page No_'} }}</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Advertisement Length(in CMS)</td>
                        <td>{{ round($results->{'Advertisement Length'}),2 }}</td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>Width(In CMS)</td>
                        <td>{{ round($results->{'Advertisement Width'}),2  }}</td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>Difference in Sq.</td>
                        <td>{{ round($results->{'Advertisement Diff_'}),2  }}</td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>Claimed Amount</td>
                        <td>{{ round($results->{'Bill Claim Amount'}),2 }}</td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>Bill Officer Name</td>
                        <td>{{ $results->{'Bill Officer Name'} }}</td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td>Bill Officer Designation</td>
                        <td>{{ $results->{'Bill Officer Designation'} }}</td>
                      </tr>
                      <tr>
                        <td>13</td>
                        <td>E-mail ID</td>
                        <td>{{ $results->{'Email Id'} }}</td>
                      </tr>
                      <tr>
                        <td>14</td>
                        <td>Auth. Signatory Name</td>
                        <td>{{ $results->{'Bill Submitted By'} }}</td>
                      </tr>
                      <tr>
                        <td>15</td>
                        <td>Auth. Signatory Designation</td>
                        <td>{{ $results->{'Bill Submitted - Designation'} }}</td>
                      </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
