<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Brand\BrandRepository;

class DashboardController extends Controller
{
    /**
     * BoilerRepository $boiler
     */
    private $boiler;
    /**
     * BrandRepository $brand
     */
    private $brand;

    /**
     * DashboardController Contructor
     *
     * @param BoilerRepository $boiler
     * @param BrandRepository $brand
     */
    public function __construct(
        BoilerRepository $boiler,
        BrandRepository $brand
    )
    {
        $this->boiler = $boiler;
        $this->brand = $brand;
    }

    /**
     * Show CMS dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $totalBrands = $this->brand->getWithCondition(['type' => 'Brand'])->count();
        $totalBoilers = $this->boiler->getAll()->count();
        $publishedBoilers = $this->boiler->getBy('publish', true)->count();
        return view('cms.dashboard')
            ->with('totalBrands', $totalBrands)
            ->with('totalBoilers', $totalBoilers)
            ->with('publishedBoilers', $publishedBoilers);
    }
}
