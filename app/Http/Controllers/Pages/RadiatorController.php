<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
use App\Webifi\Repositories\Radiator\RadiatorTypeRepository;
use App\Webifi\Repositories\Radiator\RadiatorHeightRepository;
use App\Webifi\Repositories\Radiator\RadiatorLengthRepository;
use App\Webifi\Repositories\Radiator\RadiatorPriceRepository;
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
   * @param RadiatorPriceRepository $RadiatorPrice
   * @param BoilerRepository $Boiler
   * @param AddonRepository $Addon
   */
  public function __construct(
    RadiatorRepository $Radiator,
    RadiatorTypeRepository $RadiatorType,
    RadiatorHeightRepository $RadiatorHeight,
    RadiatorLengthRepository $RadiatorLength,
    RadiatorPriceRepository $RadiatorPrice,
    BoilerRepository $Boiler,
    AddonRepository $Addon
    
  ) {
    $this->Radiator = $Radiator;
    $this->RadiatorType = $RadiatorType;
    $this->RadiatorHeight = $RadiatorHeight;
    $this->RadiatorLength = $RadiatorLength;
    $this->RadiatorPrice = $RadiatorPrice;
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
        
        $radiator_type_ids = $this->RadiatorPrice->pluck('radiator_type_id','radiator_type_id')->toArray();
        $radiator_height_ids = $this->RadiatorPrice->pluck('radiator_height_id','radiator_height_id')->toArray();
        $radiator_length_ids = $this->RadiatorPrice->pluck('radiator_length_id','radiator_length_id')->toArray();        

        $radiator_types = $this->RadiatorType->getInArray([],'id',array_values($radiator_type_ids),'id','asc',['*'],1000)->pluck('type','id');
        $radiator_heights = $this->RadiatorHeight->getInArray([],'id',array_values($radiator_height_ids),'id','asc',['*'],1000)->pluck('height','id');
        $radiator_lengths = $this->RadiatorLength->getInArray([],'id',array_values($radiator_length_ids),'id','asc',['*'],1000)->pluck('length','id');

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
        
        $radiator_price = '';
        if (!empty($selection['radiator_type']) && !empty($selection['radiator_height']) && !empty($selection['radiator_length']))
          $radiator_price = $this->RadiatorPrice->findWithCondition(['radiator_type_id'=>$selection['radiator_type'],'radiator_height_id'=>$selection['radiator_height'],'radiator_length_id'=>$selection['radiator_length']],['price','btu']);
     
        
        return view('pages.radiator.index',compact('radiator','radiator_types','radiator_heights','radiator_lengths','boiler','addon','radiator_price'));
    }

    /**
     * get price and btu from radiator type, radiator height, radiator length
     *
     * @param Request $request
     */
    public function getPrice(Request $request)
    {
        if($request->ajax())
        {
            $input = $request->all();
            //dd($input);            
           
            $success = false;
           
            $type = isset($input['type'])?$input['type']:'';
            $height = isset($input['height'])?$input['height']:'';
            $length = isset($input['length'])?$input['length']:'';
            
            $record = null;
            if (!empty($type) && !empty($height) && !empty($length))
              $record = $this->RadiatorPrice->findWithCondition(['radiator_type_id'=>$type,'radiator_height_id'=>$height,'radiator_length_id'=>$length],['price','btu']);
           
            $success = true;
            
            return response()->json(['success'=>$success, 'record'=>$record]);
        }
    }

}
