<?php

namespace App\Http\Controllers;

use App\Models\Common;
use MyHelper;
use App\Location;
use App\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OptionsController extends Controller
{
    public function getDC()
    {
        $data = Common::getDC();

        $output = '<option></option>';

        foreach($data as $dc) :
            $output .= '<option value="'. $dc->Location_ID.'">'. $dc->Location .'</option>';
        endforeach;

        echo $output;
    }


    public function getStore(Request $request)
    {

        // dd($request);

        $data = Common::getStore($request->DC);

        $output = '<option></option>';

        foreach($data as $store) :
            $output .= '<option value="'. $store->Location_ID .'">'. $store->LocationCode . "-" . $store->Location .'</option>';
        endforeach;

        echo $output;
    }
}
