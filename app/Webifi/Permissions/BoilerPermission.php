<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class BoilerPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Boiler',
            'slug' => 'cms::boilers',
            'description' => 'Boiler management module',
            'icon_class' => 'fa-hdd-o'
        ],
        'actions' => [
            [
                'name' => 'View all boilers',
                'slug' => 'cms::boilers.index',
                'description' => 'Allow to view all boilers.',
                'view_on_sidebar' => true,
                'menu_name' => "All Boilers"
            ],
            [
                'name' => 'Create Boiler',
                'slug' => 'cms::boilers.create',
                'description' => 'Allow to create new boiler.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Boiler"
            ],
            [
                'name' => 'Update Boiler',
                'slug' => 'cms::boilers.update',
                'description' => 'Allow to update category.'
            ],
            [
                'name' => 'Delete Boiler',
                'slug' => 'cms::boilers.delete',
                'description' => 'Allow to delete category.'
            ],
            [
                'name' => 'View all Features',
                'slug' => 'cms::boiler.features.index',
                'description' => 'Allow to view all features.',
                'view_on_sidebar' => true,
                'menu_name' => "All Boiler Features"
            ],
            [
                'name' => 'Create Feature',
                'slug' => 'cms::boiler.features.create',
                'description' => 'Allow to create new feature.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Feature"
            ],
            [
                'name' => 'Update Feature',
                'slug' => 'cms::boiler.features.update',
                'description' => 'Allow to update feature.'
            ],
            [
                'name' => 'Delete Feature',
                'slug' => 'cms::boiler.features.delete',
                'description' => 'Allow to delete feature.'
            ]
        ]
    ];

    /**
     * Store permissions related to boilers module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}