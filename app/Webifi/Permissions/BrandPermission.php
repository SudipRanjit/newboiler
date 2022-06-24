<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class BrandPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Brand',
            'slug' => 'cms::brands',
            'description' => 'Brand management module',
            'icon_class' => 'fa-bath'
        ],
        'actions' => [
            [
                'name' => 'View all brands',
                'slug' => 'cms::brands.index',
                'description' => 'Allow to view all brands.',
                'view_on_sidebar' => true,
                'menu_name' => "All Brands"
            ],
            [
                'name' => 'Create Brand',
                'slug' => 'cms::brands.create',
                'description' => 'Allow to create new brand.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Brand"
            ],
            [
                'name' => 'Update Brand',
                'slug' => 'cms::brands.update',
                'description' => 'Allow to update category.'
            ],
            [
                'name' => 'Delete Brand',
                'slug' => 'cms::brands.delete',
                'description' => 'Allow to delete category.'
            ]
        ]
    ];

    /**
     * Store permissions related to brands module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}