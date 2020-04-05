<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StorePharmacyRequest;
use App\Pharmacy;
use App\User;
use App\Area;

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

    function create()
    {
        $users = User::all();
        $areas = Area::all();
        return view('pharmacies.create', [
            'users' => $users,
            'areas' => $areas,
        ]);

    }

    function store(StorePharmacyRequest $request)
    {
        Pharmacy::create([
            'name' => $request->name,
            'street_name' => $request->street_name,
            'building_number' => $request->building_number,
            'owner_nat_id' => $request->owner_nat_id,
            'area_id' => $request->area_id,
            'priority_area_id' => $request->priority_area_id,
        ]);

        return redirect()->route('pharmacies.index');
    }
}
