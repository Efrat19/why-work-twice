<?php

namespace App\Http\Requests\Comment;

use App\Comment;
use Illuminate\Support\Facades\Gate;

class UpdateCommentRequest extends CommentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Comment $comment)
    {
        return auth('api')->user()->can('update', $comment);
    }

}
