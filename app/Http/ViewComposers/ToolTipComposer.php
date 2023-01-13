<?php

namespace App\Http\ViewComposers;


use App\Webifi\Models\User\Module;
use Illuminate\Database\Eloquent\Collection;
use App\Webifi\Repositories\Boiler\ToolTipRepository;
use Illuminate\View\View;

class ToolTipComposer 
{
    /**
     * TooltipRepository $toolTip
     */
    private $toolTip;

    /**
     * ToolTipComposer
     * 
     * @param ToolTipRepository $toolTip
     */
    public function __construct(ToolTipRepository $toolTip)
    {
      $this->toolTip = $toolTip;
    }

    public function compose(View $view)
    {
        $toolTip = $this->toolTip->find(1);

        return $view->with('toolTip',$toolTip);
    }
}