<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepositoryInterface;
use App\Repositories\HomeworkRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get admin view
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $links = [
            '/admin/search/users' => 'search users',
            '/admin/search/homeworks' => 'search homeworks',
            '/admin/search/comments' => 'search comments',
            '/admin/admin-users' => 'manage admin users',
        ];
        return view('admin.index')->with(['links' => $links]);
    }

    public function searchUsers(Request $request, UserRepositoryInterface $userRepository)
    {
        $query = $request->get('q') ?? '';
        return view('admin.search.users')->with([
            'query' => $query,
            'results' => $userRepository->search($query)
        ]);
    }

    public function searchHomeworks(Request $request, HomeworkRepositoryInterface $homeworkRepository)
    {
        $query = $request->get('q') ?? '';
        return view('admin.search.homeworks')->with([
            'query' => $query,
            'results' => $homeworkRepository->search($query)
        ]);
    }

    public function searchComments(Request $request, CommentRepositoryInterface $commentRepository)
    {
        $query = $request->get('q') ?? '';
        return view('admin.search.comments')->with([
            'query' => $query,
            'results' => $commentRepository->search($query)
        ]);
    }

    public function adminUsers(Request $request)
    {
        return view('admin.admin-users')->with([
            'users' => User::where('permission_id', '>', 1)->get()
        ]);
    }


    public function newAdmin(Request $request, UserRepositoryInterface $userRepository)
    {
        $id = $request->get('id');

        $userRepository->elevatePrivilege($id);

        return redirect('/admin/admin-users')->with('msg' , 'user '.$id.' is now admin');

    }

    public function elevatePrivilege(User $user, UserRepositoryInterface $userRepository)
    {
        $userRepository->elevatePrivilege($user);

        return redirect('/admin/admin-users')->with('msg' , 'Privilege elevated for '.$user->name);
    }


    public function degradePrivilege(User $user, UserRepositoryInterface $userRepository)
    {
        $userRepository->degradePrivilege($user);

        return redirect('/admin/admin-users')->with('msg' , 'Privilege degraded for user '.$user->name);
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
