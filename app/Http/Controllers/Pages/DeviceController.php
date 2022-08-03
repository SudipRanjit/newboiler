<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Device\DeviceRepository;

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
        //dd($selection);
        if (empty($selection))
        {
            //set flash message and redirect to first wizard
            return redirect()->route('page.index')
                             ->with('error', "Please choose a boiler." );
                             
        }    

        $last_completed_wizards = [/*'page.radiators',*/'page.smart-devices','page.booking']; 
        if ($selection && !in_array($selection['completed_wizard'],$last_completed_wizards))
        {
            $message = "";
            if ($selection['completed_wizard']=='page.index')
                $message = "Please choose a boiler.";
            elseif ($selection['completed_wizard']=='page.boilers')
                $message = "Please choose a boiler.";    

            //set flash message and redirect to lastly selected wizard
            if ($message)
                 return redirect()->route($selection['completed_wizard'])
                                  ->with('error',$message);
        }

        
        $Device = new DeviceRepository(app()) ;
        $devices = null;
        if (isset($selection['devices']))        
            $devices = $Device->getInArray([],'id',array_keys($selection['devices']));
        
        //dd($devices);    

        $Boiler = new BoilerRepository(app()) ;        
        $boiler = $Boiler->find($selection['boiler']);
        if (!$boiler)
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers')
                             ->with('error', "Please choose a boiler." );
        }

        $Addon = new AddonRepository(app()) ;
        $addon = $Addon->find($selection['control']);
        /*if (!$addon)
        {
            //redirect to control listing page
            return redirect()->route('page.controls')
                             ->with('error', "Please choose a control." );   
        }*/

        return view('pages.device.index',compact('devices','boiler','addon'));
    }
}
