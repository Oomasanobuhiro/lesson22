@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">レビューを編集</h2>

    {{-- エラーメッセージ --}}
    @if ($errors->any())
        <div class="mb-4">
            <ul class="text-red-500 text-sm">
                @foreach ($errors->all() as $error)
                    <li>※ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">評価（1〜5）</label>
            <input type="number" name="rating" min="1" max="5" value="{{ old('rating', $review->rating) }}" required class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        <div class="mb-6">
            <label class="block font-semibold mb-1">コメント</label>
            <textarea name="comment" rows="4" class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('comment', $review->comment) }}</textarea>
        </div>
        <div class="flex justify-between">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">戻る</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">更新</button>
        </div>
    </form>
</div>
@endsection