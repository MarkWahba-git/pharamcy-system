<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use DataTables;
use Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function getUsers()
    {
        $users = User::select(
            'name',
            'email',
            'password',
            'role',
            'street_name',
            'building_number',
            'floor_number',
            'flat_number',
            'area_id',
            'nat_id',
        );
        return Datatables::of($users)->make(true)
            ->addColumn('action',function($user){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$user->id.'">
                        <i class="glyphicon glyphicon-edit"></i> Edit</a>
                        <a href="#" class="btn btn-xs btn-danger delete"
                        id="'.$user->id.'"><i class="glyphicon glyphicon-remove">
                        </i>Delete</a>';                  
            })
            ->make(true);
    }

    public function postUsers(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'              => 'required',
            'email'             => 'required',
            'password'          => 'required',
            'role'              => 'required',
            'street_name'       => 'required',
            'building_number'   => 'required',
            'floor_number'      => 'required',
            'flat_number'       => 'required',
            'nat_id'            => 'required',
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
                User::create($validation);
                // $user = new User([
                //     'name'              => $request->get('name'),
                //     'email'             => $request->get('email'),
                //     'password'          => $request->get('password'),
                //     'role'              => $request->get('role'),
                //     'street_name'       => $request->get('street_name'),
                //     'building_number'   => $request->get('building_number'),
                //     'floor_number'      => $request->get('floor_number'),
                //     'flat_number'       => $request->get('flat_number'),
                //     'nat_id'            => $request->get('nat_id'),
                // ]);
                // $user->save();
                // $success_output = '<div class="alert alert-success">User inserted</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $user = User::find($request->get('user_id'));
                $user->name             = $request->get('name');
                $user->email            = $request->get('email');
                $user->password         = $request->get('password');
                $user->role             = $request->get('role');
                $user->street_name      = $request->get('street_name');
                $user->building_number  = $request->get('building_number');
                $user->floor_number     = $request->get('floor_number');
                $user->flat_number      = $request->get('flat_number');
                $user->nat_id           = $request->get('nat_id');
                $user->save();
                $success_output = '<div class="alert alert-success">User Updated</div>';
            }
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function fetchUsers(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
        $output = array(
            'name'              =>  $user->name,
            'email'             =>  $user->email,
            'password'          =>  $user->password,
            'role'              =>  $user->role,
            'street_name'       =>  $user->street_name,
            'building_number'   =>  $user->building_number,
            'floor_number'      =>  $user->floor_number,
            'flat_number'       =>  $user->flat_number,
            'nat_id'            =>  $user->nat_id
        );
        echo json_encode($output);
    }

    public function removeUser(Request $request)
    {
        $user = User::find($request->input('id'));
        if($user->delete())
        {
            echo 'User Deleted';
        }
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
        
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $user = User::updateOrCreate(
    //                         ['id' => $request->id],
    //                         [  
    //                             'name' => $request->name,
    //                             'email' => $request->email, 
    //                             'password' => $request->password, 
    //                             'role' => $request->role,
    //                             'street_name' => $request->street_name,
    //                             'building_number' => $request->building_number,
    //                             'floor_number' => $request->floor_number,
    //                             'flat_number' => $request->flat_number,
    //                             'area_id' => $request->area_id,
    //                             'nat_id' => $request->nat_id,
    //                         ]);        
    //     return Response::json($doctor);
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
        
    // }


    // public function edit($id)
    // {
    //     $place = array('id' => $id);
    //     $user  = User::where($place)->first();
    //     return Response::json($doctor);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $user = User::where('id',$id)->delete();
    //     return Response::json($user);
    // }
}
