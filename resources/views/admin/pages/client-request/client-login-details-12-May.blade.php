@extends('admin.layouts.layout')

@section('content')

<div class="content-inside p-3" style="height: 85%;">
  <div class="card shadow mb-4" style="height: 85%;">
  	<div style="margin-top: 10%;">
  		<h1 class="text-center" style="font-weight: 800;">Welcome to the ministry of</h1>
  		<h2 class="text-center" style="font-weight: 600;">{{$ministry_Code->ministry_name}}</h2>
  		<p class="text-center" style="color: #808080;">{{Session::get('HeadName')}}</p>
  	</div>
  </div>
 </div>
@endsection