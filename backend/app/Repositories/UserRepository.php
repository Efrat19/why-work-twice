<?php

namespace App\Repositories;


use App\School;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class UserRepository implements UserRepositoryInterface {

    /**
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        $user = User::create([
            'name' => $request['name'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);
        return $this->getProfile($user);
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
        return $this->getProfile($user);
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
        return $results->map(function ($result) {
            return $this->getProfile($result);
        });
    }

    public function getProfile(User $user)
    {
        $profile = $user->toArray();
        $profile['school'] = $user->school;
        $profile['subject'] = $user->subject;
        $profile['rating'] = $user->getAvgRating();
        $profile['uploads'] = $user->homeworks()->count();
        $profile['canEdit'] = auth()->check() && auth()->user()->can('update', $user);
        return $profile;
    }


    public function elevatePrivilege(User $user)
    {
        $newPermission = 2;
        if($user->isAdmin()){
            $newPermission = 3;
        }
        return $user->update([
            'permission_id' => $newPermission
        ]);
    }

    public function degradePrivilege(User $user)
    {
        $newPermission = 1;
        if($user->isSuperAdmin()){
            $newPermission = 2;
        }
        return $user->update([
            'permission_id' =>  $newPermission
        ]);
    }
}
