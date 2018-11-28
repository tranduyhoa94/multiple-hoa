<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use App\Models\User;

class OAuthController extends AppBaseController
{
	private $userRepository;

	public function __construct(UserRepository $userDashRepo)
    {
        config([
            'services.github.redirect' => route('oauth.callback', 'github'),
            'services.google.redirect' => route('oauth.callback', 'google'),
            'services.facebook.redirect' => route('oauth.callback', 'facebook'),
        ]);
    	$this->userRepository = $userDashRepo;
    }


      /**
     * Redirect the user to the provider authentication page.
     *
     * @param  string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {

        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return [
            'url' => $url,
        ];
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param  string $driver
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $sUser = Socialite::driver($provider)->stateless()->user();

        $user = $this->findUser($sUser, $provider);

        if ($user) {

            return view('oauth/callback')->with('data', $user->toArray());
        }
        
        return $this->sendError('User not found');
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
        
            $this->reNewToken($user);
            
            $user = User::where('email', $user->email)->first();

            return $user;

        } else {

            User::create([
                'email' => $user->email,
                'first_name' => 'SFR',
                'last_name' => $user->name,
                'provider' => $service
            ]);

            $this->reNewToken($user);

            $user = User::where('email', $user->email)->first();

            return $user;
        }
        return false;
    } 

    /**
     * Function rework new token.
     * function reNewToken($user)
     *
     * @param  int $user
     *
     * @return Response
     */
    public function reNewToken($user){
        $user = User::where('email', $user->email)->first();
        $user->access_token = $user->generateAccessToken();
        $user->save();
    }
}
