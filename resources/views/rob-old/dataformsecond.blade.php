@extends('admin.layouts.layout')

@section('content')
<style>
    .main-footer{
        margin-left: 4px !important;
    }
</style>
<div class="content-wrapper">
    <link href="{{asset('arogi/css/home_standard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('arogi/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('arogi/css/bootstrap-responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('arogi/css/jquery-ui.css')}}" type="text/css" />
    <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" />
    <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">ROB</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">ROB</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-12">
<style type="text/css">
body
{
    margin: 0;
    padding: 0;
    height: 100%;
}
.modal
{
    display: none;
    position: absolute;
    top: 0px;
    left: 0px;
    background-color: black;
    z-index: 100;
    opacity: 0.8;
    filter: alpha(opacity=60);
    -moz-opacity: 0.8;
    min-height: 100%;
}
#divImage
{
    display: none;
    z-index: 1000;
    position: fixed;
    top: 0;
    left: 0;
    background-color: White;
    height: 550px;
    width: 600px;
    padding: 3px;
    border: solid 1px black;
}
</style>
   

    <form name="form2" method="post" action="{{route('form-two')}}" id="form2" enctype="multipart/form-data">
        @csrf


        <div class="row">
            

<!-- <TABLE id="Table1" style="WIDTH: 100%;" cellSpacing="0" cellPadding="0" align="center" border="0">
	<TR>
		<TD width="100%">
			<div id="header">
			
                <div><img src="{{asset('arogi/images/banner_BOC.jpg')}}" border="0" alt="DAVP Banner" style="width:100%" /></div>
			</div>
		</TD>
	</TR>
</TABLE> -->

        </div>
        <div class="row form-actions text-center">
            <h4 style="margin-left:40%;">Feeback Form For Outreach Programs<br />
                Page-2
                
            </h4>
        </div>
        <div class="container">
            <center>
                @if (session('msg'))
                    <div class="alert alert-success">
                        <span class="text-success"><h5>{{session('msg')}}</h5></span>
                    </div>
                @endif
            </center>
            <div class="row">
                <div class="span2">
                    <span id="lbl_doc_categ">Document TYpe </span>
                </div>
                @php
                $ary=array("Photographs of Event"=>"PIC","Video Clips Of Event"=>"VID","Newspaper cutting"=>"NEW");    
                @endphp
                <div class="span3">
                    <select name="document_type" disabled  id="ddl_doc_categ">
                        <option selected="selected"  value="0">--Select--</option>
                        <!-- {{-- <option value="PIC">Photographs of Event</option>
                        <option value="VID">Video Clips Of Event</option>
                        <option value="NEW">Newspaper cutting</option> --}}
                        {{-- @if($data[0]->document_type!='') --}} -->
                            @foreach ($ary as $key => $value)
                                <option value="{{$value}}" @if($data[0]->document_type==$value) {{'selected'}} @endif  >{{$key}}</option>
                            @endforeach
                    </select>
                </div>

            </div>
            <div class="row ">
                <div class="span2">
                    <span id="lbl_date_event">Date Of Event</span>
                </div>
                <div class="span3">
                    <input name="event_date" disabled value="{{$data[0]->event_date}}"  type="date" maxlength="10" id="txt_date_event" class="calendar1" />
                </div>
            </div>
            <div class="row ">
                <div class="span2">
                    <span id="lbl_venue_event">Venue Of Event</span></div>
                <div class="span3">
                    <input name="venue_event" disabled value="{{$data[0]->venue_event}}" type="text" maxlength="50" id="txt_venue_event" /></div>
            </div>
            <input type="hidden" name="created_date" value="{{date('m/d/Y h:i:s a', time())}}">
            <div class="row">
                <div class="span2">
                    <span id="lbl_file_upload">Click to add files</span></div>
                <div class="span3">
                    @foreach ($data as $item)
                    <!-- {{-- <img src="{{asset('rob/')}}{{$item->document_name}}" alt="" srcset="">   --}} -->
                    <a target="_blank" href="{{asset('rob/'.$item->document_name)}}">{{$item->document_name}}</a><br>
                    @endforeach
                    
                    {{-- <input id="Button1" type="button" value="add"  /> --}}
                </div>

                <br />
                <br />
                <div  style="text-align: center">
                    <!--FileUpload Controls will be added here -->
                    <table id="FileUploadContainer" style="margin-left: 200px;">

                    </table>
                </div>
                <br />

            </div>
            <div class="row text-center ">
                <!-- <input type="submit" disabled name="btnUpload" value="Save" id="btnUpload" class="btn btn-primary" /> -->
                <!-- {{-- <input type="submit" name="btn_clear" value="Clear" id="btn_clear" class="btn btn-warning" /> --}} -->
                <a href="{{route('userlist2',$data[0]->rob_form_id)}}" class="btn btn-info">Back</a>
            </div>
       
        <div class="row ">

                <div>

</div>
        </div>
                    
         </div>
       <div id="divBackground" class="modal" style="width=100%;">
</div>
<div id="divImage">
<table style="height: 100%; width: 100%">
    <tr>
        <td valign="middle" align="center">
            <img id="imgLoader" alt="" src="images/loader.gif" />
            <img id="imgFull" alt="" src="" style="display: none; height: 500px; width: 590px" />
        </td>
    </tr>
    <tr>
        <td align="center" valign="bottom">
            <input id="btnClose" type="button" value="close" onclick="HideDiv()" />
        </td>
    </tr>
</table>
</div>
    </form>
</div>
</div>
</div>
</section>
<script type="text/javascript">
    var counter = 0;
    function AddFileUpload() {
        var div = document.createElement('DIV');
        div.innerHTML = '<input id="file' + counter + '" name = "file' + counter +
            '" type="file" />' +
            '<input id="Button' + counter + '" type="button" ' +
            'value="Remove" onclick = "RemoveFileUpload(this)" />';
        document.getElementById("FileUploadContainer").appendChild(div);
        counter++;
    }
    function RemoveFileUpload(div) {
        document.getElementById("FileUploadContainer").removeChild(div.parentNode);
    }
</script>

<script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
<script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        $(".calendar").datepicker({
            dateFormat: 'dd/mm/yy', inline: true
        });
        $(".calendar").bind("paste", function (e) {
            return false;
        });
        $(".calendar").bind("drop", function (e) {
            return false;
        });

    });
</script>
<script type="text/javascript">
    function LoadDiv(url) {
        var img = new Image();
        var bcgDiv = document.getElementById("divBackground");
        var imgDiv = document.getElementById("divImage");
        var imgFull = document.getElementById("imgFull");
        var imgLoader = document.getElementById("imgLoader");
        imgLoader.style.display = "block";
        img.onload = function () {
            imgFull.src = img.src;
            imgFull.style.display = "block";
            imgLoader.style.display = "none";
        };
        img.src = url;
        var width = document.body.clientWidth;
        if (document.body.clientHeight > document.body.scrollHeight) {
            bcgDiv.style.height = document.body.clientHeight + "px";
        }
        else {
            bcgDiv.style.height = document.body.scrollHeight + "px";
        }
        imgDiv.style.left = (width - 650) / 2 + "px";
        imgDiv.style.top = "20px";
        bcgDiv.style.width = "118%";
        bcgDiv.style.display = "block";
        imgDiv.style.display = "block";
        return false;
    }
    function HideDiv() {
        var bcgDiv = document.getElementById("divBackground");
        var imgDiv = document.getElementById("divImage");
        var imgFull = document.getElementById("imgFull");
        if (bcgDiv != null) {
            bcgDiv.style.display = "none";
            imgDiv.style.display = "none";
            imgFull.style.display = "none";
        }
    }



</script>
<script>
    $(document).ready(function(){
        var i=1;
        $("#Button1").click(function(e){
            e.preventDefault();
            i++;
            $("#FileUploadContainer").append('<tr id="row'+i+'"><td>File : <input type="file" name="document_name[]" id="pic" class="form-control"></td><td><button class="btn btn-danger remove" id="'+i+'">Remove</button></td></tr>'+"<br><br>");
        });

        $(document).on("click",'.remove',function(e){
            e.preventDefault();
            var id=$(this).attr('id');
            $("#row"+id).remove();
        });
    });
</script>
@endsection