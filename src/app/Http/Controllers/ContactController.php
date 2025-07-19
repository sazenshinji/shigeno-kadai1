<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{


  // 入力画面の表示
  public function index()
  {
    $contacts = Contact::with('category')->get();
    $categories = Category::all();
    // return view('index');
    return view('index', compact('contacts', 'categories'));
  }

  // 入力画面で「確認画面]ボタンをクリック
  public function confirm (ContactRequest $request){
  // public function confirm (Request $request){

    $contact = $request->only(['name', 'first_name', 'gender',  'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'content']);

    $categories = Category::all();

    return view('confirm', ['contact' => $contact]);

  }

  // 確認画面で「送信]ボタンをクリック
   public function store (Request $request){
    $contact = $request->only(['name', 'first_name', 'gender',  'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'category_id', 'content']);

    // $contact = $request->only(['name']);

    // Contact::create($contact);
    return view('thanks');
  }

  // Login画面の表示
  // public function login()
  // {
    // return view('admin');
  // }

}