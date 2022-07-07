<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     *
     * @return view
     */
    public function index()
    {
        return view('pages.booking.index');
    }
}
