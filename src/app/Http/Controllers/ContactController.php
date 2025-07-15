<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
  // お問い合わせフォーム入力画面の表示
  public function index()
  {
    $contacts = Contact::with('category')->get();
    $categories = Category::all();
    // return view('index');
    return view('index', compact('contacts', 'categories'));
  }

  // 入力画面で「確認画面]ボタンをクリック
  // public function confirm (ContactRequest $request){
  public function confirm (Request $request){
    $contact = $request->only(['name', 'first_name', 'gender',  'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'content']);
    return view('confirm', ['contact' => $contact]);
  }

  // 確認画面で「送信]ボタンをクリック
  // public function store (ContactRequest $request){
  public function store (Request $request){
    $contact = $request->only(['last_name', 'email', 'content']);
    Contact::create($contact);
    return view('thanks');
  }
}