<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>AV Application Receipt</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tree {
            page-break-inside: avoid;
        }

    </style>
</head>
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
                        <td><strong>AV Producer ID </strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['AV Producer ID'] ?></td>
                    </tr>
                    <tr>
                        @php
                        $category = '';
                        $category_arr = array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'Special Category');
                        foreach($category_arr as $key => $val){
                        if($avdatas['category'] == $key){
                        $category = $val;
                        }
                        }
                        @endphp
                        <td><strong>Category applied for</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $category ?? ''?></td>
                    </tr>
                    <tr>
                        <td><strong>Do you have branch office / offices other than indicated above in delhi or outside delhi (if yes, given details)</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Branch Office'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Name of the executive producers</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Executive Producer Name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Name of organization</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Organization Name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Office address in full </strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Office Address'] ?></td>
                    </tr>
                    <!-- <tr>
                        <td><strong>Residential address of the executive producer</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $avdatas['Residential Address Of EPResidential Address Of EP'] }}</td>
                    </tr> -->
                    <tr>
                        <td><strong>Office Telephone</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Office Phone'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Resident Telephone</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Residential Phone'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Mobile No.</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Mobile'] ?? ''?></td>
                    </tr>
                    <tr>
                        <td><strong>E-Mail ID</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Email ID'] ?? ''?></td>
                    </tr>

                    <tr>
                        <td><strong>Branch office / offices other than indicated above in delhi or outside delhi</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Branch Office Address'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact Person</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Contact Person at Delhi'] ?? ''?></td>
                    </tr>
                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Contact Person Phone'] ?? ''?></td>
                    </tr>

                    <tr>
                        <td><strong>If your organization registered under companies act?</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Organization Registered'] == "0" ? 'No' : 'Yes'?></td>
                    </tr>

                </table>
            </td>
        </tr>
        <tr>
            <td style="background: #2268B2;" colspan="3">
                <h3 style="text-align: center; color: #fff;"><strong>AV Information</strong></h3>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>Select organization type</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td><?= $avdatas['Org_ Type'] == "1" ? 'Partnership Firm' : 'Company'?></td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Org_ Reg_ State'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address of partners</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Org_ Address'] ?></td>
                    </tr>

                    <tr>
                        <td><strong>State</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Org_ Reg_ State'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address of directors</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Org_ Address'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Net worth (for a/b/c categories)</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Net Worth'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Details of programme</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Program Detail'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Channel in which telecast/broadcast</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Telecatst_Channel'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date/time of telecast</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Telecast_DateTime'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td><strong>TRP ratings of programme</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['TRP_Ratings'] ?></td>
                    </tr>
                    <div class="row col-md-12 ml-1">
                        <h5 class="subheading">In case of application for category b, please provide details of studio below :</h5>
                      </div>
                    <tr>
                        <td><strong>Address of studio</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Studio Address'] ?></td>
                    </tr>

                    <tr>
                        <td><strong>Phone No.</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Studio Phone'] ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background:#f2f2f2;" colspan="3">
                <h4 style="text-align: center; color: #000; font-size:17px;"><strong>Eligibility Criteria :-</strong></h4>
            </td>
        </tr>
        <tr>
            <td colspan="1">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td width="35%"><strong>The number of audio-spots/jingles/video spots produced by you in the last three years</strong></td>
                        <td width="3%"><strong>:</strong></td>
                        <td><?= $avdatas['No_ Of Audio-Spots_video'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>How many of above has been for clients other than davp/government departments</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['No_ For Others'] ?></td>
                    </tr>
                    <div class="col-md-12">If applying for special category, please give details below of professional experience :</div>
                    <tr>
                        <td><strong>Institution from which degree/diploma was obtained</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Institution Name'] ?></td>
                    </tr>

                    <tr>
                        <td><strong>Year in which obtained</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Degree_Diploma Year'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Area in which degree/diploma was obtained</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Degree_Diploma Area'] ?></td>
                    </tr>

                    <!-- <tr>
                        <td><strong>Award if any</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $avdatas['List Of Award'] }}</td>
                    </tr> -->

                    <tr>
                        <td><strong>Name at least one programme in the applied category which has been produced by you, along with duration</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['List Of Program'] ?></td>
                    </tr>

                    <!-- <tr>
                        <td><strong>Preferred area work</strong></td>
                        <td><strong>:</strong></td>
                        <td> $avdatas['Social sector'] }}</td>
                    </tr> -->

                    <!-- <tr>
                        <td><strong>Infrastructure Sector</strong></td>
                        <td><strong>:</strong></td>
                        <td>{{ $avdatas['Infrastructure sector'] }}</td>
                    </tr> -->

                    <tr>
                        <td><strong>Financial Sector</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Financial Sector'] ?></td>
                    </tr>

                    <tr>
                        <td><strong>National Integration</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['National Integration'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Defence and security</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Defence and security'] ?></td>
                    </tr>

                    <tr>
                        <td><strong>Any other relevant information</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Other Information'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bank account number for receiving payment</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Account No_'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Account holder name</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Payee Name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>IFSC Code</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['IFSC Code'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bank Name</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Bank Name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Branch</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Bank Branch'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>PAN No.</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['PAN'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Draft No.</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['DD No_'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Drawn on bank</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['DD Bank Name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Legal status of organization copy of the certificate of registration may be attached</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Legal cert_ of regist_'] == "0" ? 'No' : 'Yes' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Copy of income-tax return of last financial year to be attached</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['I_T Return File Name'] == "0" ? 'No' : 'Yes'?></td>
                    </tr>
                    <tr>
                        <td><strong>Cancelled cheque to be attached </strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Cancelled Cheque File Name'] == "0" ? 'No' : 'Yes' ?></td>
                    </tr>
                    <tr>
                        <td><strong>Bio-data of key person of creative team (please attach separate sheet)</strong></td>
                        <td><strong>:</strong></td>
                        <td><?= $avdatas['Bio-data File Name'] == "0" ? 'No' : 'Yes' ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
