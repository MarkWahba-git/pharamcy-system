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
            'avatar'            => 'required',
            'nat_id'            => 'required',
            'name'              => 'required',
            'email'             => 'required',
            'dob'               => 'required',
            'gender'            => 'required',
            'phone_number'      => 'required',
            'password'          => 'required',
            'role'              => 'required',
            'is_banned'         => 'required',
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
                // User::create($validation);
                $user = new User([
                    'nat_id'            => $request->get('nat_id'),
                    'avatar'            => $request->get('avatar'),
                    'name'              => $request->get('name'),
                    'email'             => $request->get('email'),
                    'dob'               => $request->get('dob'),
                    'gender'            => $request->get('gender'),
                    'phone_number'      => $request->get('phone_number'),
                    'password'          => $request->get('passwod'),
                    'role'              => $request->get('role'),
                    'is_banned'         => $request->get('is_banned'),
                ]);
                $user->save();
                $success_output = '<div class="alert alert-success">User inserted</div>';
            }

            if($request->get('button_action') == 'update')
            {
                $user = User::find($request->get('user_id'));
                $user->avatar           = $request->get('avatar');
                $user->nat_id           = $request->get('nat_id');
                $user->name             = $request->get('name');
                $user->email            = $request->get('email');
                $user->dob              = $request->get('dob');
                $user->gender           = $request->get('gender');
                $user->phone_number     = $request->get('phone_number');
                $user->password         = $request->get('password');
                $user->role             = $request->get('role');
                $user->is_banned        = $request->get('is_banned');
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
            'nat_id'            =>  $user->nat_id,
            'name'              =>  $user->name,
            'email'             =>  $user->email,
            'dob'               =>  $user->dob,
            'gender'            =>  $user->gender,
            'phone_number'      =>  $user->phone_number,
            'password'          =>  $user->password,
            'role'              =>  $user->role,
            'is_banned'         =>  $user->is_banned,
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
    
}
