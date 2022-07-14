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
            $selection['beds'] = $input['beds'];
            $selection['baths'] = $input['baths'];
            $selection['showers'] = $input['showers'];
            $selection['boiler'] = $input['boiler'];
            $selection['bConvert'] = $input['bConvert'];
            $selection['page'] = 'page.index';
            
            $request->session()->put('selection', $selection);
            if ($request->session()->has('selection'))
                $success = true;
            
            return response()->json(['success'=>$success, 'selection'=>json_encode($selection)]);
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

            if (isset($input['boiler']))            
                $selection['boiler'] = $input['boiler'];
            
            if (isset($input['bConvert']))                
                $selection['bConvert'] = $input['bConvert'];
            
            if (isset($input['page']))    
                $selection['page'] = $input['page'];
            
            $request->session()->put('selection', $selection);
            $success = true;
            
            return response()->json(['success'=>$success,'selection'=>json_encode($selection)]);
        }
    }
}
