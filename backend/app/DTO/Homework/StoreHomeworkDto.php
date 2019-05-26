<?php

namespace App\DTO\Homework;

use App\DTO\BaseDTO;
use App\School;
use App\Subject;
use App\User;
use \Illuminate\Http\UploadedFile;

class StoreHomeworkDto extends BaseDTO
{

    protected $description;
    protected $source;
    protected $schoolId;
    protected $subjectId;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return File
     */
    public function getSource(): UploadedFile
    {
        return $this->source;
    }

    /**
     * @param UploadedFile $source
     */
    public function setSource(UploadedFile $source): void
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getSchoolId()
    {
        return $this->schoolId;
    }

    /**
     * @param mixed $schoolId
     */
    public function setSchoolId($schoolId): void
    {
        $this->schoolId = $schoolId;
    }

    /**
     * @return mixed
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * @param mixed $subjectId
     */
    public function setSubjectId($subjectId): void
    {
        $this->subjectId = $subjectId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }
    protected $userId;

    public function __construct(string $description, UploadedFile $source, School $school, Subject $subject, User $user)
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
