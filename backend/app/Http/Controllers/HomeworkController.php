<?php

namespace App\Http\Controllers;

use App\DTO\Homework\StoreHomeworkDto;
use App\Homework;
use App\Http\Requests\Homework\DeleteHomeworkRequest;
use App\Http\Requests\Homework\StoreHomeworkRequest;
use App\Http\Requests\Homework\UpdateHomeworkRequest;
use App\Repositories\HomeworkRepositoryInterface;
use App\School;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{

    protected $homeworkRepository;


    public function __construct(HomeworkRepositoryInterface $homeworkRepository)
    {
        $this->homeworkRepository = $homeworkRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Homework::all()->map(function ($homework) {
            return $this->homeworkRepository->getProfile($homework);
        }),200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreHomeworkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeworkRequest $request)
    {
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);

        $homework = $this->homeworkRepository->create(new StoreHomeworkDto(
            $request->input('description'),
            $request->input('source'),
            $school,
            $subject,
            auth('api')->user()
        ));

        return response()->json($homework,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function show(Homework $homework)
    {
        $this->incrementViews($homework);

        $profile = $this->homeworkRepository->getProfile($homework);

        return response()->json($profile,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Homework\UpdateHomeworkRequest  $request
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeworkRequest $request, Homework $homework)
    {
        $updatedHomework = $this->homeworkRepository->update($request, $homework);

        return response()->json($updatedHomework,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCommentRequest  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteHomeworkRequest $request, Homework $homework)
    {
        return response()->json($this->homeworkRepository->delete($homework), 200);
    }

    public function toggleFavorite(Homework $homework, $love)
    {
        $isFavorite = (bool)$love;
        $id = auth('api')->user();
        $isFavorite ? $homework->favorites()->attach($id) : $homework->favorites()->detach($id);
        return response()->json($isFavorite);
    }

    private function incrementViews(Homework $homework){
        $homework->update([
            'views' => $homework->views++
        ]);
    }

    private function incrementDownloads(Homework $homework){
        $homework->update([
            'downloads' => $homework->downloads++
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $results = $this->homeworkRepository->search($query);

        return response()->json($results,200);
    }

    public function forUser(User $user, $limit)
    {
        $homeworks = $this->homeworkRepository->forUser($user,$limit);

        return response()->json($homeworks,200);
    }

}
