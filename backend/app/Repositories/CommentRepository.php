<?php

namespace App\Repositories;


use App\Homework;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
//0523061361
class CommentRepository implements CommentRepositoryInterface {

    /**
     * all validation Rules
     *
     * @var array
     */
    protected $allRules = [
        'header' => ['required', 'string', 'max:255'],
        'body' => [ 'string', 'max:255'],
    ];

    /**
     * @return array|mixed
     */
    public function getCreateRules()
    {
        return $this->allRules;
    }

    /**
     * @return array|mixed
     */
    public function getUpdateRules()
    {
        return $this->allRules;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $homework = Homework::findOrFail($request->homeworkId);
        $comment =  Comment::create(
            array(
                'user_id' => auth('api')->id(),
                'homework_id' => $homework->id,
                'header' => $request->header,
                'body' => $request->body,
            )
        );
        return $this->getProfile($comment);
    }

    /**
     * @param Request $request
     * @param Comment $comment
     * @return mixed
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update(
            array(
                'header' => $request->header,
                'body' => $request->body,
            )
        );
        return $this->getProfile($comment);
    }

    /**
     * @param $query
     * @return array|mixed
     */
    public function search($query)
    {
        $results = new Collection();
        if ($query) {
            $results = Comment::where('header','LIKE', '%'.$query.'%')
                ->orWhere('body','LIKE', '%'.$query.'%')->get();
        }
        return $results->map(function ($result) {
            return $this->getProfile($result);
        });
    }

    /**
     * @param $fields
     * @return array|mixed
     */
    public function getRulesFor($fields){

        $filteredRules = [];

        foreach (is_array($fields) ? $fields : func_get_args() as $field) {

            $value = $this->allRules[$field];

            Arr::set($filteredRules, $field, $value);
        }

        return $filteredRules;
    }

    public function forHomework(Homework $homework, $limit)
    {
        // Return a commments array by a specific homework
        // array length is limited by limit parameter
        // to get all comments, set limit to -1

        $comments = $homework->comments()->limit($limit)->get();
        return $comments->map(function ($comment, $key) {
            return $this->getProfile($comment);
        });
    }

    public function getProfile(Comment $comment)
    {
        $profile = $comment->toArray();
        $profile['user'] = $comment->user;
        $profile['canEdit'] = auth('api')->check() && auth('api')->user()->can('update', $comment);
        $profile['canDelete'] = auth('api')->check() && auth('api')->user()->can('delete', $comment);
        return $profile;
    }

}