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
                'name' => 'View all Payment Gateways',
                'slug' => 'cms::payment_gateways.index',
                'description' => 'Allow to view all payment gateways.',
                'view_on_sidebar' => true,
                'menu_name' => "All Payment Gateways"
            ],
            [
                'name' => 'Create Payment Gateway',
                'slug' => 'cms::payment_gateways.create',
                'description' => 'Allow to create new payment gateway.',
                'menu_name' => "Add Payment Gateway"
            ],
            [
                'name' => 'Update Payment Gateway',
                'slug' => 'cms::payment_gateways.update',
                'description' => 'Allow to update Payment Gateway.'
            ],
            [
                'name' => 'Delete Payment Gateway',
                'slug' => 'cms::payment_gateways.delete',
                'description' => 'Allow to delete Payment Gateway.'
            ],
            [
                'name' => 'View all Custom Prices',
                'slug' => 'cms::custom_prices.create',
                'description' => 'Allow to create custom price.',
                'view_on_sidebar' => true,
                'menu_name' => "All Custom Prices"
            ],
            [
                'name' => 'View all Block Dates',
                'slug' => 'cms::block_dates.index',
                'description' => 'Allow to view all block dates.',
                'view_on_sidebar' => true,
                'menu_name' => "All Block Dates"
            ],
            [
                'name' => 'Create Block Date',
                'slug' => 'cms::block_dates.create',
                'description' => 'Allow to create block date.',
                'menu_name' => "Add Control"
            ],
            [
                'name' => 'Update Block Date',
                'slug' => 'cms::block_dates.update',
                'description' => 'Allow to update block date.'
            ],
            [
                'name' => 'Delete Block Date',
                'slug' => 'cms::block_dates.delete',
                'description' => 'Allow to delete block date.'
            ],
            [
                'name' => 'View all orders',
                'slug' => 'cms::orders.index',
                'description' => 'Allow to view all orders.',
                'view_on_sidebar' => true,
                'menu_name' => "All Orders"
            ],
            [
                'name' => 'View order details',
                'slug' => 'cms::order_details.delete',
                'description' => 'Allow to delete block date.'
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
            [
                'name' => 'Stripe payout from customer',
                'slug' => 'cms::bookings.stripe_payout',
                'description' => 'Allow to stripe payout from customer.'
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