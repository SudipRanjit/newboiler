<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class ToolTipPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Tool Tip',
            'slug' => 'cms::tooltips',
            'description' => 'Tool Tip management module',
            'icon_class' => 'fa-hdd-o'
        ],
        'actions' => [
            [
                'name' => 'View all tooltips',
                'slug' => 'cms::tooltips.index',
                'description' => 'Allow to view all tooltips.',
                'view_on_sidebar' => true,
                'menu_name' => "Update Tool Tips"
            ],
            [
                'name' => 'Create ToolTip',
                'slug' => 'cms::tooltips.create',
                'description' => 'Allow to create new tooltip.',
                'menu_name' => "Add ToolTip"
            ],
            [
                'name' => 'Update ToolTip',
                'slug' => 'cms::tooltips.update',
                'description' => 'Allow to update category.'
            ],
            [
                'name' => 'Delete ToolTip',
                'slug' => 'cms::tooltips.delete',
                'description' => 'Allow to delete category.'
            ]
        ]
    ];

    /**
     * Store permissions related to tooltips module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}