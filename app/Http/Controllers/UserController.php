<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
   
        public function index(Request $request){
            $user = array(
                      'name' => null,
                      'email' => null,
                      'code' => null
                  );
              
              if( $request->session()->get('email') ){
                  $user = array(
                      'name' => $request->session()->get('name'),
                      'email' => $request->session()->get('email'),
                      'code' => $request->session()->get('code')
                  );
              }
              return \View::make('index', compact('user', $user));
        }
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
            if( !$request->session()->get('email') ){
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
                
                
                if ($request->get('code')){
                    $gClient->authenticate($request->get('code'));
                    $request->session()->put('code', $request->get('code'));
                    $request->session()->put('token', $gClient->getAccessToken());
                }
                
                if ($request->session()->get('token'))
                {
                    $gClient->setAccessToken($request->session()->get('token'));
                }
                          
                
                if ($gClient->getAccessToken() && $request->session()->get('token'))
                {
                
                    $google_oauthV2 = new \Google_Service_Oauth2($gClient);
                
                    //For logged in user, get details from google using access token
                    $gUser = $google_oauthV2->userinfo->get();  
                    
                        $request->session()->put('name', $gUser['name']);
                        $request->session()->put('email', $gUser['email']);

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
                    return redirect()->route('user.posts');          
                
                } else
                {
                    //For Guest user, get google login url
                    $authUrl = $gClient->createAuthUrl();
                    return redirect()->to($authUrl);
                }
            }else{
               return redirect()->route('index');          
            }
        }

       public function logout(Request $request){
           
           $request->session()->forget('code');
           $request->session()->forget('name');
           $request->session()->forget('email');
           $request->session()->forget('token');
           
           //print_r($request->session());exit;
           return redirect()->route('index');
       } 
}