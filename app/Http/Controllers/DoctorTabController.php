<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

use App\User;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;
use Image;

class DoctorTabController extends Controller
{
    public function index(){
        
        $doctors=Pharmacy::
           join('users', function ($join) {
               $join->on('users.nat_id', '=', 'pharmacies.owner_nat_id');
           })
           ->get();
           
           
           return view('doctorstab.index', compact('doctors'));
           
       }
      
       public function edit(Request $request){
        
        $id = $request->doctor;

        $doctor = User::get()->where('nat_id',$id)->first();
        
        return view('doctorstab.edit',[
            'doctor' => $doctor
            
           
        ]);
       }
      
       public function update(Request $request){
           $id =$request->doctor;
           $doctor = User::get()->where('nat_id',$id)->first();
           
           $doctor->name=$request->name;
          // $doctor->avatar=$request->avatar;
           $doctor->email=$request->email;
           $doctor->save();
            
           return redirect()->route('doctorstab.index');
       
        }  
        public function destroy(Request $request){
        
            $id =$request->doctor;
            
            $doctor = User::get()->where('nat_id',$id)->first();
             
              $doctor->delete();
            return redirect()->route('doctorstab.index');    
           
            }
            function fetch_image($id)
             {
               // $doctor = User::findOrFail($image_id);
                $doctor = User::get()->where('nat_id',$id)->first();

                $image_file = Image::make($doctor->avatar);

                $response = Response::make($image_file->encode('jpeg'));

                $response->header('Content-Type', 'image/jpeg');

                return $response;
            }
}