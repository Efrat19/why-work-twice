<?php

namespace App\Http\Requests\Comment;


use App\Comment;

class StoreCommentRequest extends CommentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->user()->can('create', Comment::class);
    }

}
