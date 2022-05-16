<?php

namespace App\Http\Controllers\billing\AV_RadioMediabilling;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AVController extends Controller
{
    public function index(){
        return view('admin.pages.billing.AVMediaBilling.index');
    }
    public function create(){
        return view('admin.pages.billing.AVMediaBilling.create');
    }
}
