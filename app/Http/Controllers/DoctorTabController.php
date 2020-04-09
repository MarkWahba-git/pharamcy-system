<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

use App\User;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon;
use App\Doctor;
class DoctorTabController extends Controller
{
    public function index(){
        
        $doctors=Pharmacy::
           join('doctors','doctors.pharmacy_id', '=','pharmacies.id')
           ->get();
           
           
           return view('doctorstab.index', compact('doctors'));
           
       }
      
       public function edit(Request $request){
            $id =$request->doctor;
            $doctor=Doctor::find($id);
        
        return view('doctorstab.edit',[
            'doctor' => $doctor
            
           
        ]);
       }
      
       public function update(Request $request){
           $id =$request->doctor;
           $doctor=Doctor::find($id);
           $doctor->name=$request->name;
           $doctor->email=$request->email;
           $doctor->is_banned=$request->is_banned;
           
          $doctor->save();
            
           return redirect()->route('doctorstab.index');
       
        }  
        public function ban(Request $request){
            $id =$request->doctor;
            $doctor=Doctor::find($id);
           
            $doctor->is_banned=$request->is_banned;
           
             $doctor->save();
            
           return redirect()->route('doctorstab.index');
       
        }  
        public function destroy(Request $request){
                $id =$request->doctor;
                $doctor=Doctor::find($id);
             
              $doctor->delete();
            return redirect()->route('doctorstab.index');    
           
            }
            function fetch_image($id)
             {
                $id =request()->doctor;
                 
                $doctor=Doctor::find($id);
                $image_file = Image::make($doctor->image);

                $response = Response::make($image_file->encode('jpeg'));

                $response->header('Content-Type', 'image/jpeg');

                return $response;
            }
}