<?php

namespace App\DTO\Homework;

use App\DTO\BaseDTO;
use App\School;
use App\Subject;
use App\User;

class StoreHomeworkDto extends BaseDTO
{

    protected $description;
    protected $source;
    protected $schoolId;
    protected $subjectId;
    protected $userId;

    public function __construct(string $description, string $source, School $school, Subject $subject, User $user)
    {
        $this->description = $description;
        $this->source = $source;
        $this->schoolId = $school->id;
        $this->subjectId = $subject->id;
        $this->userId = $user->id;
    }

    public function toArray()
    {
        return [
            'description' => $this->description,
            'source' => $this->source,
            'school_id' => $this->schoolId,
            'subject_id' => $this->subjectId,
            'user_id' => $this->userId
        ];
    }
}