<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class DevicePermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Smart Devices',
            'slug' => 'cms::devices',
            'description' => 'Device management module',
            'icon_class' => 'fa fa-thermometer-0'
        ],
        'actions' => [
            [
                'name' => 'View all devices',
                'slug' => 'cms::devices.index',
                'description' => 'Allow to view all devices.',
                'view_on_sidebar' => true,
                'menu_name' => "All Devices"
            ],
            [
                'name' => 'Create Device',
                'slug' => 'cms::devices.create',
                'description' => 'Allow to create new device.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Device"
            ],
            [
                'name' => 'Update Device',
                'slug' => 'cms::devices.update',
                'description' => 'Allow to update category.'
            ],
            [
                'name' => 'Delete Device',
                'slug' => 'cms::devices.delete',
                'description' => 'Allow to delete category.'
            ]
        ]
    ];

    /**
     * Store permissions related to devices module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}