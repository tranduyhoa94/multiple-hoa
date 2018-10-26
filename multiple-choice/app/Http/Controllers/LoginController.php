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

       /**
     * Find user by email and rework new token.
     * function findUser($user, $service)
     *
     * @param  int $user
     * @param  int $service
     *
     * @return Response
     */
    public function findUser($user, $service)
    {
        $authUser = User::where('email', $user->email)->first();
        if ($authUser) {
            if(!$authUser->src){
                $authUser->src = $user->avatar;
                $authUser->save();
            }
            $this->reNewToken($user);
            
            $user = User::where('email', $user->email)->first();
            return $user;
        }
        return false;
    } 
     /**
     * Return link google api.
     * POST|HEAD callBack($user)
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function callBack(Request $request) { 
        
        $user = \Socialite::driver('google')->stateless()->user();
            $authUser = $this->findUser($user, 'google');
            
        if($authUser) {
            return response()->json($authUser, 200);
            
        } 
        return $this->sendError('User not found');
    } 

    /**
     * Function check access_token.
     * function checkLogin(Request $request)
     *
     *
     * @return Response
     */

    public function checkLogin(Request $request) {

        $jwtToken = \Request::header('Authorization');
        
        $tokenHeader = explode('Bearer ' ,$jwtToken);

        $token = $tokenHeader[1];

        if($jwtToken) {

            $user = User::where('access_token', $token)->first();
            
            if(!$user)
                return \Response::json(['success' => true]);

            return \Response::json(['success' => false]);
        }
        
        return \Response::json(['success' => true]);
    }  
}
