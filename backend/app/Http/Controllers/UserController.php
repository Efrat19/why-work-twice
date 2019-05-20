<?php

namespace App\Http\Controllers;

use App\Http\Requests\Homework\UpdateHomeworkRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\School;
use App\Subject;
use Illuminate\Support\Arr;
class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(),200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
           $user = $this->userRepository->create($request);

           return response()->json($user,200);
    }

    public function show(User $user)
    {

        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeworkRequest $request, User $user)
    {
            $updatedUser = $this->userRepository->update($request, $user);

            return response()->json($updatedUser, 200);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $results = $this->userRepository->search($query);

        return response()->json($results,200);
    }


}
