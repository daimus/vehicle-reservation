<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\Approval;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $approvals = Approval::where('user_id', Auth::id())->with(['reservation', 'vehicle'])->get();
        return Inertia::render('Officer/Approval/Index', compact('approvals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id, $action)
    {
        $approval = Approval::find($id);
        $approvalInput = [
            'is_approved' => $action === 'approve'
        ];

        $approval->update($approvalInput);

        $reservation = Reservation::where('id', $approval->reservation_id)->first();

        Vehicle::where('id', $reservation->vehicle_id)->update([
            'is_available' => !$approvalInput['is_approved'],
        ]);

        return redirect('/officer/approval')->with('message', 'Persetujuan Reservasi Berhasil Disimpan');
    }
}
