<?php

namespace App\Repositories;


use App\Homework;
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
    public function create(StoreHomeworkDto $dto);

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
}