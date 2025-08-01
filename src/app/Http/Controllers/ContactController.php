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
    // $contacts = Contact::with('category')->get();
    $contact = ['category_id' => '', 'first_name' => '', 'last_name' => '', 'gender' => '1',  'email' => '', 'tel1' => '', 'tel2' => '', 'tel3' => '',  'address' => '', 'building' => '', 'detail' => ''];
    $categories = Category::all();
    return view('index', compact('contact', 'categories'));
  }

  // 入力画面で「確認画面]ボタンをクリック
  public function confirm(ContactRequest $request)
  {
    $contact = ['category_id' => '', 'first_name' => '', 'last_name' => '', 'gender' => '',  'email' => '', 'tel' => '',  'address' => '', 'building' => '', 'detail' => ''];

    $contact_in = $request->only(['category_id', 'first_name', 'last_name', 'gender',  'email', 'tel1', 'tel2', 'tel3', 'address', 'building', 'detail']);
    $contact['category_id'] = $contact_in['category_id'];
    $contact['first_name'] = $contact_in['first_name'];
    $contact['last_name'] = $contact_in['last_name'];
    $contact['gender'] = $contact_in['gender'];
    $contact['email'] = $contact_in['email'];
    $contact['tel'] = $contact_in['tel1'] . $contact_in['tel2'] . $contact_in['tel3'];
    $contact['address'] = $contact_in['address'];
    $contact['building'] = $contact_in['building'];
    $contact['detail'] = $contact_in['detail'];

    $category_tb = Category::find($contact['category_id']);
    $category = $category_tb->content;

    session(['input-org_contact' => $contact_in]);
    session(['input_contact' => $contact]);

    return view('confirm', compact('contact', 'category'));
  }

  // 確認画面で「送信]ボタンをクリック
  public function store(Request $request)
  {
    $contact = session('input_contact');

    Contact::create($contact);

    return view('thanks');
  }
  // 確認画面で「修正]ボタンをクリック
  public function modifies()
  {
    $contact = session('input-org_contact');
    $categories = Category::all();
    return view('index', compact('contact', 'categories'));
  }
}
