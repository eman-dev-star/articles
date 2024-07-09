<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleTagResource;

use App\Http\Requests\CommentRequest;

use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
class ArticleController extends Controller
{
    public function tagArticle(Request $request)
    {
        // $tag = $request->input('tag', '#');

        // $articles = Article::whereHas('tags', function ($query) use ($tag) {
        //     $query->where('tags.name', 'like', $tag . '%');
        // })->get();
        $tagName = $request->input('tag'); // e.g., '#laravel'
        $articles = Article::whereHas('tags', function ($query) use ($tagName) {
            $query->where('tags.name', $tagName);
        })->get();

        // return response()->json($articles);
        return  ArticleTagResource::collection($articles);

    }
    public function getArticleWithComments($id)
    {
        $article = Article::with(['comments','tags'])->findOrFail($id);
        return new ArticleResource($article);
        // return response()->json($article);
    }

    public function commentArticle(CommentRequest $request, $articleId)
    {


        $user = Auth::user();

        $comment = new Comment();
        $comment->article_id = $articleId;
        $comment->user_id = $user->id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            'message' => 'Comment Article successfully',
            'comment' => $comment
        ], 201);
    }

}
