<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Response;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(User::select('*'))
            ->addColumn('action', 'DataTables.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::updateOrCreate(
                            ['id' => $request->id],
                            [  
                                'name' => $request->name,
                                'email' => $request->email, 
                                'password' => $request->password, 
                                'role' => $request->role,
                                'street_name' => $request->street_name,
                                'building_number' => $request->building_number,
                                'floor_number' => $request->floor_number,
                                'flat_number' => $request->flat_number,
                                'area_id' => $request->area_id,
                                'nat_id' => $request->nat_id,
                            ]);        
        return Response::json($doctor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }


    public function edit($id)
    {
        $place = array('id' => $id);
        $user  = User::where($place)->first();
        return Response::json($doctor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
        return Response::json($user);
    }
}
