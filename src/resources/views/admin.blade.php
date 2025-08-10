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

    <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">

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
  <table class="todo-table__inner">
    <tr class="todo-table__row">
      <th class="todo-table__header">
        <span class="todo-table__header-span">お名前　</span>
        <span class="todo-table__header-span">性別　</span>
        <span class="todo-table__header-span">メールアドレス　</span>
        <span class="todo-table__header-span">お問い合わせの種類</span>
      </th>
    </tr>


    @foreach ($contacts as $contact)
    <tr class="confirm-table__row">
      <!-- <td class="todo-table__item"> -->
      <!-- <form class="update-form" action="/admin/update" method="post"> -->
      <!-- @method('PATCH') -->
      <!-- @csrf -->
      <td class="confirm-table__text">
        <p class="update-form__itme-p">{{ $contact['last_name'] }}</p>
      </td>
      <td class="confirm-table__text">
        <p class="update-form__itme-p">{{ $contact['first_name'] }}</p>
      </td>

      <td class="confirm-table__text">
        @if ($contact['gender'] === 1)
        <p>男性</p>
        @elseif ($contact['gender'] === 2)
        <p>女性</p>
        @else
        <p>その他</p>
        @endif
      </td>
      <td class="confirm-table__text">
        <p class="update-form__itme-p">{{ $contact['email'] }}</p>
      </td>

      <td class="confirm-table__text">
        <!-- <p class="update-form__item-p">Category 1</p> -->
        <p class="update-form__itme-p">{{ $contact['category']['content'] }}</p>
      </td>


      <td class="confirm-table__text">
        <!-- <form class="delete-form" action="/todos/delete" method="post" novalidate> -->
        <!-- @method('DELETE') -->
        <!-- @csrf -->
        <!-- <div class="delete-form__button"> -->
        <!-- <input type="hidden" name="id" value="{{ $contact['id'] }}"> -->
        <!-- <button class="delete-form__button-submit" type="submit">詳細</button> -->
        <button id="openModalBtn">詳細</button>
        <!-- </div> -->
        <!-- </form> -->
      </td>

      <!-- AI：Laravel 8 + JavaScript を使って「HTML上の複数のボタンで、それぞれ違うモーダルウィンドウを表示する」基本的な例 -->
      <!-- AI：Laravel 8 + JavaScript で、HTML上に @foreach で複数ボタンを表示し、それぞれのボタンを押したときに 異なるモーダルウィンドウ を表示する例 -->


    </tr>
    @endforeach


  </table>
</div>


<!-- モーダル本体 -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeModalBtn">&times;</span>
    <p>これはモーダルの内容です。</p>
  </div>
</div>

<script>
  // JavaScriptでモーダル制御
  const modal = document.getElementById("myModal");
  const openBtn = document.getElementById("openModalBtn");
  const closeBtn = document.getElementById("closeModalBtn");

  // モーダルを表示
  openBtn.onclick = () => {
    modal.style.display = "block";
  };

  // モーダルを閉じる
  closeBtn.onclick = () => {
    modal.style.display = "none";
  };

  // 背景クリックで閉じる
  window.onclick = (event) => {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  };
</script>


@endsection