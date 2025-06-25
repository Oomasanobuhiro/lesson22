<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function show($id)
    {
        $anime = Anime::with(['reviews.user'])->findOrFail($id);
        return view('animes.show',compact('anime'));
    }

    public function create()
    {
        return view('animes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'required|integer',
            'images' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Anime::create([
            'title' => $request->title,
            'year' => $request->year,
            'images' => $request->images,
            'description' => $request->description,
        ]);

        return redirect('/')->with('success', 'アニメを登録しました！');
    }
}
