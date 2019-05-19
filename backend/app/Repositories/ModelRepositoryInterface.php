<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Interface ModelRepositoryInterface
 * @package App\Repositories
 */
interface ModelRepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    public function update(Request $request, Model $model);

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
}