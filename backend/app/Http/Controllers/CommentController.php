<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Homework;
use App\Http\Requests\Comment\CommentRequest;
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
    public function store(CommentRequest $request)
    {
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
        if(auth()->user()->can('view', $comment)){
            return response()->json($this->commentRepository->getProfile($comment),200);
        }
        return response()->json(['errors'=>['unauthorized']],403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCommentRequest $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $comment = $this->commentRepository->update($request, $comment);

        return response()->json($comment, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCommentRequest  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        return response()->json($this->commentRepository->delete($comment), 200);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $results = $this->commentRepository->search($query);

        return response()->json($results,200);
    }
}
