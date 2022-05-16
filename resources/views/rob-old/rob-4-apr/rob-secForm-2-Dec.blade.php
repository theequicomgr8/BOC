@extends('admin.layouts.layout') 
@section('content') 
<div class="content-inside p-3">
    {{-- <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" /> --}} {{-- <link href="{{asset('arogi/css/bootstrap-responsive.css')}}" rel="stylesheet" /> --}}
    <!-- <link rel="stylesheet" href="{{asset('arogi/css/jquery-ui.css')}}" type="text/css" />
      <!-- <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script> -->
    <!-- <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script> -->
    <!-- Content Header (Page header) -->
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 text-primary">
          <i class="fa fa-edit"></i> ROB FORM - Feedback For Outreach Programs - Page-1
        </h6>
      </div>
      <div class="card-body">
        <center>
            @if (session('msg'))
                <div class="alert alert-success">
                    <span class="text-success"><h5>{{session('msg')}}</h5></span>
                </div>
            @endif
        </center>
        <form name="Form2" method="post" id="Form2" action="{{route('robtwo')}}" class="form-horizontal" autocomplete="off" enctype="multipart/form-data"> 
          @csrf 
          @php
              $id=Request::segment(2);
          @endphp
          <input type="hidden" name="rob_form_id" value="{{$id}}">
          <div class="row">
              <div class="col-xl-4">
                  <label for="">Document Type : </label>
                  <select name="document_type"  id="ddl_doc_categ" required class="form-control">
                    <option selected="selected" value="0">--Select--</option>
                    <option value="PIC">Photographs of Event</option>
                    <option value="VID">Video Clips Of Event</option>
                    <option value="NEW">Newspaper cutting</option>
                </select>
              </div>
              <div class="col-xl-4">
                  <label for="">Date Of Event : </label>
                  <input name="event_date" type="date" required maxlength="10" id="txt_date_event" class="calendar1 form-control" />
              </div>
              <div class="col-xl-4">
                  <label for="">Venue Of Event : </label>
                  <input name="venue_event" type="text" required maxlength="50" id="txt_venue_event" class="form-control" />
              </div>
          </div>
          <div class="row" >
              <div class="col-xl-6">
                <table class="table" id="FileUploadContainer">
                    <tr>
                        <td>File : <input type="file" name="document_name[]" id="pic" class="form-control"></td>
                        <td><br><button class="btn btn-info" id="Button1">Add</button></td>
                    </tr>
                </table>
              </div>
          </div>
          <input type="submit" name="btnUpload" value="Save" id="btnUpload" class="btn btn-primary" />
        </form>
      </div>
    </div>
    <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
    <script src="{{asset('arogi/js/custom.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            var i=1;
            $("#Button1").click(function(e){
                e.preventDefault();
                i++;
                $("#FileUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file" style="height:46px;" name="document_name[]" id="pic" class="form-control"></td><td><br><button class="btn btn-danger remove" id="'+i+'">X</button></td></tr>'+"<br><br>");
            });
    
            $(document).on("click",'.remove',function(e){
                e.preventDefault();
                var id=$(this).attr('id');
                $("#row"+id).remove();
            });
        });
    </script>
     @endsection
