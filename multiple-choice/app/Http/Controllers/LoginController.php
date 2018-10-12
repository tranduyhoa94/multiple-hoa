<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Auth;

class LoginController extends AppBaseController
{
 	public function login(Request $request) {

 		$credentials = $request->only(['email', 'password']);
        try{
            if (! $token = auth()->attempt($credentials)) {
                return $this->sendError('Password incorrect.');
            }
        } catch (\Exception $e){
            return $this->sendError('Something error. Please try again!');
        }
        $data = [
            'status' => $token,
            'user' => auth()->user(),
        ];
        $this->reNewToken();
        return $this->sendResponse($data, 'Users retrieved successfully');
 	} 

 	public function reNewToken(){
        $user = \Auth::user();
        $user->access_token = $user->generateAccessToken();
        $user->save();
    }  
}
