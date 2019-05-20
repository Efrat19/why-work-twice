<?php

namespace App\Http\Requests\Comment;

class UpdateCommentRequest extends CommentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->user()->can('update', $this->request->get('comment_id'));
    }

}
