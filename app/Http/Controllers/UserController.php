<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public $webAppFlag;
    function __construct() {
        if(isset($_POST['webAppFlag']))
            $this->webAppFlag = true;
        else
            $this->webAppFlag = false;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string',
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'email.email' => 'Format email tidak sesuai',
                'password.required' => 'Password harus diisi',
            ]
        );

        if($validator->fails()){
            if($this->webAppFlag)
                return redirect('login-page')->with('message', $validator->errors()->first());
            else
                return response()->json(array('status'=>'fail','message'=>$validator->errors()->first()), 400);
        }

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                if($this->webAppFlag)
                    return redirect()->back()->with(['warning' => 'Username atau password yang anda ketik salah.']);
                else
                    return response()->json(array('status'=>'fail','message'=>'Username atau password yang anda ketik salah.'), 400);
            }
        } catch (JWTException $e) {
            return response()->json(array('status'=>'fail','message'=>'Silahkan hubungi Team Support SAMO.'), 500);
        }

        $userData = User::where('email',$request->email)->first();

        if($this->webAppFlag) {
            $request->session()->put('tokenJwt', $token);
            return redirect('pks-page');
        } else {
            return response()->json(array(
                'status'=>'success',
                'userId'=>strval($userData->id),
                'roleId'=>$userData->roleId,
                'message'=>'Login berhasil.',
                'tokenJwt'=>$token,
            ), 200);
        }

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'email.email' => 'Format email tidak sesuai',
                'password.required' => 'Password harus diisi',
                'password.confirmed' => 'Password yang anda input tidak sama',
                'password.min' => 'Password minimal 6 karakter'
            ]
        );
        //echo $validator->errors()->first(); die();
        if($validator->fails()){
            return response()->json(array('status'=>'fail','message'=>$validator->errors()->first()), 400);
        }

        $user = new User();
        $user->email = $request->email;
        $user->password = Hash::make($request->get('password'));
        $user->role_id = 2; //2 = role_id untuk mitra_tani
        $user->code_confirmation = rand(1001,9999);
        $user->save();
        $user->profile()->create([
            'full_name'=>$request->full_name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number
        ]);

        $toUser = $user->select('email','code_confirmation')->where('id', $user->id)->first();
        //$token = JWTAuth::fromUser($toUser);

        return response()->json(compact('user'),201);
        //return response()->json($toUser,201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }
}
