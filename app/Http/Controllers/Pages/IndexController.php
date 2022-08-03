<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * show page
     * 
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $request->session()->forget('selection'); 
        
        return view('pages.index.index');
    }

    /**
     * save answer in session named 'selection'
     *
     * @param Request $request
     */
    public function saveAnswer(Request $request)
    {
        if($request->ajax())
        {
            $input = $request->all();
            //dd($input);            
                        
            $request->session()->forget('selection');
           
            $success = false;
            $selection = [];

            /* input eg;
            beds = 2;
            baths = 1;
            showers = 3;
            boiler = 'Combi';
            bConvert = 'YES';
            completed_wizard = 'page.index','page.boilers','page.controls',etc; 
            */

            $selection['beds'] = $input['beds'];
            $selection['baths'] = $input['baths'];
            $selection['showers'] = $input['showers'];
            $selection['boiler_type'] = $input['boiler_type'];
            $selection['bConvert'] = $input['bConvert'];
            $selection['completed_wizard'] = 'page.index';
            
            $request->session()->put('selection', $selection);
            if ($request->session()->has('selection'))
                $success = true;
            
            return response()->json(['success'=>$success, 'selection'=>$selection]);
        }
    }

    /**
     * update answer in session named 'selection'
     *
     * @param Request $request
     */
    public function updateAnswer(Request $request)
    {
        if($request->ajax())
        {
            $input = $request->all();
            //dd($input);            
                        
            $success = false;
            $selection = $request->session()->has('selection')?$request->session()->get('selection'):[];
            
            if (isset($input['beds']))
                $selection['beds'] = $input['beds'];

            if (isset($input['baths']))    
                $selection['baths'] = $input['baths'];
            
            if (isset($input['showers']))        
                $selection['showers'] = $input['showers'];

            if (isset($input['boiler_type']))            
                $selection['boiler_type'] = $input['boiler_type'];
            
            if (isset($input['bConvert']))                
                $selection['bConvert'] = $input['bConvert'];
            
            if (isset($input['completed_wizard']))    
                $selection['completed_wizard'] = $input['completed_wizard'];
            
            if (isset($input['boiler']))    
                $selection['boiler'] = $input['boiler'];
            
            if (isset($input['control']))    
                $selection['control'] = $input['control'];
                    
            if (isset($input['device']))    
                {
                    $devices = $selection['devices']??[];
                   
                    if (!empty($input['quantity']) && !empty($input['action']))  //adding
                        {
                            $devices[$input['device']]['quantity'] = $input['quantity'];
                        }
                    else if (empty($input['action']))  //removing
                        {
                            unset($devices[$input['device']]);
                        }
                    
                    $selection['devices'] =$devices;
                }
            
            if (isset($input['radiator']))    
                {
                    $radiator = $selection['radiator']??[];
                                       
                    if (!empty($input['quantity']) && !empty($input['action']))  //adding
                        {
                            $radiator['quantity'] = $input['quantity'];
                            $selection['radiator'] =$radiator;
                        }
                    else if (empty($input['action']))  //removing
                        {
                            unset($selection['radiator']);
                        }
                    
                }    
                
            $request->session()->put('selection', $selection);
            $success = true;
            
            return response()->json(['success'=>$success,'selection'=>$selection]);
        }
    }
}
