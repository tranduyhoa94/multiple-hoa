<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Auth;

class LoginController extends AppBaseController
{

    public function __construct(){
        include_once(app_path().'/Libraries/includes/ChipVN/ClassLoader/Loader.php');
    }

 	public function login(Request $request) {

 		$credentials = $request->only(['email', 'password']);

        try{
            if (! $token = auth()->attempt($credentials)) {
                return $this->responseError('Password incorrect.');
            }
        } catch (\Exception $e){
            return $this->responseError('Something error. Please try again!');
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

    public function test(){

        \ChipVN_ClassLoader_Loader::registerAutoload();     
        $callback = 'http' . (getenv('HTTPS') == 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];


        $uploader = new \ChipVN_ImageUploader_Plugins_Flickr();
        //$api = random_element($config['api_keys']);
        $api = [
            'key' => env('FLICKR_CLIENT_ID'),
            'secret' => env('FLICKR_CLIENT_SECRET'),
        ];
        $uploader->setApi($api['key']);
        $uploader->setSecret($api['secret']);
        $token = $uploader->getOAuthToken($callback);
  //       "oauth_token" => "72157673554672537-7bd19e2542ff71e8"
  // "oauth_token_secret" => "307346b3555f636b"
  // "user_nsid" => "143591056@N04"
        dd($token); 

    }
}
