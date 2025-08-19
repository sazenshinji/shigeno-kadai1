@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Contact</h2>
  </div>
  <form class="form" action="/contacts/confirm" method="post" novalidate>
    @csrf
    <div class="contact-form__group">
      <label class="contact-form__label" for="name">お名前
        <span class="contact-form__required">※</span>
      </label>

      <div class="contact-form__name-inputs">
        <input class="contact-form__input contact-form__name-input" type="text" name="last_name" id="name" placeholder="例：山田" value="{{ old('last_name') ?? $contact['last_name'] }}" />
        <input class="contact-form__input contact-form__name-input" type="text" name="first_name" id="name" placeholder="例：太郎" value="{{ old('first_name') ?? $contact['first_name'] }}" />
      </div>

      <div class="contact-form__error-message">
        @if ($errors->has('first_name'))
        <p class="contact-form__error-message-first-name">{{$errors->first('first_name')}}</p>
        @endif
        @if ($errors->has('last_name'))
        <p class="contact-form__error-message-last-name">{{$errors->first('last_name')}}</p>
        @endif
      </div>
    </div>

    <div class="contact-form__group">
      <label class="contact-form__label">
        性別<span class="contact-form__required">※</span>
      </label>

      <div class="contact-form__input--radio">
        <div class="contact-form__gender-option">
          <input type="radio" name="gender" value="1" {{ old('gender' , $contact['gender'] ?? '') === '1' ? 'checked' : '' }}> 男性
        </div>
        <div class="contact-form__gender-option">
          <input type="radio" name="gender" value="2" {{ old('gender' , $contact['gender'] ?? '') === '2' ? 'checked' : '' }}> 女性
        </div>
        <div class="contact-form__gender-option">
          <input type="radio" name="gender" value="3" {{ old('gender' , $contact['gender'] ?? '') === '3' ? 'checked' : '' }}> その他
        </div>
      </div>
      <div class="form__error">
        <!--バリデーション機能を実装したら記述します。-->
        @error('gender')
        {{ $message }}
        @enderror
      </div>
    </div>

    <div class="contact-form__group">
      <label class="contact-form__label" for="email">
        メールアドレス<span class="contact-form__required">※</span>
      </label>
      <input class="contact-form__input" type="email" name="email" id="email" placeholder="例：test@example.com" value="{{ old('email') ?? $contact['email'] }}" />
      <div class="form__error">
        <!--バリデーション機能を実装したら記述します。-->
        <p class="contact-form__error-message">
          @error('email')
          {{ $message }}
          @enderror
        </p>
      </div>
    </div>


    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">電話番号</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') ?? $contact['tel1'] }}" />
          <span> - </span>
          <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') ?? $contact['tel2'] }}" />
          <span> - </span>
          <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') ?? $contact['tel3'] }}" />
        </div>
        <div class="form__error">
          <!--バリデーション機能を実装したら記述します。-->
          @error('tel1')
          {{ $message }}
          @enderror
          @error('tel2')
          {{ $message }}
          @enderror
          @error('tel3')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">住所</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') ?? $contact['address'] }}" />
        </div>
        <div class="form__error">
          <!--バリデーション機能を実装したら記述します。-->
          @error('address')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">建物名</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') ?? $contact['building']  }}" />
        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせの種類</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">

          <select name="category_id">
            <option value="" disabled selected>選択してください</option>
            @foreach ($categories as $category)
            <option value="{{ $category['id'] }}">{{ $category['content'] }}</option>
            @endforeach
          </select>

        </div>
        <div class="form__error">
          <!--バリデーション機能を実装したら記述します。-->
          @error('category_id')
          {{ $message }}
          @enderror

        </div>
      </div>
    </div>

    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">お問い合わせ内容</span>
        <span class="form__label--required">※</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--textarea">
          <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') ?? $contact['detail']  }}</textarea>
        </div>
        <div class="form__error">
          <!--バリデーション機能を実装したら記述します。-->
          @error('detail')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection