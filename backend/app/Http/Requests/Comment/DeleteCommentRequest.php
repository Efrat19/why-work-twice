<?php

namespace App\Http\Requests\Comment;


use App\Comment;

class DeleteCommentRequest extends CommentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Comment $comment)
    {
        return auth('api')->user()->can('delete', $comment);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
