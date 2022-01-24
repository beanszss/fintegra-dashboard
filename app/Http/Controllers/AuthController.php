<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Validator;

use function GuzzleHttp\json_encode;

class AuthController extends Controller
{
  public function index()
  {
    $pageConfigs = [
      'bodyClass' => "bg-full-screen-image",
      'blankPage' => true
    ];

    if (Auth::check()) {
      return redirect()->route('dashboard-home');;
    } else {
      return view('auth.login', [
        'pageConfigs' => $pageConfigs
      ]);
    }

  }
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|',
            'c_password'=>'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if($user->save()){
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
        }else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
      $pageConfigs = [
        'bodyClass' => "bg-full-screen-image",
        'blankPage' => true
      ];
      $request->validate([
          'email' => 'required|string|email',
          'password' => 'required|string',
          'remember_me' => 'boolean'
      ]);

      $credentials = [
        'email' => $request->email,
        'password' => $request->password
      ];

      $client = new Client([
        'base_uri' => 'http://fintegra-api.test/api/'
      ]);

      // $payload = file_get_contents('/profile')

      $response = $client->post('login', [
        // 'debug' => true,
        'json' => [
          'email' => $request->email,
          'password' => $request->password
        ],
        'headers' => [
                'csrf-token' => csrf_token(),
                // 'x-app-key'   => self::$appKey,
                // 'x-user-key'  => self::$userKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
         ]
      ]);

      $result = $response->getBody();
      $statusCode = $response->getStatusCode();
      $content = json_decode($result, true);

      if ($content['status'] === true) {
        return $content;
      } else {
        return view('auth.login', [
          'pageConfigs' => $pageConfigs
        ]);
      }


      // if(!Auth::attempt($credentials))
      //     return response()->json([
      //         'message' => 'Unauthorized'
      //     ], 401);
      // $user = $request->user();
      // $tokenResult = $user->createToken('Personal Access Token');
      // $token = $tokenResult->token;
      // if ($request->remember_me)
      //     $token->expires_at = Carbon::now()->addWeeks(1);
      // $token->save();
      // return response()->json([
      //     'access_token' => $tokenResult->accessToken,
      //     'token_type' => 'Bearer',
      //     'expires_at' => Carbon::parse(
      //         $tokenResult->token->expires_at
      //     )->toDateTimeString()
      // ]);
    }

    public function attempts(Request $request)
    {


    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
      return response()->json($request->user());
    }
}
