<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Homework;
use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $rules = [
        'header' => ['required', 'string', 'max:255'],
        'body' => [ 'string', 'max:255'],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Homework $homework, $limit)
    {
        $comments = $homework->comments()->limit($limit)->get();
        $comments->map(function ($comment, $key) {
            $user = User::findOrFail($comment->user_id);
            $comment->user = [
                'name' => $user->name
            ];
            return $comment;
        });
        return response()->json($comments,200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()], 422);
        }
        $homework = Homework::findOrFail($request->homeworkId);
        $comment = Comment::create(
            array(
                'user_id' => auth('api')->id(),
                'homework_id' => $homework->id,
                'header' => $request->header,
                'body' => $request->body,
            )
        );
        return response()->json($comment, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return response()->json($comment,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()], 422);
        }
        $comment->update(
            array(
                'header' => $request->header,
                'body' => $request->body,
            )
        );
        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json($comment, 200);
    }
}
