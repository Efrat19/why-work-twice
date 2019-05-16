<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\School;
use App\Subject;
use Illuminate\Support\Arr;
class UserController extends Controller
{

    /**
     * validation-rules
     *
     * @var array
     */
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'subject' => ['required'],
        'school' => ['required'],
    ];
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
           $validator = Validator::make($request->all(),  $this->rules);
           if ($validator->fails()) {
               return response()->json(['errors'=>$validator->errors()->all()], 422);
           }
           $school = School::firstOrCreate(['name' => $request['school']]);
           $subject = Subject::firstOrCreate(['name' => $request['subject']]);
           $user = User::create([
               'name' => $request['name'],
               'email' => $request['email'],
               'school_id' => $school->id,
               'subject_id' => $subject->id,
               'password' => Hash::make($request['password'])
           ]);

           return response()->json($user,200);
       }
        return response()->json(['errors'=>['unauthorized']],403);
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
            $validator = Validator::make($request->all(), $this->getRulesFor(['name', 'school', 'subject']));
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->all()], 422);
            }
            $school = School::firstOrCreate(['name' => $request['school']]);
            $subject = Subject::firstOrCreate(['name' => $request['subject']]);
            $user->update([
                'name' => $request['name'],
                'school_id' => $school->id,
                'subject_id' => $subject->id,
            ]);
            return response()->json($user, 200);
        }
        return response()->json(['errors'=>['unauthorized']],403);
    }

    public function search(Request $request)
    {
//        dd(DB::getSchemaBuilder()->getColumnListing('users'));
//
//        dd(Schema::getColumnListing('users'));
        $where = [];
        foreach (DB::getSchemaBuilder()->getColumnListing('users') as $col){
            $where[] = [$col, 'LIKE', '%2%' ];
        }
        return DB::table('users')->where($where,null,null,'or');
//        $users = User::where([
//            ['name', 'LIKE' ]
//        ]);
//        $q = Input::get ( 'q' );
//        $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
//        if (count ( $user ) > 0)
//            return view ( 'welcome' )->withDetails ( $user )->withQuery ( $q );
//        else
//            return view ( 'welcome' )->withMessage ( 'No Details found. Try to search again !' );
    }

    protected function getRulesFor($fields){

        $filteredRules = [];

        foreach (is_array($fields) ? $fields : func_get_args() as $field) {

                $value = $this->rules[$field];

                Arr::set($filteredRules, $field, $value);
            }

        return $filteredRules;
    }

}
