<?php

namespace App\Http\Controllers\Api;

use App\Unit;
use App\Zone;
use App\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function units() {
        $units = Unit::all();
        return response()->json($units);
    }

    public function zones() {
        $zones = Zone::all();
        return response()->json($zones);
    }

    public function vehicles() {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
    }
}
