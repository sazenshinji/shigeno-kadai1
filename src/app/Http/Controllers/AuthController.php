<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

  // Login画面の表示
  public function login()
  {
    return view('admin');
  }

}
