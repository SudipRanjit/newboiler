<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class RadiatorPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Radiators',
            'slug' => 'cms::radiators',
            'description' => 'Radiator management module',
            'icon_class' => 'fa fa-th'
        ],
        'actions' => [
            [
                'name' => 'View all radiators',
                'slug' => 'cms::radiators.index',
                'description' => 'Allow to view all radiators.',
                'view_on_sidebar' => true,
                'menu_name' => "All Radiators"
            ],
            [
                'name' => 'Create Radiator',
                'slug' => 'cms::radiators.create',
                'description' => 'Allow to create new radiator.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Radiator"
            ],
            [
                'name' => 'Update Radiator',
                'slug' => 'cms::radiators.update',
                'description' => 'Allow to update radiator.'
            ],
            [
                'name' => 'Delete Radiator',
                'slug' => 'cms::radiators.delete',
                'description' => 'Allow to delete radiator.'
            ]
        ]
    ];

    /**
     * Store permissions related to radiators module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}