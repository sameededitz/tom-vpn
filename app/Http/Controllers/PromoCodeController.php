<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promos = PromoCode::all();
        return view('admin.all-promo', compact('promos'));
    }

    public function deleteCode(PromoCode $code)
    {
        $code->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Code deleted successfully'
        ]);
    }
}
