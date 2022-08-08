<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
use App\Webifi\Repositories\Radiator\RadiatorTypeRepository;
use App\Webifi\Repositories\Radiator\RadiatorHeightRepository;
use App\Webifi\Repositories\Radiator\RadiatorLengthRepository;

class BookingController extends Controller
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
        
        if ($selection && !in_array('page.smart-devices', $selection['completed_wizard']))
        {
            //set flash message and redirect 
            return redirect()->route('page.smart-devices')
                            ->with('error', 'Please choose smart devices.');
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
        if (!$addon)
        {
            //redirect to control listing page
            return redirect()->route('page.controls')
                             ->with('error', "Please choose a control." );   
        }

        $radiator = $radiator_type = $radiator_height = $radiator_length = null;
        if (isset($selection['radiator']))
        {
            $Radiator = new RadiatorRepository(app()) ;        
            $radiator = $Radiator->find($selection['radiator']['id']);

            $RadiatorType = new RadiatorTypeRepository(app()) ;        
            $radiator_type = $RadiatorType->find($selection['radiator_type']);
            
            $RadiatorHeight = new RadiatorHeightRepository(app()) ;        
            $radiator_height = $RadiatorHeight->find($selection['radiator_height']);

            $RadiatorLength = new RadiatorLengthRepository(app()) ;        
            $radiator_length = $RadiatorLength->find($selection['radiator_length']);
        }
        
        return view('pages.booking.index',compact('devices','boiler','addon','radiator','radiator_type','radiator_height','radiator_length'));
    }
}
