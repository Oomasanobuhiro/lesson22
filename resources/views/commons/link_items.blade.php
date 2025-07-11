@if (Auth::check())
    <li><a class="link link-hover" href="{{ route('animes.create') }}">追加</a></li>

    {{-- ユーザー一覧ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('users.index') }}">Users</a></li>

        {{-- ユーザー詳細ページへのリンク --}}
        <li><a class="link link-hover" href="{{ route('users.show', Auth::user()->id) }}">{{ Auth::user()->name }}&#39;s profile</a></li>
        <li class="divider lg:hidden"></li>
        <li><a class="link link-hover" href="{{ route('users.favorites', Auth::user()->id)}}">favorites</a></li>
        {{-- ログアウトへのリンク --}}
        <li><a class="link link-hover" href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>

@else
    {{-- ユーザー登録ページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('register') }}">Signup</a></li>
    <li class="divider lg:hidden"></li>
    {{-- ログインページへのリンク --}}
    <li><a class="link link-hover" href="{{ route('login') }}">Login</a></li>
@endif