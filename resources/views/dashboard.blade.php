<!-- @extends('layouts.app')

@section('content')
    @if (Auth::check())
<div class="max-w-4xl mx-auto p-8">


<section class="mb-10">
    <h2 class="text-xl font-bold mb-4 text-center">新着アニメ</h2>
    <div class="flex justify-center ">
        <div class="flex overflow-x-auto flex-nowrap scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 space-x-6 py-2 max-w-[900px] px-2">
            @foreach ($newanimes as $anime)
                <a href = "{{route('animes.show',$anime->id)}}"class= "block">
                    <div class="bg-gray-100 rounded shadow min-w-[170px] max-w-[180px] mx-auto p-4 flex flex-col items-center flex-shrink-0">
                        <img src="{{ $anime->images }}" alt="{{ $anime->title }}" class="w-24 h-24 object-cover rounded mb-3">
                        <div class="font-semibold text-base mb-1 text-center">{{ $anime->title }}</div>
                        <div class="text-gray-600 text-sm text-center">レビュー数: {{ $anime->reviews_count ?? 0 }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

    {{-- ランキング ＆ おすすめアニメ --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        {{-- ランキング --}}
        <div>
            <h3 class="text-lg font-bold mb-2">ランキング</h3>
            <ul class=" ml-5">
                @foreach ($ranking as $i => $item)
                    <li>{{ $i + 1 }}位 {{ $item->title }}
                    <span class="ml-2 text-gray-600 text-sm">({{$item->reviews_sum_rating ?? 0}}pt)</span>
                    </li>
                @endforeach
            </ul>
        </div>
        {{-- おすすめアニメ --}}
        <div>
            <h3 class="text-lg font-bold mb-2">おすすめアニメ</h3>
            <ul class="list-disc ml-5">
                @foreach ($recommended as $anime)
                    <li>
                        {{ $anime->title }}
                        <span class="ml-2 text-gray-600 text-sm">({{$anime->reviews_sum_rating ?? 0}}pt)</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

</div>
    @else
        <div class="prose hero bg-base-200 mx-auto max-w-full rounded">
            <div class="hero-content text-center my-10">
                <div class="max-w-md mb-10">
                    <h2>Welcome to the Microposts</h2>
                    {{-- ユーザー登録ページへのリンク --}}
                    <a class="btn btn-primary btn-lg normal-case" href="{{ route('register') }}">Sign up now!</a>
                </div>
            </div>
        </div>
    @endif
@endsection -->