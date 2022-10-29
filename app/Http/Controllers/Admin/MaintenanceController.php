<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vehicle;
use App\Models\Pool;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;
use DateTime;

class MaintenanceController extends Controller
{
    public function index(){
        $maintenanceInterval = 1000;

        $pool = Pool::where('admin_user_id', Auth::id())->first();
        $vehicles = Vehicle::where('pool_id', $pool->id)->get();
        foreach ($vehicles as $vehicle) {
            $averageDailyTrips = [];
            $trips = Trip::where('vehicle_id', $vehicle->id)->whereNotNull('entry_date')->get();
            foreach ($trips as $trip) {
                $outDate = new DateTime($trip->out_date);
                $entryDate = new DateTime($trip->entry_date);
                $interval = $outDate->diff($entryDate);
                $dayDiff = $interval->days;
                $averageDailyTrips[] = $trip->total_trip / ($dayDiff <= 0 ? 1 : $dayDiff);
            }

            $totalDailyTrips = count($averageDailyTrips);
            if ($totalDailyTrips > 0){
                $vehicle->avg_daily_trip = array_sum($averageDailyTrips) / $totalDailyTrips;
            } else {
                $vehicle->avg_daily_trip = 0;
            }

            $vehicle->total_trip = DB::table('trips')
                ->where('vehicle_id', $vehicle->id)
                ->sum('total_trip');
            $vehicle->total_fuel_consumption = DB::table('trips')
                ->where('vehicle_id', $vehicle->id)
                ->sum('fuel_consumption');
            $vehicle->avg_fuel_consumption = $vehicle->total_trip <= 0 ? 0 : $vehicle->total_trip / $vehicle->total_fuel_consumption;

            if ($vehicle->total_trip > 1000){
                $vehicle->next_maintenance_in_range =  abs($vehicle->total_trip % $maintenanceInterval - $maintenanceInterval);
            } else {
                $vehicle->next_maintenance_in_range =  $maintenanceInterval - $vehicle->total_trip;
            }
            if ($vehicle->avg_daily_trip > 0){
                $vehicle->next_maintenance_in_day = $vehicle->next_maintenance_in_range / $vehicle->avg_daily_trip;
            } else {
                $vehicle->next_maintenance_in_day = 'Unknown';
            }
        }
        return Inertia::render('Admin/Maintenance', compact('vehicles'));
    }
}
