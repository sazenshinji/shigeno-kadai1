@extends('layouts.app_login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')

<!-- Page Heading【Admin】 -->
<div class="admin-page__heading">
  <h2>Admin</h2>
</div>



<!-- Search items and buttons -->
<form class="search-form" action="/contacts/search" method="get" novalidate>
  @csrf
  <div class="search-form__item">

    <input class="search-form-kw__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">

    <select class="search-form-gd__item-input" name="gender_id"> value="{{request('gender_id')}}"
      <option value="" disabled selected>性別</option>
      <option value="4" @if( request('gender_id')==4 ) selected @endif>全て</option>
      <option value="1" @if( request('gender_id')==1 ) selected @endif>男性</option>
      <option value="2" @if( request('gender_id')==2 ) selected @endif>女性</option>
      <option value="3" @if( request('gender_id')==3 ) selected @endif>その他</option>
    </select>

    <select class="search-form-ca__item-input" name="category_id">
      <option value="" disabled selected>お問い合わせの種類</option>
      @foreach ($categories as $category)
      <option value="{{ $category['id'] }}" @if( request('category_id')==$category->id ) selected @endif>{{ $category['content'] }}</option>
      @endforeach
    </select>

    <input class="search-form-dt__item-input" type="date" name="date" placeholder="年/月/日" value="{{request('date')}}">

    <button class="search-form-srh__button-submit" type="submit">検索</button>
    <button class="search-form-rst__button-submit" type="submit" name="reset">リセット</button>
  </div>
</form>

<!-- Pagination buttons -->
<div class="search-form__pagenation">
  {{ $contacts->appends(request()->query())->links() }}
</div>

<div class="pagenation-space">
</div>

<!-- Contact table -->
<!-- Contact table Header -->
<div class="contact-table">
  <table class="contact-table__inner">
    <thead class="contact-table-header">
      <tr>
        <th class="contact-table__header-name">お名前</th>
        <th class="contact-table__header-gender">性別</th>
        <th class="contact-table__header-email">メールアドレス</th>
        <th class="contact-table__header-category">お問い合わせの種類</th>
        <th class="contact-table__header-sp">　</th>
      </tr>
    </thead>

    <tbody class="contact-table-data">
      @foreach ($contacts as $contact)
      <tr>
        <td>{{ $contact['last_name'] }} {{'　'}} {{$contact['first_name']}}</td>

        @if ($contact['gender'] === 1)
        <td>男性</td>
        @elseif ($contact['gender'] === 2)
        <td>女性</td>
        @else
        <td>その他</td>
        @endif

        <td>{{ $contact['email'] }}</td>

        <td>{{ $contact['category']['content'] }}</td>

        <td>
          <button data-modal="modal-{{ $contact['id'] }}">詳細</button>
        </td>

      </tr>
      @endforeach
    </tbody>

  </table>
</div>


<!-- Modal Window -->
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

<!-- Loading script for modal -->
<script src="{{ asset('js/modalscript.js') }}"></script>




@endsection