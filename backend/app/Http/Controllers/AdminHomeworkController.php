<?php

namespace App\Http\Controllers;

use App\Homework;
use App\Http\Requests\Homework\HomeworkRequest;
use App\Repositories\HomeworkRepositoryInterface;
use Illuminate\Http\Request;

class AdminHomeworkController extends Controller
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
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homework.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeworkRequest $request)
    {
        $homework = $this->homeworkRepository->create($request);

        return redirect('/admin/search/homework')->with('msg' , 'homework '.$homework->id.' successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.homework.edit')->with(['homework' => Homework::findOrFail($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeworkRequest $request, Homework $homework)
    {
        $homework = $this->homeworkRepository->update($request, $homework);

        return redirect('/admin/search/homework')->with('msg' , 'homework '.$homework->id.' successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Homework $homework)
    {
        $homework = $this->homeworkRepository->delete($homework);

        return redirect('/admin/search/homework')->with('msg' , 'homework '.$homework->id.' successfully deleted');
    }
}
