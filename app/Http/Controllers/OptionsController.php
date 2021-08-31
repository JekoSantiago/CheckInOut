<?php

namespace App\Http\Controllers;

use App\Models\Common;
use MyHelper;
use App\Location;
use App\Programs;
use Illuminate\Contracts\Session\Session as SessionSession;
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

    public function getEmployeeList(Request $request)
    {
        $param = [
            MyHelper::decrypt(Session::get('Employee_ID')),
            $request -> dateFrom,
            $request -> dateTo
        ];

        // dump($param);
        $data = Common::getUnder($param);
        // dd($data);
        $output = '<option value ="0">ALL</option>';

        foreach($data as $emp) :
            $output .= '<option value="'. $emp->Employee_ID .'">'. $emp->FullName .'</option>';
        endforeach;

        echo $output;
    }
}
