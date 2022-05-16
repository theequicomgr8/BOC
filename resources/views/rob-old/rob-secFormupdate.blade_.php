

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document Upload</title>
    <meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema" />
    <link href="{{asset('arogi/css/home_standard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('arogi/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{asset('arogi/css/bootstrap-responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('arogi/css/jquery-ui.css')}}" type="text/css" />
    <link href="{{asset('arogi/css/override_style.css')}}" rel="stylesheet" />
    <script src="{{asset('arogi/js/jquery-1.8.2.js')}}" type="text/javascript"></script>
    <script src="{{asset('arogi/js/jquery-ui.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

        var specialKeys = new Array();
        specialKeys.push(8);
        $(function () {
            $(".numeric").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                $(".error").css("display", ret ? "none" : "inline");
                return ret;
            });
            $(".numeric").bind("paste", function (e) {
                return false;
            });
            $(".numeric").bind("drop", function (e) {
                return false;
            });

            $(".remark").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode
                var ret = (keyCode != 39);
                $(".error").css("display", ret ? "none" : "inline");
                return ret;
            });
            $(".alph").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (keyCode >= 48 && keyCode <= 57) || keyCode == 32 || specialKeys.indexOf(keyCode) != -1);
                $(".error").css("display", ret ? "none" : "inline");
                return ret;
            });
            $(".alph").bind("paste", function (e) {
                return false;
            });
            $(".alph").bind("drop", function (e) {
                return false;
            });
        });
    </script>
    <script>
        function isNumberKey(evt, obj) {

            var charCode = (evt.which) ? evt.which : event.keyCode
            var value = obj.value;
            var dotcontains = value.indexOf(".") != -1;
            if (dotcontains)
                if (charCode == 46) return false;
            if (charCode == 46) return true;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
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
   
</head>
<body>
    <form name="form2" method="post" action="{{route('form-twoupdate')}}" id="form2" enctype="multipart/form-data">
        @csrf
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="YLfAGxsPBnJB9BeTb5WnlTCuos+p5n7cJ3GVUaeulj1XinT3277WXxmqMRX11SQz3gVKcXkaaXsdHkRpGYO9EGpW5hmr3bpPVFCG1IC5NlTep/cn5KOHk8Klupkxxdbnw8HTgxsy8bATFyMQZAz9X1wgiPwTqYO27piKk5+yvW4vdEBr" />
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>


<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="BAE44A69" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="O06y86j9jCk5P0tdMd4k0k+2OKqZzP+35XygPbc9JDLj+e7cx6TJsDWeM9Rz0vXTDs6DgqwrHzbjevyRh0SFGe4BmsfOyx/CDSjqfovoZOzPEeu69liuKVvKNkEaHO706nNFIQB65m4mXiR3rKtAYT5NwjaFlHFolaXoKjQwQSKSxCMghU2P0Tf8pwH3XAA3xk7/syAyagImV6pribbIrgJaIWxkr+YTbK9lSpDatKYL39creVd/e54AXiHL5gaiKc03wz9D3IK3vckaWX2vayE6ysuoaI52NnaAG+Rs05IuaNB1lkTvH4FegaJG3NbtHQ/2YKcX5OrvGWid" />
</div>
        <div class="row">
            
<LINK href="home_standard.css" type="text/css" rel="stylesheet">
<TABLE id="Table1" style="WIDTH: 100%;" cellSpacing="0" cellPadding="0" align="center" border="0">
	<TR>
		<TD width="100%">
		<!--Webiste Banner Starts-->
			<div id="header">
			
                <div><img src="{{asset('arogi/images/banner_BOC.jpg')}}" border="0" alt="DAVP Banner" style="width:100%" /></div>
			</div>
                                 		<!--End Webiste Banner-->
		</TD>
	</TR>
</TABLE>

        </div>
        <div class="row form-actions text-center">
            <h4>Feeback Form For Outreach Programs<br />
                Page-2 up
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
            <input type="hidden" name="myid" value="{{$id}}">
            <div class="row">
                <div class="span2">
                    <span id="lbl_doc_categ">Document TYpe</span>
                </div>
                <div class="span3">
                    <select name="document_type"  id="ddl_doc_categ">
                        <option selected="selected" value="0">--Select--</option>
                        <option value="PIC">Photographs of Event</option>
                        <option value="VID">Video Clips Of Event</option>
                        <option value="NEW">Newspaper cutting</option>

                    </select>
                </div>

            </div>
            <div class="row ">
                <div class="span2">
                    <span id="lbl_date_event">Date Of Event</span>
                </div>
                <div class="span3">
                    <input name="event_date" type="date" maxlength="10" id="txt_date_event" class="calendar1" />
                </div>
            </div>
            <div class="row ">
                <div class="span2">
                    <span id="lbl_venue_event">Venue Of Event</span></div>
                <div class="span3">
                    <input name="venue_event" type="text" maxlength="50" id="txt_venue_event" /></div>
            </div>
            <input type="hidden" name="created_date" value="{{date('m/d/Y h:i:s a', time())}}">
            <div class="row">
                <div class="span2">
                    <span id="lbl_file_upload">Click to add files</span></div>
                <div class="span3">
                    {{-- <input id="Button1" type="button" value="add" onclick="AddFileUpload()" /> --}}
                    <input id="Button1" type="button" value="add"  />
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
                <input type="submit" name="btnUpload" value="Save" id="btnUpload" class="btn btn-primary" />
                <input type="submit" name="btn_clear" value="Clear" id="btn_clear" class="btn btn-warning" />
                <input type="submit" name="btn_back" value="Back" id="btn_back" class="btn btn-inverse " />
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
</body>
</html>
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