<?php

namespace App\Http\Controllers;

use App\Models\Monitoring;
use Illuminate\Http\Request;
use Myhelper;

class MonitoringController extends Controller
{
    public function getCheckInOut(Request $request)
    {
        $param = [
            $request->Employee,
            $request->DateFrom,
            $request->DateTo,
                ];

        $data = Monitoring::getCheckInOutv2($param);
        return datatables($data)->toJson();

    }
}
