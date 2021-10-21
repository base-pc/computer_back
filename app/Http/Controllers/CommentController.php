<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Repositories\Comment\CommentRepository;

class CommentController extends Controller
{
    private $comment;

    public function __construct(CommentRepository $comment)
    {
        $this->comment = $comment;
    }

    public function store(StoreCommentRequest $request, $product_id)
    {
        $user = auth()->user();

        return $this->comment->store($user, $product_id, $request->all());

    }
}
