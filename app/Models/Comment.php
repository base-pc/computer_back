<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'opinion',
        'comment_author',
        'author_avatar',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function storeComment(User $user, array $data, $id)
    {
        $comment = new Comment;

        $comment->comment_author = $user->fullname;
        $comment->author_avatar  = $user->avatar;
        $comment->product_id     = $id;

        $comment->fill($data);

        $comment->save();
    }
}
