<?php

namespace App\Repositories;


use App\Comment;
use App\Homework;
use Illuminate\Http\Request;

/**
 * Interface CommentRepositoryInterface
 * @package App\Repositories
 */
interface CommentRepositoryInterface //extends ModelRepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param Request $request
     * @param Comment $comment
     * @return mixed
     */
    public function update(Request $request, Comment $comment);

    /**
     * @param $query
     * @return mixed
     */
    public function search($query);

    public function delete(Comment $comment);

    public function forHomework(Homework $homework, $limit);

    public function getProfile(Comment $comment);
}
