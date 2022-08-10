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
   * @param RadiatorRepository $Radiator
   * @param RadiatorTypeRepository $RadiatorType
   * @param RadiatorHeightRepository $RadiatorHeight
   * @param RadiatorLengthRepository $RadiatorLength
   * @param BoilerRepository $Boiler
   * @param AddonRepository $Addon
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
                             ->with('error', "Please select options." );
        }    

        
        if ($selection && !in_array('page.controls', $selection['completed_wizard']))
        {
            //set flash message and redirect
            return redirect()->route('page.controls')
                            ->with('error', 'Please choose a control.');
        }
                
        $radiator = $this->Radiator->findWithCondition(['publish'=>1]);
        if (!$radiator)
            abort('404');
        $radiator_types = $this->RadiatorType->all()->pluck('type','id');
        $radiator_heights = $this->RadiatorHeight->all()->pluck('height','id');
        $radiator_lengths = $this->RadiatorLength->all()->pluck('length','id');

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
