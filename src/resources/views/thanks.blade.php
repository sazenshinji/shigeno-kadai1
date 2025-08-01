@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('content')
<form class="form" action="/contacts/thanks" method="get" >
  @csrf
  <div class="thanks__group">
    <div class="thanks__content">
      <div class="thanks__heading">
        <h2>お問い合わせありがとうございました</h2>
      </div>
      <div class="thanks__message">
        <p>{{'Thank you'}}</p>
      </div>
    </div>
    <div class="form__button">
      <button class="thanks__button-home" type="submit">HOME</button>
    </div>
  </div>
</form>
@endsection