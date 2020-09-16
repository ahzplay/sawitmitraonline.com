<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
   public function index() {
       return view('login');
   }

   public function loginAction(Request $request) {
       //http://localhost:8000/api/login
       $endPoint = 'api/login';
       $response = Http::withHeaders([
           'Authorization' => 'foo',
       ])->post(env('BACKEND_URL').$endPoint,
           [
               'email' => $request->email,
               'password' => $request->password,
           ]
       );

       $response = json_decode($response->body());

       return response()->json($response);

   }

   public function logoutAction(Request $request) {
       //http://localhost:8000/api/login
       $endPoint = 'api/logout';
       $response = Http::withHeaders([
           'Authorization' => 'Bearer ' . $request->session()->get('tokenJwt'),
       ])->post(env('BACKEND_URL').$endPoint,
           [
               'email' => $request->email,
               'password' => $request->password,
           ]
       );

       $response = json_decode($response->body());
       if($response->status){
           $request->session()->flush();
           return redirect('login-page');
       }

   }
}
