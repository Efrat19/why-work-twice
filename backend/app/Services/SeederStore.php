<?php

namespace App\Services;

use App\Homework;
use App\School;
use App\Subject;
use App\Teacher;
use App\User;

class SeederStore {

    protected $users;

    protected $schools;

    protected $subjects;

    protected $teachers;

    protected $homeworks;

    public function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getRandomUsersId()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function updateUsers(): void
    {
        $this->users = User::all('id')->pluck('id');
    }

    /**
     * @return mixed
     */
    public function getRandomSchoolsId()
    {
        return $this->schools[rand(0,$this->schools->count() -1)];
    }

    /**
     * @param mixed $schools
     */
    public function updateSchools(): void
    {
        $this->schools = School::all('id')->pluck('id');
    }

    /**
     * @return mixed
     */
    public function getRandomSubjectsId()
    {
        return $this->subjects[rand(0,$this->subjects->count() -1)];
    }

    /**
     * @param mixed $subjects
     */
    public function updateSubjects(): void
    {
        $this->subjects = Subject::all('id')->pluck('id');
    }

    /**
     * @return mixed
     */
    public function getRandomTeachersId()
    {
        return $this->teachers[rand(0,$this->teachers->count() -1)];
    }

    /**
     * @param mixed $teachers
     */
    public function updateTeachers(): void
    {
        $this->teachers = Teacher::all('id')->pluck('id');
    }

    /**
     * @return mixed
     */
    public function getRandomHomeworksId()
    {
        return $this->homeworks[rand(0,$this->homeworks->count() -1)];
    }

    /**
     * @param mixed $homeworks
     */
    public function updateHomeworks(): void
    {
        $this->homeworks = Homework::all('id')->pluck('id');
    }

}
