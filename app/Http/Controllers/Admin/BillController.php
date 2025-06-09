<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;

class BillController extends Controller
{
    public function index()
    {
        
        $bills = Bill::with('user')->orderByDesc('created_at')->paginate(5);
        return view('admins.bills.index', compact('bills'));
    }

    public function show($id)
    {
        $bill = Bill::with(['user', 'order'])->findOrFail($id);
        return view('admins.bills.show', compact('bill'));
    }
    
}
