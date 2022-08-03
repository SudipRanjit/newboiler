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
            return redirect()->route('page.index')
                             ->with('error', "Please choose a boiler." );
        }    

        $last_completed_wizards = ['page.boilers','page.controls','page.radiators','page.smart-devices','page.booking']; 
        if ($selection && !in_array($selection['completed_wizard'],$last_completed_wizards))
        {
            $message = "";
            if ($selection['completed_wizard']=='page.index')
                $message = "Please choose a boiler.";
            elseif ($selection['completed_wizard']=='page.boilers')
                $message = "Please choose a boiler.";    

            //set flash message and redirect to lastly completed wizard
            return $message?redirect()->route($selection['completed_wizard'])
                    ->with('error', $message):redirect()->route($selection['completed_wizard']);
        }
        //dd($selection);

        if (empty($selection['boiler']))
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers')
                             ->with('error', "Please choose a boiler." );
        }
        
        $Boiler = new BoilerRepository(app()) ;        
        $boiler = $Boiler->find($selection['boiler']);
        if (!$boiler)
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers')
                             ->with('error', "Please choose a boiler." );
        }

        //add default addon/control if present, to session
        if ($boiler->addon_id && empty($selection['control']))
            {
                $selection['control'] = $boiler->addon_id;
                $request->session()->put('selection', $selection);
            }   
        
        $Addon = new AddonRepository(app()) ;
        $addon = null;
        if (isset($selection['control']))        
            $addon = $Addon->find($selection['control']);
             
        $boiler_addon_ids = $boiler->addons->pluck('id')->toArray();    
        $boiler_addon_ids_string = '';

        if ($boiler_addon_ids)
            $boiler_addon_ids_string = implode(',',$boiler_addon_ids);        
       
        return view('pages.control.index',compact('boiler','addon','boiler_addon_ids_string'));
    }
}
