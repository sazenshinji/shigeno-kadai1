@extends('layouts.app_login')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')


    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Admin</h2>
      </div>
      <!-- <form class="form"> 　　　　　　　　　　　　　　　　　　　　←下の行の様に書き換える。教材の手順　-->

    </div>

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


      @foreach ($contacs as $contact)
      <tr class="confirm-table__row">
        <!-- <td class="todo-table__item"> -->
          <!-- <form class="update-form" action="/admin/update" method="post"> -->
            <!-- @method('PATCH') -->
            <!-- @csrf -->
            <td class="confirm-table__text">
               <p class="update-form__itme-p">{{ $contact['name'] }}</p>
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
              <form class="delete-form" action="/todos/delete" method="post">
                @method('DELETE')
                @csrf
                <div class="delete-form__button">
                  <input type="hidden" name="id" value="{{ $contact['id'] }}">
                  <button class="delete-form__button-submit" type="submit">詳細</button>
                </div>
              </form>
            </td>



      </tr>
      @endforeach


    </table>
  </div>

    @endsection
