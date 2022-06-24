<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class AddonPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Controls',
            'slug' => 'cms::addons',
            'description' => 'Addon management module',
            'icon_class' => 'fa-cog'
        ],
        'actions' => [
            [
                'name' => 'View all addons',
                'slug' => 'cms::addons.index',
                'description' => 'Allow to view all addons.',
                'view_on_sidebar' => true,
                'menu_name' => "All Controls"
            ],
            [
                'name' => 'Create Addon',
                'slug' => 'cms::addons.create',
                'description' => 'Allow to create new addon.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Control"
            ],
            [
                'name' => 'Update Addon',
                'slug' => 'cms::addons.update',
                'description' => 'Allow to update category.'
            ],
            [
                'name' => 'Delete Addon',
                'slug' => 'cms::addons.delete',
                'description' => 'Allow to delete category.'
            ]
        ]
    ];

    /**
     * Store permissions related to addons module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}