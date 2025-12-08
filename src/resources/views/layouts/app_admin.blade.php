<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>勤怠管理アプリ</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <!-- Stripe -->
  <script src="https://js.stripe.com/v3/"></script>
  <meta name="stripe-key" content="{{ config('services.stripe.key') }}">

  @yield('css')
</head>

<body>
  <header class="header">

    <div class="logo">
      <a href="{{ route('admin.daily') }}">
        <img class="logo-img" src="{{ asset('images/Coachtech.jpg') }}" alt="勤怠">
      </a>
    </div>

    <nav class="nav-menu">
      <ul>
        {{-- 勤怠一覧（管理者用） --}}
        <li>
          <a href="{{ route('admin.daily') }}">勤怠一覧</a>
        </li>

        {{-- スタッフ一覧 --}}
        <li>
          <a href="{{ route('admin.staff.list') }}">スタッフ一覧</a>
        </li>

        {{-- 申請一覧 --}}
        <li>
          <a href="{{ route('request.list') }}">申請一覧</a>
        </li>

        {{-- ログアウト --}}
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">ログアウト</button>
          </form>
        </li>
      </ul>
    </nav>

  </header>

  <main class="content">
    @yield('content')
  </main>
</body>

</html>