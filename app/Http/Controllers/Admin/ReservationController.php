<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use App\Models\Reservation;
    use Inertia\Inertia;
    use App\Models\Vehicle;
    use function redirect;
    use App\Models\Pool;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Approval;
    use App\Models\Office;
    use App\Exports\ReservationExport;
    use Maatwebsite\Excel\Facades\Excel;

    class ReservationController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Inertia\Response
         */
        public function index()
        {
            $reservations = Reservation::with(['vehicle', 'approvals', 'trip'])->get();
            return Inertia::render('Admin/Reservation/Index', compact('reservations'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Inertia\Response
         */
        public function create()
        {
            $pool     = Pool::where('admin_user_id', Auth::id())->first();
            $vehicles = Vehicle::where('is_available', true)->where('pool_id', $pool->id)->get();
            return Inertia::render('Admin/Reservation/Create', compact('vehicles'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function store(Request $request)
        {
            $reservationInput                 = $request->validate([
                'name'       => 'required',
                'vehicle_id' => 'required',
                'note'       => 'required',
            ]);
            $reservationInput[ 'created_by' ] = Auth::id();

            $reservation = new Reservation($reservationInput);
            $reservation->save();

            $pool                = Pool::where('admin_user_id', Auth::id())->first();
            $reservationApproval = new Approval([
                'reservation_id' => $reservation->id,
                'level'          => 1,
                'user_id'        => $pool->head_user_id,
            ]);
            $reservationApproval->save();
            $office              = Office::where('id', $pool->office_id)->first();
            $reservationApproval = new Approval([
                'reservation_id' => $reservation->id,
                'level'          => 2,
                'user_id'        => $office->user_id,
            ]);
            $reservationApproval->save();

            Vehicle::where('id', $reservationInput[ 'vehicle_id' ])->update([
                'is_available' => false,
            ]);

            return redirect('/admin/reservation')->with('message', 'Pemesanan Berhasil Disimpan');
        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Inertia\Response
         */
        public function edit($id)
        {
            $reservation = Reservation::with('approvals')->where('id', $id)->first();

            $approvals = [];
            foreach ($reservation->approvals as $approval) {
                $approvals[] = $approval->is_approved;
            }

            $allowUpdate = false;
            $a           = array_unique($approvals);
            if (count($a) === 1) {
                if ($a[ 0 ] === NULL || $a[ 0 ] === false) {
                    $allowUpdate = true;
                }
            }

            if (!$allowUpdate) {
                return redirect()->back()->with('error', 'Pemesanan Tidak Diperbolehkan Diperbarui');
            }

            $pool     = Pool::where('admin_user_id', Auth::id())->first();
            $vehicles = Vehicle::where('is_available', true)->where('pool_id', $pool->id)->orWhere('id', $reservation->vehicle_id)->get();

            return Inertia::render('Admin/Reservation/Edit', compact('reservation', 'vehicles'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $reservation = Reservation::find($id);
            $prevVehicleId = $reservation->vehicle_id;
            $reservationInput = $request->validate([
                'name'       => 'required',
                'vehicle_id' => 'required',
                'note'       => 'required',
            ]);

            $reservation->update($reservationInput);

            Vehicle::where('id', $prevVehicleId)->update([
                'is_available' => true,
            ]);
            Vehicle::where('id', $reservationInput[ 'vehicle_id' ])->update([
                'is_available' => false,
            ]);

            return redirect('/admin/reservation')->with('message', 'Pemesanan Berhasil Disimpan');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
         */
        public function destroy($id)
        {
            $reservation = Reservation::with('approvals')->where('id', $id)->first();

            $approvals = [];
            foreach ($reservation->approvals as $approval) {
                $approvals[] = $approval->is_approved;
            }

            $allowDelete = false;
            $a           = array_unique($approvals);
            if (count($a) === 1) {
                if ($a[ 0 ] === NULL || $a[ 0 ] === false) {
                    $allowDelete = true;
                }
            }

            if (!$allowDelete) {
                return redirect()->back()->with('error', 'Pemesanan Tidak Diperbolehkan Dihapus');
            }

            $reservation->delete();
            Approval::where('reservation_id', $id)->delete();
            Vehicle::where('id', $reservation->vehicle_id)->update([
                'is_available' => true,
            ]);
            return redirect('/admin/reservation')->with('message', 'Pemesanan Berhasil Dihapus');
        }

        /**
         * Export reservation.
         *
         * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
         */
        public function export()
        {
            return Excel::download(new ReservationExport(), 'reservations.xlsx');
        }
    }
