<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class PowerPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Boiler Power Range',
            'slug' => 'cms::powers',
            'description' => 'Power management module',
            'icon_class' => 'fa-flash'
        ],
        'actions' => [
            [
                'name' => 'View all power range',
                'slug' => 'cms::powers.index',
                'description' => 'Allow to view all powers.',
                'view_on_sidebar' => true,
                'menu_name' => "All Power Range"
            ],
            [
                'name' => 'Create Power',
                'slug' => 'cms::powers.create',
                'description' => 'Allow to create new power.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Power Range"
            ],
            [
                'name' => 'Update Power',
                'slug' => 'cms::powers.update',
                'description' => 'Allow to update category.'
            ],
            [
                'name' => 'Delete Power',
                'slug' => 'cms::powers.delete',
                'description' => 'Allow to delete category.'
            ]
        ]
    ];

    /**
     * Store permissions related to powers module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}