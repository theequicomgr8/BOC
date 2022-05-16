@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }

</style>
@section('content')
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
      <h6 class="m-0">
        <i class="fa fa-user"></i> Submitted Bill Reports For AV-TV
      </h6> 
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="card-body p-2">
          <!-- <form name ="ODBsearch" id="ODBsearch" method="GET" enctype="multipart/form-data" action="" >
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label">Media Type</label>
                  <select name="odmediaType" id="odmediaType" class="form-control form-control-sm">
                  <option value="">Select Media Type</option>
                  <option value="0" >Personal Media(PMC)</option>
                  <option value="1">Private Media</option>
                  <option value="2">Sole Right</option>
                  
              </select>
                </div>
              </div>
              
               <div class="col-md-2">
                <div class="form-group">
                  <label class="form-control-label">&nbsp;</label>
                  <input type="submit" class="btn btn-block btn-primary btn-sm" >
                </div>
              </div>
            </div>
         </form> -->
     </div>
     <div class="table-responsive">
      <table style="" class="table table-striped table-bordered table-hover order-list" id="myTable">

        <thead>
          <tr>
            <th scope="col">S.No</th>
            <th scope="col">Reference No.</th>
            <th scope="col">RO Code</th>
            <th scope="col">Agency Code</th>
            <th scope="col">OD Media Caegory</th>
            <th scope="col">Agency Name</th>
            <th scope="col">Language</th>
            <th scope="col">State</th>
            <th scope="col">Published On</th>
            <th scope="col">Remarks</th>
            <th scope="col" >Action</th>
          </tr>
        </thead>
        <tbody>
         
          <tr>
            <td>1.</td>
            <td>Reference No</td>
            <td>Reference No</td>
            <td>Reference No</td>
            <td> Reference No</td>
            <td> Reference No </td>
            <td> Reference No</td>
             <td>Reference No</td>
            <td>Reference No </td>
            <td>Reference No </td>
            <td><a href="{{route('tvbilling.create')}}">Submit Billing</a></td>
            </tr>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>

</div>

@endsection
