<?php

namespace App\Repositories;


use App\Homework;
use Illuminate\Http\Request;

/**
 * Interface HomeworkRepositoryInterface
 * @package App\Repositories
 */
interface HomeworkRepositoryInterface //extends ModelRepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param Request $request
     * @param Homework $homework
     * @return mixed
     */
    public function update(Request $request, Homework $homework);

    /**
     * @return mixed
     */
    public function getCreateRules();

    /**
     * @return mixed
     */
    public function getUpdateRules();

    /**
     * @param $fields
     * @return mixed
     */
    public function getRulesFor($fields);

    /**
     * @param $query
     * @return mixed
     */
    public function search($query);

    public function getProfile(Homework $homework);
}