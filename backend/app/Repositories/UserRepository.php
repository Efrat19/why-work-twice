<?php

namespace App\Repositories;


use App\School;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class UserRepository implements UserRepositoryInterface {

    /**
     * all validation Rules
     *
     * @var array
     */
    protected $allRules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'subject' => ['required'],
        'school' => ['required'],
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
        return $this->getRulesFor(['name', 'school', 'subject']);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        return User::create([
            'name' => $request['name'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return mixed
     */
    public function update(Request $request, User $user)
    {
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        $user->update([
            'name' => $request['name'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
        ]);
    }

    /**
     * @param $query
     * @return array|mixed
     */
    public function search($query)
    {
        $results = new Collection();
        if ($query) {
            $results = User::where('name','LIKE', '%'.$query.'%')
                ->orWhere('email','LIKE', '%'.$query.'%')->get();
        }
        return $results;
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

}