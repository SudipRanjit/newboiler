<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControlController extends Controller
{
    /**
     * Show page
     *
     * @return view
     */
    public function index(Request $request)
    {
        $selection = $request->session()->get('selection');
        if (empty($selection))
        {
            //set flash message and redirect to first wizard
            return redirect()->route('page.index');
        }    

        $last_completed_wizards = ['page.boiler','page.control','page.radiator','page.smart-device','page.booking']; 
        if ($selection && !in_array($selection['page'],$last_completed_wizards))
        {
            //set flash message and redirect to lastly selected wizard
            return redirect()->route($selection['page']);
        }
        return view('pages.control.index');
    }
}
