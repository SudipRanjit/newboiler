<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
use App\Webifi\Repositories\Radiator\RadiatorTypeRepository;
use App\Webifi\Repositories\Radiator\RadiatorHeightRepository;
use App\Webifi\Repositories\Radiator\RadiatorLengthRepository;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Addon\AddonRepository;

class RadiatorController extends Controller
{

   /**
   * Constructor
   * @param CategoryRepository $category
   */
  public function __construct(
    RadiatorRepository $Radiator,
    RadiatorTypeRepository $RadiatorType,
    RadiatorHeightRepository $RadiatorHeight,
    RadiatorLengthRepository $RadiatorLength,
    BoilerRepository $Boiler,
    AddonRepository $Addon
    
  ) {
    $this->Radiator = $Radiator;
    $this->RadiatorType = $RadiatorType;
    $this->RadiatorHeight = $RadiatorHeight;
    $this->RadiatorLength = $RadiatorLength;
    $this->Boiler = $Boiler;
    $this->Addon = $Addon;
  }

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

        $last_completed_wizards = ['page.controls','page.radiators','page.smart-devices','page.booking']; 
        if ($selection && !in_array($selection['completed_wizard'],$last_completed_wizards))
        {
            $message = "";
            if ($selection['completed_wizard']=='page.index')
                $message = "Please choose a boiler.";
            elseif ($selection['completed_wizard']=='page.controls')
                $message = "Please choose a control.";
            elseif ($selection['completed_wizard']=='page.boilers')
                $message = "Please choose a boiler.";    

            //set flash message and redirect to lastly selected wizard
            return $message?redirect()->route($selection['completed_wizard'])
                            ->with('error', $message):redirect()->route($selection['completed_wizard']);
        }

                
        $radiator = $this->Radiator->findWithCondition(['publish'=>1]);
        if (!$radiator)
            abort('404');
        $radiator_types = $this->RadiatorType->all();
        $radiator_heights = $this->RadiatorHeight->all();
        $radiator_lengths = $this->RadiatorLength->all();

        $boiler = $this->Boiler->find($selection['boiler']);
        if (!$boiler)
        {
            //redirect to boiler listing page
            return redirect()->route('page.boilers')
                             ->with('error', "Please choose a boiler." ); 
        }

        $addon = $this->Addon->find($selection['control']);
        if (!$addon)
        {
            //redirect to control listing page
            return redirect()->route('page.controls')
                             ->with('error', "Please choose a control." ); 
        }

                
        return view('pages.radiator.index',compact('radiator','radiator_types','radiator_heights','radiator_lengths','boiler','addon'));
    }
}
