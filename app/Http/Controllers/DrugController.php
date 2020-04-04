<?php

namespace App\Http\Controllers;
use Validator;
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
    function addDrug(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'form_drug_name' => 'required',
            'form_drug_type'  => 'required',
            'form_drug_unit_price'  => 'required|numeric',
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            if($request->get('button_action') == "create")
            {
                $drug = new Drug([
                    'drug_name'    =>  $request->get('form_drug_name'),
                    'drug_type'     =>  $request->get('form_drug_type'),
                    'drug_unit_price'     =>  ($request->get('form_drug_unit_price')*1000)
                ]);
                $drug->save();
                $success_output = '<div class="alert alert-success">Drug Inserted</div>';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
}
