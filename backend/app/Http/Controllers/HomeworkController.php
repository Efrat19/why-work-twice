<?php

namespace App\Http\Controllers;

use App\Homework;
use App\Repositories\HomeworkRepositoryInterface;
use App\User;
use App\School;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->homeworkRepository->getCreateRules());
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()], 422);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Homework $homework)
    {
        if (auth('api')->user()->can('update',$homework)) {
            $validator = Validator::make($request->all(), $this->homeworkRepository->getUpdateRules());
            if ($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()->all()], 422);
            }
            $updatedHomework = $this->homeworkRepository->update($request, $homework);
            return response()->json($updatedHomework,200);
        }
        return response()->json(['errors'=>['unauthorized']],403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Homework  $homework
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        if (auth('api')->user()->can('update',$homework)) {
            $homework->delete();
            return response()->json($homework, 200);
        }
        return response()->json(['errors'=>['unauthorized']],403);
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
}
