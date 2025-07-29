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

    return view('admin', compact('contacs', 'categories'));
  }

  // 検索と結果の表示
  public function search(Request $request)
  {

    // dd($request->keyword,$request->gender_id,$request->category_id);

    if ($request->keyword === null  ||  $request->gender_id === null  ||  $request->category_id === null) {
      $contacs = Contact::with('category')->get();
    } elseif ($request->gender_id === 5) {
      // dd($request->keyword,$request->gender_id,$request->category_id);
      $contacs =  Contact::with('category')->CategorySearch($request->category_id)
        ->LastnameSearch($request->keyword)
        ->FirstnameSearch($request->keyword)
        ->EmailSearch($request->keyword)
        ->get();
    } else {
      // dd($request->keyword,$request->gender_id,$request->category_id);
      // $contacs =  Contact::with('category')->CategorySearch($request->category_id)
      // ->LastnameSearch($request->keyword)
      // ->FirstnameSearch($request->keyword)
      // ->EmailSearch($request->keyword)
      // ->GenderSearch($request->gender_id)
      // ->get();

      // $contacs =  Contact::with('category')->CategorySearch($request->category_id)->get();

      $contacs =  Contact::with('category')->CategorySearch($request->category_id)
        ->LastnameSearch($request->keyword)
        ->GenderSearch($request->gender_id)->get();
      if ($contacs === null) {
        $contacs =  Contact::with('category')->CategorySearch($request->category_id)
          ->FirstnameSearch($request->keyword)
          ->GenderSearch($request->gender_id)->get();
      } elseif ($contacs === null) {
        $contacs =  Contact::with('category')->CategorySearch($request->category_id)
          ->EmailSearch($request->keyword)
          ->GenderSearch($request->gender_id)->get();
      }
    }

    // $contacs = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
    $categories = Category::all();

    return view('admin', compact('contacs', 'categories'));
  }
}
