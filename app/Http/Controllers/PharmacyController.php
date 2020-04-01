<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pharmacy;

class PharmacyController extends Controller
{
    function index()
    {
        $pharmacies = Pharmacy::all();
        
        return view('pharmacies.index',[
            'pharmacies' => $pharmacies,
        ]);
    }

    function show()
    {
        $request = request();
        $pharmacyId = $request->pharmacy;
        $pharmacy = Pharmacy::find($pharmacyId);

        return view('pharmacies.show',[
            'pharmacy' => $pharmacy,
        ]);
    }
}
