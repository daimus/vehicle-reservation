<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vehicle;
use App\Models\Pool;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $vehicleStat = new \stdClass();
        $vehicleStat->total = 0;
        $vehicleStat->available = 0;
        $vehicleStat->unavailable = 0;

        $pool = Pool::where('admin_user_id', Auth::id())->first();
        $vehicles = Vehicle::where('pool_id', $pool->id)->get();

        foreach ($vehicles as $vehicle) {
            $vehicleStat->total++;
            if ($vehicle->is_available){
                $vehicleStat->available++;
            } else {
                $vehicleStat->unavailable++;
            }
        }

        return Inertia::render('Admin/Dashboard', compact('vehicleStat'));
    }
}
