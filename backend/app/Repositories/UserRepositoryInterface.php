<?php

namespace App\Repositories;


use App\User;
use Illuminate\Http\Request;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface UserRepositoryInterface// extends ModelRepositoryInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request);

    /**
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function update(Request $request, User $user);

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