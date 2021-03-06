<?php

namespace App\Http\Controllers;

use App\DTO\Homework\StoreHomeworkDto;
use App\Homework;
use App\Http\Requests\Homework\HomeworkRequest;
use App\Repositories\HomeworkRepositoryInterface;
use App\School;
use App\Services\ISmartSearch;
use App\Services\SmartSearch;
use App\Subject;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{

    /**
     * @var HomeworkRepositoryInterface
     */
    protected $homeworkRepository;


    /**
     * HomeworkController constructor.
     * @param HomeworkRepositoryInterface $homeworkRepository
     */
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
    public function store(HomeworkRequest $request)
    {
        $homework = $this->homeworkRepository->create($request);

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
    public function update(HomeworkRequest $request, Homework $homework)
    {
        $updatedHomework = $this->homeworkRepository->update($request, $homework);

        return response()->json($updatedHomework,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Homework $homework)
    {
        return response()->json($this->homeworkRepository->delete($homework), 200);
    }

    /**
     * @param Homework $homework
     * @param $love
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavorite(Homework $homework, $love)
    {
        $isFavorite = (bool)$love;
        $id = auth()->user();
        $isFavorite ? $homework->favorites()->attach($id) : $homework->favorites()->detach($id);
        return response()->json($isFavorite);
    }

    /**
     * @param Homework $homework
     */
    private function incrementViews(Homework $homework){
        $homework->update([
            'views' => $homework->views++
        ]);
    }

    /**
     * @param Homework $homework
     */
    private function incrementDownloads(Homework $homework){
        $homework->update([
            'downloads' => $homework->downloads++
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $results = $this->homeworkRepository->search($query);

        return response()->json($results,200);
    }

    /**
     * @param User $user
     * @param $limit
     * @return \Illuminate\Http\JsonResponse
     */
    public function forUser(User $user, $limit)
    {
        $homeworks = $this->homeworkRepository->forUser($user,$limit);

        return response()->json($homeworks,200);
    }

    public function getSmartSearchFilters(ISmartSearch $smartSearch)
    {
        $related = [School::class, Subject::class, Teacher::class, User::class];

        $filters = $smartSearch->getFilters($related);

        return response()->json($filters, 200);
    }

    public function getSmartSearchResults(Request $request, ISmartSearch $smartSearch)
    {
        $filters = $request->get('filters');

        $ids = $smartSearch->getResults(Homework::class, $filters);

        $results = [];
        foreach ($ids as $homework){
            $results[] = $this->homeworkRepository->getProfile($homework);
        }

        return response()->json($results, 200);
    }

}
