<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{

  // 管理画面の表示
  public function login()
  {
    // $contacs = Contact::all();
    $contacs = Contact::with('category')->get();
    $categories = Category::all();

    return view('admin', compact('contacs','categories'));
  }

}
