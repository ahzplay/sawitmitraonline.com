<?php


namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function index() {
       return view('login');
   }
}
