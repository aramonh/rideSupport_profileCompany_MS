<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Login;

class companyController extends Controller
{
    
    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $companys= Login::where('email',$email)->first();

            if($companys==""){
                return response("Username/Email does not exist, please register.");
            }else{
                if($companys["password"]!=$password) {
                    return response("The password is wrong, try again with another one.");
                }else{
                    //TODO Devolver TOKENs
                    return response("Authorizated");
                    //return response()->json($companys);
                }
            }
            return 0;
    }

    public function create(Request $request){
        $companys = new Company();
             
        $companys["email"] = $request->input('email');
        $companys["password"] = $request->input('password');
        $companys["name"] = $request->input('name');
        $companys["city"] = $request->input('city');
        $companys["address"] = $request->input('address');
        $companys["phone"] = $request->input('phone');
        $companys["manager"] = $request->input('manager');
       

        $companys->save();
        return response()->json($companys);
    }

    public function getAll(){
        $companys= Company::all();
        return response()->json($companys);
    }

  
    public function getById($id){
        $companys= Company::find($id);
        return response()->json($companys);
    }

    public function updateById($id, Request $request){
        $companys= Company::find($id);
       
        
        if($request->input('email')){
            $companys["email"] = $request->input('email');
        }
        if($request->input('password')){
            $companys["password"] = $request->input('password');
        }
        if($request->input('name')){
            $companys["name"] = $request->input('name');
        }
        if($request->input('city')){
            $companys["city"] = $request->input('city');
        }
        if($request->input('address')){
            $companys["address"] = $request->input('address');
        }
        if($request->input('phone')){
            $companys["phone"] = $request->input('phone');
        }
        if($request->input('manager')){
            $companys["manager"] = $request->input('manager');
        }
        
        
       
        
        
    
        $companys->save();
        return response()->json($companys);
    }



    public function deleteById($id, Request $request){
        $companys= Company::find($id);
        $companys->delete();
        return response()->json($companys);
    }
}
