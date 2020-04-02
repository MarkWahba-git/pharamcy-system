<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use DataTables;
class DrugController extends Controller
{
    function index()
    {
       

        return view('drugs.index');
    }
    function getDrugs()
    {
        $drugs = Drug::all();
        return Datatables::of($drugs)->make(true);
    }
}
