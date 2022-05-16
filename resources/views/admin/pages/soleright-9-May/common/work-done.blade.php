@php
$dd_line =[];
$i=0;
$OD_work_dones= !empty($OD_work_dones_data) ? $OD_work_dones_data : [1];
@endphp
<br>
<div class="row col-md-12">
    <h4 class="subheading">Details of work in last six months, for the applied media only, if
        any (As per format given below) <br>केवल आवेदन मीडिया के लिए पिछले छह महीनों में कार्य का विवरण, यदि कोई हो (नीचे दिए गए प्रारूप के अनुसार) :-</h4>
</div>
<div class="row" style="display: {{@$show}};">
    <div class="col-md-6">
        <h6>If you want to import through XLS <a href="{{asset('uploads/work_done_excel.xlsx')}}" target="_blank">Download Sample File</a></h6>
    </div>
    <div class="col-md-3">
        <input type="radio" name="xls2" id="xlxyes2" value="1" class="xls2"> Yes &nbsp;
        <input type="radio" name="xls2" id="xlxno2" value="0" class="xls2" checked="checked"> No
    </div>
</div>
<div class="row" id="xls_show2" style="display: none;">
    <div class="col-md-4">
        <input type="file" name="media_import2" class="form-control form-control-sm" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
    </div>
</div>
<br>
<div id="details_of_work_done">
    @foreach($OD_work_dones as $key => $work_done_data)
    @if(($key - 1) >= 0)
    <hr id="hrline_workdone_{{$key}}">
    @endif
    <div class="row" id="workid{{$key}}">
        <div class="col-md-4"><br>
            <div class="form-group">
                <label for="year">Year / वर्ष<font color="red">*</font></label>
                <p>
                    <select name="ODMFO_Year[]" id="Years{{$key}}" class="form-control form-control-sm ddlYears" {{@$disabled}} {{@$read}} tabindex="{{@$tab}}" style="pointer-events: {{@$pointer}};">
                        @if(@$work_done_data['Year'] == '')
                        <option value="">Select Year</option>
                        @else
                        <option value="{{ $work_done_data['Year'] }}">
                            {{ $work_done_data['Year'] }}
                        </option>
                        @endif
                    </select>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="quantity_duration">Quantity of Display or Duration /
                    प्रदर्शन या अवधि की मात्रा<font color="red">*</font></label>
                <p>
                    <input type="text" name="ODMFO_Quantity_Of_Display_Or_Duration[]" id="quantity_duration{{$key}}" placeholder="Enter Quantity of Display or Duration" class="form-control form-control-sm" maxlength="8" onkeypress="return onlyNumberKey(event)" value="{{$work_done_data['Qty Of Display_Duration'] ?? ''}}" {{@$disabled}} {{@$read}} tabindex="{{@$tab}}" style="pointer-events: '{{@$pointer}}';">
                </p>
                <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no[]">
            </div>
        </div>
        <div class="col-md-4"><br>
            <div class="form-group">
                <label for="billing_amount">Billing Amount(Rs) / बिलिंग राशि
                    (रु)<font color="red">*</font></label>
                @php
                if(@$work_done_data['Billing Amount'] == 0)
                {
                $work_done_data1 = '';
                }
                else
                {
                $work_done_data1 = round(@$work_done_data['Billing Amount'],2);
                }
                @endphp
                <p>
                    <input type="text" name="ODMFO_Billing_Amount[]" id="billing_amount{{$key}}" placeholder="Enter Billing Amount(Rs)" class="form-control form-control-sm" onkeypress="return onlyNumberKey(event)" maxlength="8" value="{{$work_done_data1}}" {{@$disabled}} {{@$read}} tabindex="{{@$tab}}" style="pointer-events: '{{@$pointer}}';">
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>From Date / की दिनांक से<font color="red">*</font></label>
                <p>
                    <input type="date" name="from_date[]" maxlength="10" id="from_date{{$key}}" value="{{ (!empty(@$work_done_data['From Date']) && @$work_done_data['From Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['From Date'])) : ''}}" class="form-control form-control-sm" {{@$disabled}} {{@$read}} tabindex="{{@$tab}}" style="pointer-events: {{@$pointer}};">
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>To Date / दिनांक तक :<font color="red">*</font></label>
                <p>
                    <input type="date" name="to_date[]" maxlength="10" id="to_date{{$key}}" value="{{ (!empty(@$work_done_data['To Date']) && @$work_done_data['To Date'] != '1753-01-01 00:00:00.000') ? date('Y-m-d', strtotime(@$work_done_data['To Date'])) : ''}}" class="form-control form-control-sm" {{@$disabled}} {{@$read}} tabindex="{{@$tab}}" style="pointer-events: {{@$pointer}};">
                </p>
            </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-10"></div>
        <div class="col-md-2" style="display: {{$key==0 ? 'none' :'block'}}; padding: 0% 0 0 6%;"><button class="btn btn-danger remove_row_next" data="{{$key}}" data-hide="workid{{$key}}" style="display: {{@$show}};font-size: 13px;"><i class="fa fa-minus"></i> Remove</button>
            <input type="hidden" value="{{$work_done_data['Line No_'] ?? ''}}" name="line_no" id="line_no_{{$key}}">
            <input type="hidden" value="{{$work_done_data['OD Media ID'] ?? ''}}" name="odmedia_id" id="odmedia_id_{{$key}}">
        </div>
    </div>
    @php
    if(@$work_done_data['Line No_']) {
    $dd_line[] = $work_done_data['Line No_'];
    }
    $exline2=implode(',',$dd_line);
    $i++;
    @endphp
    @endforeach
</div>

<input type="hidden" name="lineno2" id="lineno2" value="{{$exline2 ?? ''}}">
<div class="row" style="float:right;margin: 6px 0 0 0;">
    <input type="hidden" name="count_i" value="{{$key ?? 0}}" id="count_i">
    <a class="btn btn-primary {{@$disabled}}" id="add_row_next" {{@$read}} tabindex="{{@$tab}}" style="pointer-events: {{@$pointer}}; display: {{@$show}};font-size: 13px;"><i class="fa fa-plus" aria-hidden="true"></i>
        Add New</a>
</div><br>