<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AuthController extends Controller
{

  // 管理画面(Admin)の表示
  public function login()
  {
    $contacts = Contact::with('category')->get();
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
  }

  // 検索と結果の表示
  public function search(Request $request)
  {

    // dump($request->keyword);
    // dump($request->gender_id);
    // dump($request->category_id);
    // dump($request->date);

    if ($request->has('reset')) {
      return redirect('/admin');
    }

    if ($request->gender_id === '4') {
      $request["gender_id"] = null;
    }

    // $query = Contact::query();


    // $query = $this->getSearchQuery($request, $query);
    // if (!empty($request->keyword)) {
    // $query->where('first_name', 'like', '%' . $request->keyword . '%')
    // ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
    // ->orWhere('email', 'like', '%' . $request->keyword . '%');
    // }


// AI：Laravel8 Eloquentでクエリービルダーに検索条件を設定する例

    if (!empty($request->keyword)) {
      $query = Contact::query()->where('first_name', 'like', '%' . $request->keyword . '%')
                              ->orWhere('last_name', 'like', '%' . $request->keyword . '%');
    // }

    // if (!empty($request->keyword)) {

    }

    // if (!empty($request->keyword)) {
    // $query->orWhere('email', 'like', '%' . $request->keyword . '%');
    // }


    if (!empty($request->gender_id)) {
      $query->where('gender', '=', $request->gender_id);
    }

    if (!empty($request->category_id)) {
      $query->where('category_id', '=', $request->category_id);
    }

    if (!empty($request->date)) {
      $query->whereDate('created_at', '=', $request->date);
    }



    dump($query);


    $contacts = $query->get();


    // $contacs_Lastname =  Contact::with('category')->LastnameSearch($request->keyword)->GenderSearch($request->gender_id)->CategorySearch($request->category_id)->DateSearch($request->date)->get();
    // $contacs_Firstname =  Contact::with('category')->FirstnameSearch($request->keyword)->GenderSearch($request->gender_id)->CategorySearch($request->category_id)->DateSearch($request->date)->get();
    // $contacs_Email =  Contact::with('category')->EmailSearch($request->keyword)->GenderSearch($request->gender_id)->CategorySearch($request->category_id)->DateSearch($request->date)->get();
    // $contacs = collect($contacs_Lastname)
    // ->keyBy('id')
    // ->merge(collect($contacs_Firstname)->keyBy('id'))
    // ->merge(collect($contacs_Email)->keyBy('id'))
    // ->all();

    $categories = Category::all();



    return view('admin', compact('contacts', 'categories'));
  }
}
