<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            // ユーザーの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザーの投稿も取得するように変更しますが、現時点ではこのユーザーの投稿のみ取得します）
            $reviews = $user->feed_reviews()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'reviews' => $reviews,
            ];
        }

        // dashboardビューでそれらを表示
        return view('dashboard', $data);
    }

    public function store(Request $request, $anime_id)
    {
        // バリデーション
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'anime_id' => $anime_id,
            'rating' => $request -> rating,
            'comment' => $request -> comment,
        ]);
            return redirect()-> route('animes.show',$anime_id)->with('success','レビューを投稿しました');

    }

    public function edit(string $id)
    {
        // idの値で投稿を検索して取得
        $review = Review::findOrFail($id);

        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() !== $review->user_id) {
            // 前のURLへリダイレクトさせる
            abort(403,'権限がありません');
        }
            return view('animes.edit', compact('review'));

    }


    public function destroy(string $id)
    {
        // idの値で投稿を検索して取得
        $review = Review::findOrFail($id);

        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() !== $review->user_id) {
            // 前のURLへリダイレクトさせる
            abort(403,'権限がありません');
        }
            $review->delete();
            return back()
                ->with('success','Delete Successful');

    }
}
