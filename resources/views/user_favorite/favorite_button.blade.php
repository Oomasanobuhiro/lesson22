@if (Auth::check())
    @if (Auth::user()->is_favorite($micropost->id))
        {{-- アンフォローボタンのフォーム --}}
        <form method="POST" action="{{ route('favorite.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-block normal-case"
                onclick="return confirm('この投稿をお気に入り登録から外します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        {{-- フォローボタンのフォーム --}}
        <form method="POST" action="{{ route('favorite.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">Favorite</button>
        </form>
    @endif
@endif