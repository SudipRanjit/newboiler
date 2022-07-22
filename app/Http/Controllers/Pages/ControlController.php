<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Addon\AddonRepository;

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

        $last_completed_wizards = ['page.boilers','page.controls','page.radiators','page.smart-devices','page.booking']; 
        if ($selection && !in_array($selection['completed_wizard'],$last_completed_wizards))
        {
            //set flash message and redirect to lastly completed wizard
            return redirect()->route($selection['completed_wizard']);
        }
        //dd($selection);

        if (empty($selection['boiler']))
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers');
        }

        $Boiler = new BoilerRepository(app()) ;        
        $boiler = $Boiler->find($selection['boiler']);
        if (!$boiler)
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers');
        }

        $Addon = new AddonRepository(app()) ;
        $addon = null;
        if (isset($selection['control']))        
            $addon = $Addon->find($selection['control']);
        

        return view('pages.control.index',compact('boiler','addon'));
    }
}
