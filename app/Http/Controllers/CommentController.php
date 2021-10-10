<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Comment $comment, $id)
    {
        $user =  auth()->user();

        $comment->storeComment($user, $request->all(), $id);

        return response()->json(['MESSAGE'=>'A comment has been added'], 200, [], JSON_UNESCAPED_SLASHES);
    }
}
