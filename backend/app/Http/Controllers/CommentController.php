<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Homework;
use App\Repositories\CommentRepositoryInterface;
use \App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    protected $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Homework::all()->map(function ($comment) {
            return $this->commentRepository->getProfile($comment);
        }),200);
    }



    /***
     * @param Homework $homework
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function forHomework(Homework $homework, $limit)
    {
        $comments = $this->commentRepository->forHomework($homework,$limit);
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
        $validator = Validator::make($request->all(), $this->commentRepository->getCreateRules());
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()], 422);
        }
        $comment = $this->commentRepository->create($request);
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
            return response()->json($this->commentRepository->getProfile($comment),200);
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
            $validator = Validator::make($request->all(), $this->commentRepository->getUpdateRules());
            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()->all()], 422);
            }
            $comment = $this->commentRepository->update($request, $comment);
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

    public function search(Request $request)
    {
        $query = $request->get('q');

        $results = $this->commentRepository->search($query);

        return response()->json($results,200);
    }
}
