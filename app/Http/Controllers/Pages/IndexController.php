<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     *
     * @return view
     */
    public function index()
    {
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
            
            return response()->json(['success'=>$success]);
        }
    }
}
