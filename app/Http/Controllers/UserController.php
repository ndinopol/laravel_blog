<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
   
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
            //$this->middleware('auth');
        }

        public function googleLogin(Request $request)  {

            $google_redirect_url = route('glogin');
            
            $gClient = new \Google_Client();
            $gClient->setApplicationName(config('app.name'));
            $gClient->setClientId(config('services.google.client_id'));
            $gClient->setClientSecret(config('services.google.client_secret'));
            $gClient->setRedirectUri(config('services.google.redirect'));
            $gClient->setDeveloperKey(config('services.google.api_key'));
            
            $gClient->setScopes(array(
                'https://www.googleapis.com/auth/plus.me',
                'https://www.googleapis.com/auth/userinfo.email',
                'https://www.googleapis.com/auth/userinfo.profile',
            ));
            
            
            $google_oauthV2 = new \Google_Service_Oauth2($gClient);
                    
            if ($request->get('code')){
                $gClient->authenticate($request->get('code'));
                $request->session()->put('token', $gClient->getAccessToken());
            }
            
            if ($request->session()->get('token'))
            {
                $gClient->setAccessToken($request->session()->get('token'));
            }
            
            if ($gClient->getAccessToken())
            {
                //For logged in user, get details from google using access token
                $gUser = $google_oauthV2->userinfo->get();  
                  
                    $request->session()->put('name', $gUser['name']);
                    if ($user = User::where('email',$gUser['email'])->first())
                    {
                        //Auth::login($user);
                    }else{
                        $user = new User();
                        $name = $gUser['givenName'].' '.$gUser['familyName'];
                        $user->name = $name;
                        $user->email = $gUser['email'];
                        $user->picture = $gUser['picture'];
                        $user->remember_token = $gClient->getAccessToken()['access_token'];
                        $user->password = 
                        $user->save();
                    }               
             return redirect()->route('user.glist');          
            } else
            {
                //For Guest user, get google login url
                $authUrl = $gClient->createAuthUrl();
                print($authUrl);
                exit;
                return redirect()->to($authUrl);
            }
        }

        public function listGoogleUser(Request $request){
          $users = User::orderBy('id','DESC')->paginate(1);
         return view('users',compact('users'))->with('i', ($request->input('page', 1) - 1) * 1);;
        }
}