


@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 space-y-8">
    {{-- アニメ情報 --}}
    <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center">
        <img src="{{ $anime->images }}" alt="{{ $anime->title }}"
             class="w-40 h-40 object-cover rounded-xl mb-4 shadow-md">
        <h2 class="text-2xl font-extrabold text-gray-800 mb-1">{{ $anime->title }}</h2>
        <span class="text-sm text-gray-400 mb-2">{{ $anime->year }}年放送</span>
        <p class="text-gray-700 text-center">{{ $anime->description }}</p>
    </div>

    {{-- レビュー一覧 --}}
    <div class="space-y-3">
        <h3 class="text-xl font-bold text-blue-600 mb-4">レビュー一覧</h3>
        @forelse ($anime->reviews as $review)
            <div class="bg-gradient-to-r from-blue-50 via-white to-blue-50 rounded-lg p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <span class="font-semibold text-gray-700">{{ $review->user->name }}</span>
                    <span>{{$review->rating}}
                        {{-- 星アイコンで評価 --}}
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <span class="text-yellow-400">★</span>
                            @else
                                <span class="text-gray-300">★</span>
                            @endif
                        @endfor
                    </span>

                </div>
                <div class="mt-2 text-gray-600">{{ $review->comment }}</div>
                <div class="text-xs text-gray-400 text-right">{{ $review->created_at->format('Y-m-d') }}</div>
                @if (Auth::check() && Auth::id() == $review->user_id)
                    <div class="flex gap-2">
                        <a href="{{route('reviews.edit',$review->id)}}"class= "px-2 px-1 text-xs rounded bg-blue-500 text-white hover:bg-blue-600">編集</a>
                    {{-- 投稿削除ボタンのフォーム --}}
                    <form method="POST" action="{{ route('reviews.destroy', $review->id) }}" onsubmit = "return confirm('本当に削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error btn-sm normal-case">Delete</button>
                    </form>
                @endif
            </div>
            <div class="mt-2">

                <p>{{$review->coment}}
            </div>
        @empty
            <div class="text-gray-400 text-center">レビューはまだありません。</div>
        @endforelse
    </div>

    {{-- レビュー投稿フォーム --}}
    @auth
    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-bold mb-4 text-blue-600">レビュー投稿</h3>
        <form action="{{ route('reviews.store', $anime->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="font-semibold block mb-1">評価（1～5）</label>
                <select name="rating" required
                        class="w-28 rounded border-gray-300 shadow-sm focus:ring-blue-400 focus:border-blue-400">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="font-semibold block mb-1">コメント</label>
                <textarea name="comment" rows="3"
                          class="w-full border-gray-300 rounded shadow-sm focus:ring-blue-400 focus:border-blue-400"></textarea>
            </div>
            <button type="submit"
                    class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded font-bold shadow transition">
                投稿する
            </button>
        </form>
    </div>
    @endauth
</div>
@endsection