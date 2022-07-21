<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
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

        $last_completed_wizards = ['page.radiators','page.smart-devices','page.booking']; 
        if ($selection && !in_array($selection['completed_wizard'],$last_completed_wizards))
        {
            //set flash message and redirect to lastly selected wizard
            return redirect()->route($selection['completed_wizard']);
        }
        return view('pages.device.index');
    }
}
