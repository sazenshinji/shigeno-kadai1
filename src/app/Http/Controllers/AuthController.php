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
    $contacs = Contact::with('category')->get();
    $categories = Category::all();

    return view('admin', compact('contacs', 'categories'));
  }

  // 検索と結果の表示
  public function search(Request $request)
  {

    dump($request->keyword);
    dump($request->gender_id);
    dump($request->category_id);
    dump($request->date);

    if ($request->gender_id === '4'){
      $request["gender_id"] = null;
    }

    // どれかの項目が Nullの場合(検索欄に全て入力した状態ではない場合)：検索しない＝全件表示。
    // 全てブランクの状態での検索：条件を入力せずに検索する＝全件表示。
    // if ($request->keyword === null  ||  $request->gender_id === null  ||  $request->category_id === null  ||  $request->date === null) {
    // $contacs = Contact::with('category')->get();
    // dump('全件表示');
    // }

    // 検索欄に全て入力した状態：各項目で検索し、結果をマージする。
    // ただし、($request->gender_id === 4) 性別検索が「全て」の時は性別の検索結果は加えない。

    // AI質問：Laravel8 phpで二次元連想配列をある要素で検索する方法
    // AI質問：Laravel8 phpで複数の二次元連想配列を結合する方法
    // AI質問：Laravel 8（PHP）で「複数の二次元連想配列を キー（idなど）で一致する要素を上書きしながら結合する


    // else {

    $contacs_Lastname =  Contact::with('category')->LastnameSearch($request->keyword)->GenderSearch($request->gender_id)->CategorySearch($request->category_id)->DateSearch($request->date)->get();

    $contacs_Firstname =  Contact::with('category')->FirstnameSearch($request->keyword)->GenderSearch($request->gender_id)->CategorySearch($request->category_id)->DateSearch($request->date)->get();

    $contacs_Email =  Contact::with('category')->EmailSearch($request->keyword)->GenderSearch($request->gender_id)->CategorySearch($request->category_id)->DateSearch($request->date)->get();

    $contacs = collect($contacs_Lastname)
      ->keyBy('id')
      ->merge(collect($contacs_Firstname)->keyBy('id'))
      ->merge(collect($contacs_Email)->keyBy('id'))
      ->all();



    // }

    // 検索結果のマージ
    // $contacs = array_merge($contac_category_id, $contac_Lastname);
    $categories = Category::all();



    return view('admin', compact('contacs', 'categories'));
  }
}
