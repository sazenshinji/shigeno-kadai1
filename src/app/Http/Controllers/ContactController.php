<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
  // お問い合わせフォーム入力画面の表示
  public function index()
  {
    return view('index');
  }

  // お問い合わせフォーム入力画面で「確認画面ボタン」をクリック
  // public function confirm (ContactRequest $request){
  public function confirm (Request $request){
    $contact = $request->only(['name', 'email', 'tel', 'content']);
    return view('confirm', ['contact' => $contact]);
  }

  // お問い合わせフォーム確認画面で「送信ボタン」をクリック
  // public function store (ContactRequest $request){
  public function store (Request $request){
    $contact = $request->only(['name', 'email', 'tel', 'content']);
    Contact::create($contact);
    return view('thanks');
  }
}