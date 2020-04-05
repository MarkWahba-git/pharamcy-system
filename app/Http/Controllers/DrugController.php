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
        $drugs = Drug::select('id','drug_name','drug_type','drug_unit_price');
        return Datatables::of($drugs)
        ->addColumn('action', function($drug){
            return '<a href="#" class="btn btn-xs btn-primary edit" id="'
            .$drug->id.'"><i class="glyphicon 
            glyphicon-edit"></i> Edit</a>
            <a href="#" class="btn btn-xs btn-danger delete" id="'
            .$drug->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>
            ';
        })
        ->make(true);
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
            if($request->get('button_action') == 'update')
            {
                $drug = Drug::find($request->get('form_drug_id'));
                $drug->drug_name = $request->get('form_drug_name');
                $drug->drug_type = $request->get('form_drug_type');
                $drug->drug_unit_price = $request->get('form_drug_unit_price')*1000;
                $drug->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    function fetchDrug(Request $request)
    {
        $id = $request->input('id');
        $drug = Drug::find($id);
        $output = array(
            'drug_name'    =>  $drug->drug_name,
            'drug_type'    =>  $drug->drug_type,
            'drug_unit_price'    =>  $drug->drug_unit_price/1000,
        );
        echo json_encode($output);
    }
    function deleteDrug(Request $request)
    {
        $drug = Drug::find($request->input('id'));
        if($drug->delete())
        {
            echo 'Drug Deleted';
        }
    }
}


