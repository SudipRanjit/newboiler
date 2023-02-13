<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Webifi\Repositories\Addon\AddonRepository;
use App\Webifi\Repositories\Boiler\BoilerRepository;
use App\Webifi\Repositories\Device\DeviceRepository;
use App\Webifi\Repositories\Radiator\RadiatorPriceRepository;
use App\Webifi\Repositories\Radiator\RadiatorRepository;
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
        if ($request->ajax()) {
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
            $selection['completed_wizard'][] = 'page.index';
            $selection['conversion_charge'] = $input['conversion_charge'];

            if (isset($input['moving_boiler'])) {
                $selection['moving_boiler'] = $input['moving_boiler'];
            }

            if (isset($input['scaffolding'])) {
                $selection['scaffolding'] = $input['scaffolding'];
            }

            if (isset($input['post_code_first_part'])) {
                $selection['post_code_first_part'] = $input['post_code_first_part'];
            }

            if (isset($input['scaffolding'])) {
                $selection['scaffolding'] = $input['scaffolding'];
            }

            $request->session()->put('selection', $selection);
            if ($request->session()->has('selection')) {
                $success = true;
            }

            return response()->json(['success' => $success, 'selection' => $selection]);
        }
    }

    /**
     * update answer in session named 'selection'
     *
     * @param Request $request
     */
    public function updateAnswer(Request $request)
    {
        if ($request->ajax()) {
            $input = $request->all();
            //dd($input);

            $total_price = 0;
            $success = false;
            $selection = $request->session()->has('selection') ? $request->session()->get('selection') : [];

            if (isset($input['beds'])) {
                $selection['beds'] = $input['beds'];
            }

            if (isset($input['baths'])) {
                $selection['baths'] = $input['baths'];
            }

            if (isset($input['showers'])) {
                $selection['showers'] = $input['showers'];
            }

            if (isset($input['boiler_type'])) {
                $selection['boiler_type'] = $input['boiler_type'];
            }

            if (isset($input['bConvert'])) {
                $selection['bConvert'] = $input['bConvert'];
            }

            if (isset($input['completed_wizard']) && !in_array($input['completed_wizard'], $selection['completed_wizard'])) {
                $selection['completed_wizard'][] = $input['completed_wizard'];
            }

            if (isset($input['conversion_charge'])) {
                $selection['conversion_charge'] = $input['conversion_charge'];
            }

            if (isset($input['moving_boiler'])) {
                $selection['moving_boiler'] = $input['moving_boiler'];
            }

            if (isset($input['scaffolding'])) {
                $selection['scaffolding'] = $input['scaffolding'];
            }

            if (isset($input['boiler'])) {
                $selection['boiler'] = $input['boiler'];
            }

            if (isset($input['control'])) {
                $selection['control'] = $input['control'];
            }

            if (isset($input['device'])) {
                $devices = $selection['devices'] ?? [];

                if (!empty($input['quantity']) && !empty($input['action'])) //adding
                {
                    $devices[$input['device']]['quantity'] = $input['quantity'];
                } else if (empty($input['action'])) //removing
                {
                    unset($devices[$input['device']]);
                }

                if (empty($input['quantity'])) {
                    unset($devices[$input['device']]);
                }

                $selection['devices'] = $devices;

                if (empty($selection['devices'])) {
                    unset($selection['devices']);
                    if (($key = array_search('page.smart-devices', $selection['completed_wizard'])) !== false) {
                        unset($selection['completed_wizard'][$key]);
                    }
                }
            }

            if (isset($input['radiator'])) {
                $radiator = $selection['radiator'] ?? [];

                if (!empty($input['quantity']) && !empty($input['action'])) //adding
                {
                    $radiator['id'] = $input['radiator'];
                    $radiator['quantity'] = $input['quantity'];
                    $selection['radiator'] = $radiator;

                } else if (empty($input['action'])) //removing
                {
                    unset($selection['radiator']);
                }

                if (empty($input['quantity'])) {
                    unset($selection['radiator']);
                }

                if (empty($selection['radiator'])) {
                    if (($key = array_search('page.radiators', $selection['completed_wizard'])) !== false) {
                        unset($selection['completed_wizard'][$key]);
                    }
                }
            }

            if (isset($input['radiator_type'])) {
                $selection['radiator_type'] = $input['radiator_type'];
            }

            if (isset($input['radiator_height'])) {
                $selection['radiator_height'] = $input['radiator_height'];
            }

            if (isset($input['radiator_length'])) {
                $selection['radiator_length'] = $input['radiator_length'];
            }

            //calculate total_price
            if (!empty($selection['conversion_charge'])) {
                $total_price += $selection['conversion_charge'];
            }

            if (!empty($selection['moving_boiler'])) {
                $total_price += $selection['moving_boiler']['price'];
            }

            if (!empty($selection['scaffolding'])) {
                $total_price += $selection['scaffolding']['price'];
            }

            if (!empty($selection['boiler'])) {
                $Boiler = new BoilerRepository(app());
                $boiler = $Boiler->find($selection['boiler']);
                if ($boiler) {
                    $total_price += $boiler->price - $boiler->discount ?? 0;
                }
            }

            if (!empty($selection['control'])) {
                $Addon = new AddonRepository(app());
                $addon = $Addon->find($selection['control']);
                if ($addon) {
                    $total_price += $addon->price;
                }
            }

            if (!empty($selection['devices'])) {
                $devices = $selection['devices'];
                $Device = new DeviceRepository(app());
                foreach ($devices as $device_id => $d) {
                    $device = $Device->find($device_id);
                    if ($device) {
                        $total_price += round($device->price * $d['quantity'], 2);
                    }
                }

            }

            if (!empty($selection['radiator']['id'])) {
                $RadiatorPrice = new RadiatorPriceRepository(app());

                if (!empty($selection['radiator_type']) && !empty($selection['radiator_height']) && !empty($selection['radiator_length'])) {
                    $record = $RadiatorPrice->findWithCondition(['radiator_type_id' => $selection['radiator_type'], 'radiator_height_id' => $selection['radiator_height'], 'radiator_length_id' => $selection['radiator_length']], ['price', 'btu']);
                    $Radiator = new RadiatorRepository(app());
                    
                    //$selection['radiator_info'] = $Radiator->findby('id', $selection['radiator_type']); //What is this logic? (If only one radiator can be added) - Comment by Sudip Feb 13
                    $selection['radiator_info'] = $Radiator->findby('id', 1);
                }

                if ($record) {
                    $total_price += round($record->price * $selection['radiator']['quantity'], 2);
                }
            }

            //end calculating total_price

            $selection['total_price'] = round($total_price, 2);
            $request->session()->put('selection', $selection);
            $success = true;

            return response()->json(['success' => $success, 'selection' => $selection]);
        }
    }
}
