<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\Trip;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($reservationId)
    {
        $reservation = Reservation::where('id', $reservationId)->first();
        $vehicle = Vehicle::where('id', $reservation->vehicle_id)->first();
        return Inertia::render('Admin/Trip/Create', compact('reservation', 'vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $tripInput = $request->validate([
            'reservation_id' => 'required',
            'vehicle_id' => 'required',
            'out_date' => 'required'
        ]);

        $trip = new Trip($tripInput);
        $trip->save();

        return redirect('/admin/reservation')->with('message', 'Riwayat Kendaraan Keluar Berhasil Disimpan');
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
        $trip = Trip::find($id);
        return Inertia::render('Admin/Trip/Edit', compact('trip'));
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
        $tripInput = $request->validate([
            'entry_date' => 'required',
            'total_trip' => 'required',
            'fuel_consumption' => 'required'
        ]);

        $trip = Trip::find($id);
        $trip->update($tripInput);

        Vehicle::where('id', $trip->vehicle_id)->update([
            'is_available' => true,
        ]);

        return redirect('/admin/reservation')->with('message', 'Riwayat Kendaraan Masuk Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
