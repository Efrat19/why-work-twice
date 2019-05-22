<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepositoryInterface;
use App\Repositories\HomeworkRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get admin view
     *
     * @return \Illuminate\Http\Response
     */
    protected $links = [
        'searchUsers' => [
            'label' => 'search users',
            'active' => false,
            'view' => 'admin.search.users',
            'viewParameters' => [
                'url' => '/admin/search/users',
                'results' => [],
                'query' => ''
                ],
        ],
        'searchHomeworks' => [
            'label' => 'search homeworks',
            'active' => false,
            'view' => 'admin.search.homeworks',
            'viewParameters' => [
                'url' => '/admin/search/homeworks',
                'results' => [],
                'query' => ''
                ],
        ],
        'searchComments' => [
            'label' => 'search comments',
            'active' => false,
            'view' => 'admin.search.comments',
            'viewParameters' => [
                'url' => '/admin/search/comments',
                'results' => [],
                'query' => ''
            ],
        ],
        'adminUsers' => [
            'label' => 'manage admin users',
            'active' => false,
            'view' => 'admin.admin-users',
            'viewParameters' => [
                'url' => '/admin/admin-users',
                'results' => [],
                'query' => ''
            ],
        ],
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index')->with(['links' => $this->links]);
    }

    public function searchUsers(Request $request, UserRepositoryInterface $userRepository)
    {
        $query = $request->get('q') ?? '';
        $this->links['searchUsers']['viewParameters']['query'] = $query;
        $this->links['searchUsers']['viewParameters']['results'] = $userRepository->search($query);
        $this->links['searchUsers']['active'] = true;
        return view('admin.index')->with(['links' => $this->links]);
    }

    public function searchHomeworks(Request $request, HomeworkRepositoryInterface $homeworkRepository)
    {
        $query = $request->get('q') ?? '';
        $this->links['searchHomeworks']['viewParameters']['query'] = $query;
        $this->links['searchHomeworks']['viewParameters']['results'] = $homeworkRepository->search($query);
        $this->links['searchHomeworks']['active'] = true;
        return view('admin.index')->with(['links' => $this->links]);
    }

    public function searchComments(Request $request, CommentRepositoryInterface $commentRepository)
    {
        $query = $request->get('q') ?? '';
        $this->links['searchComments']['viewParameters']['query'] = $query;
        $this->links['searchComments']['viewParameters']['results'] = $commentRepository->search($query);
        $this->links['searchComments']['active'] = true;
        return view('admin.index')->with(['links' => $this->links]);
    }

    public function adminUsers(Request $request, CommentRepositoryInterface $commentRepository)
    {
        $query = $request->get('q') ?? '';
        $this->links['searchComments']['viewParameters']['query'] = $query;
        $this->links['searchComments']['viewParameters']['results'] = $commentRepository->search($query);
        $this->links['searchComments']['active'] = true;
        return view('admin.index')->with(['links' => $this->links]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
