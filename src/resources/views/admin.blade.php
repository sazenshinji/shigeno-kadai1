@extends('layouts.app_login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')


<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Admin</h2>
  </div>
</div>


<form class="search-form" action="/contacts/search" method="get" novalidate>
  @csrf
  <div class="search-form__item">

    <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

    <select name="gender_id"> value="{{request('gender_id')}}"
      <option value="" disabled selected>性別</option>
      <option value="4" @if( request('gender_id')==4 ) selected @endif>全て</option>
      <option value="1" @if( request('gender_id')==1 ) selected @endif>男性</option>
      <option value="2" @if( request('gender_id')==2 ) selected @endif>女性</option>
      <option value="3" @if( request('gender_id')==3 ) selected @endif>その他</option>
    </select>

    <select name="category_id">
      <option value="" disabled selected>お問い合わせの種類</option>
      @foreach ($categories as $category)
      <option value="{{ $category['id'] }}" @if( request('category_id')==$category->id ) selected @endif>{{ $category['content'] }}</option>
      @endforeach
    </select>

    <input class="search-form__item-input" type="date" name="date" placeholder="年/月/日" value="{{request('date')}}">

    <button class="search-form__button-submit" type="submit">検索</button>
    <button class="search-form__button-submit" type="submit" name="reset">リセット</button>

    <!-- {{ $contacts->appends(request()->query())->links() }} -->

  </div>

  <div class="search-form__pagenation">
    {{ $contacts->appends(request()->query())->links() }}
  </div>

</form>
<div class="contact-table">
  <div class="contact-table__header">
    <span class="contact-table__header-span">お名前</span>
    <span class="contact-table__header-span">性別</span>
    <span class="contact-table__header-span">メールアドレス</span>
    <span class="contact-table__header-span">お問い合わせの種類</span>
  </div>


  @foreach ($contacts as $contact)
  <div class="contact-table__inner">

    <div style="margin-bottom: 20px;">
      <span class="update-form__itme-p">{{ $contact['last_name'] }}</span>
      <span class="update-form__itme-p">{{ $contact['first_name']}}</span>
      <span class="todo-table__header-span">　　</span>

      @if ($contact['gender'] === 1)
      <span>男性</span>
      <span class="todo-table__header-span">　　</span>
      @elseif ($contact['gender'] === 2)
      <span>女性</span>
      <span class="todo-table__header-span">　　</span>
      @else
      <span>その他</span>
      <span class="todo-table__header-span">　　</span>
      @endif

      <span class="update-form__itme-p">{{ $contact['email'] }}</span>
      <span class="todo-table__header-span">　　</span>
      <span class="update-form__itme-p">{{ $contact['category']['content'] }}</span>
      <span class="todo-table__header-span">　　</span>
      <button class="btn" data-modal="modal-{{ $contact['id'] }}">詳細</button>
      <span class="todo-table__header-span">　　</span>
    </div>
  </div>
</div>

<!-- モーダル -->
<div id="modal-{{ $contact['id'] }}" class="modal">
  <div class="modal-content">
    <span class="close" data-close="modal-{{ $contact['id'] }}">&times;</span>

    <form class="modal__detail-form" action="/delete" method="post">
      @csrf

      <div class="modal-content-neme">
        <span>お名前</span>
        <span>　　</span>
        <span>{{ $contact['last_name'] }}</span>
        <span>{{ $contact['first_name']}}</span>
      </div>
      <div class="modal-content-gender">
        <span>性別</span>
        <span>　　</span>
        @if ($contact['gender'] === 1)
        <span>男性</span>
        @elseif ($contact['gender'] === 2)
        <span>女性</span>
        @else
        <span>その他</span>
        @endif
      </div>
      <div class="modal-content-email">
        <span>メールアドレス</span>
        <span>　　</span>
        <span class="update-form__itme-p">{{ $contact['email'] }}</span>
      </div>
      <div class="modal-content-tel">
        <span>電話番号</span>
        <span>　　</span>
        <span class="update-form__itme-p">{{ $contact['tel'] }}</span>
      </div>
      <div class="modal-content-address">
        <span>住所</span>
        <span>　　</span>
        <span class="update-form__itme-p">{{ $contact['address'] }}</span>
      </div>
      <div class="modal-content-building">
        <span>建物名</span>
        <span>　　</span>
        <span class="update-form__itme-p">{{ $contact['building'] }}</span>
      </div>
      <div class="modal-content-category_id">
        <span>お問い合わせの種類</span>
        <span>　　</span>
        <span class="update-form__itme-p">{{ $contact['category']['content'] }}</span>
      </div>
      <div class="modal-content-detail">
        <span>お問い合わせ内容</span>
        <span>　　</span>
        <span class="update-form__itme-p">{{ $contact['detail'] }}</span>
      </div>

      <input type="hidden" name="id" value="{{ $contact->id }}">
      <input class="modal-form__delete-btn btn" type="submit" value="削除">

    </form>

  </div>
</div>

<!-- モーダル用scriptの読み込み -->
<script src="{{ asset('js/modalscript.js') }}"></script>

@endforeach

@endsection