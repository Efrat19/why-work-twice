<?php

namespace App\Repositories;



use App\DTO\Homework\AdminLinkDTO;

class AdminRepository {

    protected $links = [];

    protected function createLinks()
    {
        $this->links = [
            'searchUsers' => new AdminLinkDTO('search users', 'admin.search.users'),
//                [
//                'label' => 'search users',
//                'active' => false,
//                'view' => 'admin.search.users',
//                'viewParameters' => [
//                    'url' => '/admin/search/users',
//                    'results' => [],
//                    'query' => ''
//                ],
//            ],
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
    }

}
