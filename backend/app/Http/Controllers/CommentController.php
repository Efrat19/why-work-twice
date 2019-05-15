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
            $comment->user = [
                'name' => $comment->user()->first()->name,
            ];
            $comment->canEdit = auth('api')->check() && auth('api')->user()->can('update', $comment);
            $comment->canDelete = auth('api')->check() && auth('api')->user()->can('delete', $comment);
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
        if(auth('api')->user()->can('view', $comment)){
            return response()->json($comment,200);
        }
        return response()->json(['errors'=>['unauthorized']],403);

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
        if(auth('api')->user()->can('update', $comment)){
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
        else {
            return response()->json(['errors'=>['unauthorized']],403);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if(auth('api')->user()->can('delete', $comment)){
            $comment->delete();
            return response()->json($comment, 200);
        }
        else {
            return response()->json(['errors'=>['unauthorized']],403);
        }
    }
}
