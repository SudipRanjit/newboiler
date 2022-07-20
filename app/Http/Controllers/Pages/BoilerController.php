<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Webifi\Repositories\Category\CategoryRepository;

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
            return redirect()->route('page.index');
        }    

        $last_completed_wizards = ['page.index','page.boiler','page.control','page.radiator','page.smart-device','page.booking']; 
        if ($selection && !in_array($selection['page'],$last_completed_wizards))
        {
            //set flash message and redirect to lastly selected wizard
            return redirect()->route($selection['page']);
        }
        //$selection = json_encode($selection);

        $this->category = new CategoryRepository(app()) ;        
        $categories = $this->category->getWithCondition(['publish' => 1, 'type' => 'brand'])->pluck('category', 'id');
        //dd($categories);
        return view('pages.boiler.index',compact(/*'selection',*/'categories'));
    }

}
