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
                             ->with('error', "Please select options." );
        }    

        if ($selection && !in_array('page.boilers', $selection['completed_wizard']))
        {
        
            return redirect()->route('page.boilers')
                            ->with('error', 'Please choose a boiler.');
                   
        }
        
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
                $Addon = new AddonRepository(app()) ;
                $default_addon = $Addon->find($selection['control']);
                if ($default_addon)
                    $selection['total_price']+= $default_addon->price;

                if (!in_array('page.controls',$selection['completed_wizard']))
                    $selection['completed_wizard'][] = 'page.controls';     
                
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
