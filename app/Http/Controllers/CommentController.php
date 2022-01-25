<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Repositories\Comment\CommentRepository;
use App\Models\Rate;

class CommentController extends Controller
{
    private $comment, $rate;

    public function __construct(CommentRepository $comment, Rate $rate)
    {
        $this->comment = $comment;
        $this->rate = $rate;
    }

    public function store(StoreCommentRequest $request, $product_id)
    {
        $user = auth()->user();

        return $this->comment->store($user, $product_id, $request->all(), $this->rate);

    }

}
