<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
       if ($this->authorize('create', User::class)) {
           $validator = Validator::make($request->all(),  $this->userRepository->getCreateRules());
           if ($validator->fails()) {
               return response()->json(['errors'=>$validator->errors()->all()], 422);
           }
           $user = $this->userRepository->create($request);

           return response()->json($user,200);
       }
       return response()->json(['errors'=>['unauthorized']],401);
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
    public function update(Request $request, User $user)
    {
        if (auth('api')->user()->can('update',$user)) {

            $validator = Validator::make($request->all(), $this->userRepository->getUpdateRules());
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()], 422);
            }
            $updatedUser = $this->userRepository->update($request, $user);
            return response()->json($updatedUser, 200);
        }
        return response()->json(['errors'=>['unauthorized']],401);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $results = $this->userRepository->search($query);

        return response()->json($results,200);
    }


}
