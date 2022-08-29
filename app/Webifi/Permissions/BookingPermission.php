<?php

namespace App\Webifi\Permissions;


use App\Webifi\StorePermissions;

class BookingPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Booking',
            'slug' => 'cms::bookings',
            'description' => 'Booking management module',
            'icon_class' => 'fa fa-calendar'
        ],
        'actions' => [
            [
                'name' => 'Custom Price',
                'slug' => 'cms::custom_prices.create',
                'description' => 'Allow to create custom price.',
                'view_on_sidebar' => true,
                'menu_name' => "Custom Price"
            ],
            [
                'name' => 'Block Date',
                'slug' => 'cms::block_dates.index',
                'description' => 'Allow to view all block dates.',
                'view_on_sidebar' => true,
                'menu_name' => "Block Date"
            ],
            [
                'name' => 'View all orders',
                'slug' => 'cms::orders.index',
                'description' => 'Allow to view all orders.',
                'view_on_sidebar' => true,
                'menu_name' => "All Orders"
            ],
            [
                'name' => 'View all bookings',
                'slug' => 'cms::bookings.index',
                'description' => 'Allow to view all bookings.',
                'view_on_sidebar' => true,
                'menu_name' => "All Bookings"
            ],
            [
                'name' => 'Update booking',
                'slug' => 'cms::bookings.update',
                'description' => 'Allow to update booking.'
            ],
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