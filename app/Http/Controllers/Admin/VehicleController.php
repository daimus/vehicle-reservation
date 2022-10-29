<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Inertia\Inertia;
use App\Models\Pool;
use function redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;
use DateTime;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $pool = Pool::where('admin_user_id', Auth::id())->first();
        $vehicles = Vehicle::where('pool_id', $pool->id)->get();
        foreach ($vehicles as $vehicle) {
            $vehicle->total_trip = DB::table('trips')
                ->where('vehicle_id', $vehicle->id)
                ->sum('total_trip');
            $vehicle->total_fuel_consumption = DB::table('trips')
                ->where('vehicle_id', $vehicle->id)
                ->sum('fuel_consumption');
            $vehicle->avg_fuel_consumption = $vehicle->total_trip <= 0 ? 0 : $vehicle->total_trip / $vehicle->total_fuel_consumption;
        }
        return Inertia::render('Admin/Vehicle/Index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Vehicle/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $vehicleInput = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'vehicle_no' => 'required',
            'type'  => 'required',
            'ownership' => 'required',
        ]);
        $vehicleInput['is_available'] = true;
        $pool = Pool::where('admin_user_id', Auth::id())->first();
        $vehicleInput['pool_id'] = $pool->id;
        $vehicle = new Vehicle($vehicleInput);
        $vehicle->save();

        return redirect('/admin/vehicle')->with('message', 'Kendaraan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        return Inertia::render('Admin/Vehicle/Edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $vehicleInput = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'vehicle_no' => 'required',
            'type'  => 'required',
            'ownership' => 'required',
        ]);

        $vehicle = Vehicle::find($id);
        $vehicle->update($vehicleInput);
        return redirect('/admin/vehicle')->with('message', 'Kendaraan Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Vehicle::where('id', $id)->delete();
        return redirect('/admin/vehicle')->with('message', 'Kendaraan Berhasil Disimpan');
    }
}
