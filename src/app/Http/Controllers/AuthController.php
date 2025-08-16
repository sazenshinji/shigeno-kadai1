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
    $contacts = Contact::with('category')->paginate(7);
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
  }

  // 検索と結果の表示
  public function search(Request $request)
  {

    //「reset」が押された時は、「/admin」へ リダイレクトする。
    if ($request->has('reset')) {
      return redirect('/admin');
    }

    //gender_id = 4:はその他なので、性別での検索はしない。
    if ($request->gender_id === '4') {
      $request["gender_id"] = null;
    }

    //フルネーム検索のため、入力 keywordの半角スペースと全角スペースを除去する。
    $cleaned = preg_replace('/[ 　]+/u', '', $request->keyword);
    // dd($cleaned);

    //クエリビルダーのインスタンスを作成
    $query = Contact::query();

    // フルネーム(部分一致なので姓単体でも名単体でも)、email で検索
    $query->where(function ($query_kw) use ($cleaned) {
      $query_kw->whereRaw("REPLACE(CONCAT(last_name, first_name), ' ', '') LIKE ?", ["%{$cleaned}%"])
        ->orWhere('email', 'LIKE', "%{$cleaned}%");
    });
    // 性別 で検索
    if (!empty($request->gender_id)) {
      $query->where('gender', '=', $request->gender_id);
    }
    // お問い合わせの種類 で検索
    if (!empty($request->category_id)) {
      $query->where('category_id', '=', $request->category_id);
    }
    // 年月日 で検索
    if (!empty($request->date)) {
      $query->whereDate('created_at', '=', $request->date);
    }

    $contacts = $query->paginate(7);
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
  }

  // 管理画面(Admin)のモーダルウィンドウで[削除]が押された時の処理
  public function destroy(Request $request)
  {
    Contact::find($request->id)->delete();
    return redirect('/admin');
  }
}
