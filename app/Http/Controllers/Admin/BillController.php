<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        // Trả về view danh sách hóa đơn
        return view('admins.bills.index');
    }

    
}
