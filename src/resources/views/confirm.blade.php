@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')

  <?php print_r($contact) ?>             $contact の中身をブラウザに表示する。
  <!-- <?php print_r($contact['name']) ?> -->      <!-- 名前のみ取得したい場合。 -->

    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>お問い合わせ内容確認</h2>
      </div>
      <form class="form" action="/contacts" method="post">
        @csrf   
        <div class="confirm-table">
          <table class="confirm-table__inner">

            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <!-- <input type="text" name="name" value="サンプルテキスト" /> -->
                <input type="text" name="name" value="{{ $contact['name'] }}" readonly />
                <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                @if ($contact['gender'] === '1')
                  <p>男性</p>
                @elseif ($contact['gender'] === '2')
                  <p>女性</p>
                @else
                  <p>その他</p>
                @endif
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <!-- <input type="email" name="email" value="サンプルテキスト" /> -->
                <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="tel" name="tel1" value="{{ $contact['tel1'] }}" readonly />
                <input type="tel" name="tel2" value="{{ $contact['tel2'] }}" readonly />
                <input type="tel" name="tel3" value="{{ $contact['tel3'] }}" readonly />
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
              <td class="confirm-table__text">
                <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
              </td>
            </tr>

            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <!-- <input type="text" name="content" value="サンプルテキスト" /> -->
                <input type="text" name="content" value="{{ $contact['content'] }}" readonly />

              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
        </div>
      </form>
    </div>
    @endsection