<?php

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Approval;
use Illuminate\Support\Facades\Auth;

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
        return Inertia::render('Head/Approval/Index', compact('approvals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $action)
    {
        $approval = Approval::find($id);
        $approvalInput = [
            'is_approved' => $action === 'approve'
        ];

        $approval->update($approvalInput);

        return redirect('/head/approval')->with('message', 'Persetujuan Reservasi Berhasil Disimpan');
    }
}
