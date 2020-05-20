<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Company;
use App\Login;

class companyController extends Controller
{
    



    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }else{
                
               //HACER PARA GUARDAR EL ULTIMO TOKEN LOGUEADO
       
    
             
            }

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    


    public function getAuthenticatedUser()
    {
        try {
            if (!$companys= JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('companys'));
    }




    public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                
                'email' => 'required|string|email|max:255|unique:companys',
                'password' => 'required|string',
                'name' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'phone' => 'required|integer',
                'manager' => 'required|string|max:255',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $companys = new Company();
             
        $companys["email"] = $request->input('email');
        $companys["password"] = Hash::make($request->input('password'));
        $companys["name"] = $request->input('name');
        $companys["city"] = $request->input('city');
        $companys["address"] = $request->input('address');
        $companys["phone"] = $request->input('phone');
        $companys["manager"] = $request->input('manager');
       

        $companys->save();

            $token = JWTAuth::fromUser($companys);
            return response()->json(compact('companys','token'),201);
        }


        public function logout()
        {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        }

/*
    public function create(Request $request){
        $companys = new Company();
             
        $companys["email"] = $request->input('email');
        $companys["password"] = Hash::make($request->input('password'));
        $companys["name"] = $request->input('name');
        $companys["city"] = $request->input('city');
        $companys["address"] = $request->input('address');
        $companys["phone"] = $request->input('phone');
        $companys["manager"] = $request->input('manager');
       

        $companys->save();
        return response()->json($companys);
    }*/

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
            $companys["password"] = Hash::make( $request->input('password'));
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
        if($request->input('token')){
            $companys["remember_token"] = $request->input('token');
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
