@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-8 mt-10">
    <h2 class="text-2xl font-bold mb-8 text-center text-indigo-700">アニメ登録</h2>
    <form action="{{ route('animes.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-gray-700 font-semibold mb-2">タイトル</label>
            <input type="text" name="title" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">年</label>
            <input type="number" name="year" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">画像URL</label>
            <input type="text" name="images" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>
        <div>
            <label class="block text-gray-700 font-semibold mb-2">説明</label>
            <textarea name="description" rows="4" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-2 rounded-md hover:bg-indigo-700 transition duration-150">登録</button>
    </form>
</div>
@endsection