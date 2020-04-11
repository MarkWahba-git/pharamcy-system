<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Pharmacy;
use DataTables;
use Validator;
use App\User;
use App\Area;

class PharmacyController extends Controller
{
    public function index()
    {
        $users = User::all();
        $areas = Area::all();

        return view('pharmacies.index',[
            'users' => $users,
            'areas' => $areas,
        ]);
    }

    public function getPharmacies()
    {
        $pharmacies = Pharmacy::select(
            'name',
            'street_name',
            'building_number',
            'owner_id',
            'area_id',
        );
        return Datatables::of($pharmacies)
            ->addColumn('action',function($pharmacy){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$pharmacy->id.'">
                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-danger delete"
                        id="'.$pharmacy->id.'"><i class="glyphicon glyphicon-remove">
                        </i>Delete</a>';                  
            })
            ->make(true);
    }

    public function postPharmacies(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'              => 'required',
            'street_name'       => 'required',
            'building_number'   => 'required',
            'owner_id'          => 'required',
            'area_id'           => 'required',
        ]);

        $error_array = array();
        $success_output = '';
        if($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            if($request->get('button_action') == "insert")
            {
                $pharmacy = new Pharmacy([
                    'name'              => $request->get('name'),
                    'street_name'       => $request->get('street_name'),
                    'building_number'   => $request->get('building_number'),
                    'owner_id'          => $request->get('owner_id'),
                    'area_id'           => $request->get('area_id'),
                ]);
                $pharmacy->save();
                $success_output = '<div class="alert alert-success">Pharmacy inserted</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $pharmacy = Pharmacy::find($request->get('pharmacy_id'));
                $pharmacy->name             = $request->get('name');
                $pharmacy->street_name      = $request->get('street_name');
                $pharmacy->building_number  = $request->get('building_number');
                $pharmacy->owner_id         = $request->get('owner_id');
                $pharmacy->area_id          = $request->get('area_id');
                $pharmacy->save();
                $success_output = '<div class="alert alert-success">Pharmacy Updated</div>';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function fetchPharmacies(Request $request)
    {
        $id = $request->input('id');
        $pharmacy = Pharmacy::find($id);
        $output = array(
            'name'              =>  $pharmacy->name,
            'street_name'       =>  $pharmacy->street_name,
            'building_number'   =>  $pharmacy->building_number,
            'owner_id'          =>  $pharmacy->owner_id,
            'area_id'           =>  $pharmacy->area_id
        );
        echo json_encode($output);
    }

    public function removePharmacy(Request $request)
    {
        $pharmacy = Pharmacy::find($request->input('id'));
        if($pharmacy->delete())
        {
            echo 'Pharmacy Deleted';
        }
    }

}
