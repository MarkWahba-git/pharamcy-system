<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;
use validator;
use App\User;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon;
use App\Doctor;
class DoctorTabController extends Controller
{
    public function index(){
        
        $doctors=Doctor::join('pharmacies','pharmacies.id','doctors.pharmacy_id')
              ->join('users','users.id', '=','doctors.dr_user')
        ->where('users.role','doctor')->get();
           
           
           return view('doctorstab.index', compact('doctors'));
           
       }
         
       public function create(){
        $users=User::all();
        return view('doctorstab.create');
      }
      public function store(Request $request){


        $doctor=new User();
        $doctor=$request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $saveToDB= $request->only(['name', 'email','is_banned','nat_id','gender']);
          User::create($saveToDB);
        
        //    $doctor->name=$request->name;
        //    $doctor->email=$request->email;
        //    $doctor->is_banned=$request->is_banned;
        //    $doctor->nat_id=$request->dob;
        //    $doctor->gender=$request->gender;

        //  $doctor.save();

        return redirect()->route('doctorstab.index');
    }
      
       public function edit(Request $request){
            $id =$request->doctor;
            $doctor=User::find($id);
        
        return view('doctorstab.edit',[
            'doctor' => $doctor
            
           
        ]);
       }
      
       public function update(Request $request){
           $id =$request->doctor;
           $doctor=User::find($id);
           $doctor->name=$request->name;
           $doctor->email=$request->email;
           $doctor->is_banned=$request->is_banned;
           
          $doctor->save();
            
           return redirect()->route('doctorstab.index');
       
        }  
        public function ban(Request $request){
            
            $id =$request->doctor;
            $doctor=User::find($id);
           
            $doctor->is_banned=$request->is_banned;
           
             $doctor->save();
            
           return redirect()->route('doctorstab.index');
       
        }  
        public function destroy(Request $request){
                $id =$request->doctor;
                $doctor=User::find($id);
             
              $doctor->delete();
            return redirect()->route('doctorstab.index');    
           
            }
            function fetch_image($id)
             { 
                 
                $id =request()->doctor;
               
                $doctor=User::findOrFail($id);
                $image_file = Image::make($doctor->avatar);

                $response = Response::make($image_file->encode('jpeg'));

                $response->header('Content-Type', 'image/jpeg');

                return $response;
            }
}