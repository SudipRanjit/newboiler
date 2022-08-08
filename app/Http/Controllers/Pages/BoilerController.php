<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Category\CategoryRepository;
use App\Webifi\Repositories\Boiler\BoilerRepository;

class BoilerController extends Controller
{

   /**
   * Constructor
   * @param CategoryRepository $category
   */
  public function __construct__(
    CategoryRepository $category
    
  ) {
    $this->category = $category;
    
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

        if ($selection && !in_array('page.index', $selection['completed_wizard']))
        {
            //set flash message and redirect 
            return redirect()->route('page.index')
                              ->with('error', "Please select options." );                  
        }
        
        $Category = new CategoryRepository(app()) ;        
        $categories = $Category->getWithCondition(['publish' => 1, 'type' => 'brand'])->pluck('category', 'id');
        //dd($categories);
        return view('pages.boiler.index',compact('categories'));
    }

    public function view($id)
    {
      $Boiler = new BoilerRepository(app()) ;        
      $boiler = $Boiler->find($id);
      
      if (!$boiler)
        abort(404);

      //dd($boiler);  
      return view('pages.boiler.view',compact('boiler'));
    }

}
