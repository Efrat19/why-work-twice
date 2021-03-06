<?php

namespace App\Repositories;


use App\Homework;
use App\Http\Requests\Homework\HomeworkRequest;
use App\User;
use Illuminate\Http\Request;
use App\DTO\Homework\StoreHomeworkDto;

/**
 * Interface HomeworkRepositoryInterface
 * @package App\Repositories
 */
interface HomeworkRepositoryInterface //extends ModelRepositoryInterface
{
    /**
     * @param StoreHomeworkDto $dto
     * @return mixed
     */
    public function create(HomeworkRequest $homeworkRequest);

    /**
     * @param Request $request
     * @param Homework $homework
     * @return mixed
     */
    public function update(Request $request, Homework $homework);

    /**
     * @param $query
     * @return mixed
     */
    public function search($query);

    public function getProfile(Homework $homework);

    public function forUser(User $user, $limit);
}
