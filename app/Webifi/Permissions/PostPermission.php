<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class PostPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Post Management',
            'slug' => 'cms::posts',
            'description' => 'Post management module',
            'icon_class' => 'fa-book'
        ],
        'actions' => [
            [
                'name' => 'View all posts',
                'slug' => 'cms::posts.index',
                'description' => 'Allow to view all posts.',
                'view_on_sidebar' => true,
                'menu_name' => "All Posts"
            ],
            [
                'name' => 'Create post',
                'slug' => 'cms::posts.create',
                'description' => 'Allow to create new post.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Post"
            ],
            [
                'name' => 'Update post',
                'slug' => 'cms::posts.update',
                'description' => 'Allow to update post.'
            ],
            [
                'name' => 'Delete post',
                'slug' => 'cms::posts.delete',
                'description' => 'Allow to delete post.'
            ],
            [
                'name' => 'Publish post',
                'slug' => 'cms::posts.status',
                'description' => 'Allow to publish post.'
            ]
        ]
    ];

    /**
     * Store permissions related to posts module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}