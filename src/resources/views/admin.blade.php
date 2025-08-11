@extends('layouts.app_login')

<style>
  svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 30px;
  }
</style>

<style>
  /* モーダルのスタイル */
  .modal {
    display: none;
    /* 初期は非表示 */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    /* 半透明背景 */
  }

  .modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
    border-radius: 8px;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
  }

  .close:hover {
    color: black;
  }
</style>


@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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

    <select name="gender_id">
      <option value="" disabled selected>性別</option>
      <option value="4">全て</option>
      <option value="1">男性</option>
      <option value="2">女性</option>
      <option value="3">その他</option>
    </select>

    <select name="category_id">
      <option value="" disabled selected>お問い合わせの種類</option>
      @foreach ($categories as $category)
      <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
      @endforeach
    </select>

    <input class="search-form__item-input" type="date" name="date" placeholder="年/月/日" value="{{ old('date') }}">

  </div>

  <div class="search-form__button">
    <button class="search-form__button-submit" type="submit">検索</button>
    <button class="search-form__button-submit" type="submit" name="reset">リセット</button>
    {{ $contacts->appends(request()->query())->links() }}
  </div>
</form>

<div class="todo-table">
  <!-- <table class="todo-table__inner"> -->
  <!-- <tr class="todo-table__row"> -->
  <!-- <th class="todo-table__header"> -->
  <span class="todo-table__header-span">お名前　　　</span>
  <span class="todo-table__header-span">性別　　</span>
  <span class="todo-table__header-span">メールアドレス　　　　　　</span>
  <span class="todo-table__header-span">お問い合わせの種類</span>
  <!-- </th> -->
  <!-- </tr>endphp -->



  @foreach ($contacts as $contact)
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
  @endforeach

  <script>
    // ボタンをクリックしてモーダルを開く
    document.querySelectorAll("[data-modal]").forEach(button => {
      button.addEventListener("click", () => {
        const modalId = button.getAttribute("data-modal");
        document.getElementById(modalId).style.display = "block";
      });
    });

    // 閉じるボタン
    document.querySelectorAll("[data-close]").forEach(closeBtn => {
      closeBtn.addEventListener("click", () => {
        const modalId = closeBtn.getAttribute("data-close");
        document.getElementById(modalId).style.display = "none";
      });
    });

    // モーダル背景クリックで閉じる
    window.addEventListener("click", (event) => {
      if (event.target.classList.contains("modal")) {
        event.target.style.display = "none";
      }
    });
  </script>



  @endsection