@extends('admin.layouts.layout')

@section('content')

<div class="content-inside p-3">
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-normal text-primary">Application Form For Soleright Account</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
    
            @if(session('status') === true)
            <div align="center" class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @else
            @if(session()->get('message'))
            <div align="center" class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
            @endif
            @endif
            <form method="POST" action="{{Route('update_account_detail')}}" autocomplete="off" id="account_detail_form">
                {{ csrf_field() }}
                <div class="tab-content">
                    <div class="content pt-3 tab-pane active show" role="tabpanel">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pan_card">Pan No. / पैन नंबर<font color="red">*</font>
                                    </label>
                                    <input type="text" name="PAN" id="pan_card" class="form-control form-control-sm" placeholder="Enter Pan No." maxlength="10" value="{{$data->{'PAN'} ?? ''}}">
                                    @error('PAN')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code / आई एफ एस सी कोड<font color="red">*</font>
                                    </label>
                                    <input type="text" name="IFSC_Code" id="ifsc_code" class="form-control form-control-sm" placeholder="Enter IFSC Code" maxlength="11" value="{{$data->{'IFSC Code'} ?? ''}}">
                                    @error('IFSC_Code')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name / बैंक का नाम<font color="red">
                                            *</font></label>
                                    <input type="text" name="Bank_Name" id="bank_name" class="form-control form-control-sm" placeholder="Enter Bank Name" maxlength="30" onkeypress="return onlyAlphabets(event)" value="{{$data->{'Bank Name'} ?? ''}}">
                                    @error('Bank_Name')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch / शाखा<font color="red">*</font>
                                    </label>
                                    <input type="text" name="Bank_Branch" id="branch" class="form-control form-control-sm" placeholder="Enter branch" maxlength="30" value="{{$data->{'Bank Branch'} ?? ''}}">
                                    @error('Bank_Branch')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account no / खाता नंबर<font color="red">*</font></label>
                                    <input type="text" name="Account_No" id="account_no" class="form-control form-control-sm" placeholder="Enter Account no" onkeypress="return onlyNumberKey(event)" maxlength="20" value="{{$data->{'Account No_'} ?? ''}}">
                                    @error('Account_No')
                                    <font color="red">{{ $message }}</font>
                                    @enderror
                                </div>
                            </div>


                            




                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="float: right;" {{ empty(@$data) ? 'disabled' : '' }}>Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.content-->
@endsection
