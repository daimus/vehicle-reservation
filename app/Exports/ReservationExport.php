<?php

namespace App\Exports;

use App\Models\Reservation;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReservationExport implements FromArray, WithHeadingRow
{

    public function array(): array
    {
        $data = [];
        $reservations = Reservation::with(['vehicle', 'approvals', 'trip'])->get();
        foreach ($reservations as $reservation) {
            $datum = [];
            $datum[] = $reservation->name;
            $datum[] = $reservation->note;
            $datum[] = $reservation->created_at;
            $datum[] = $reservation->vehicle->brand;
            $datum[] = $reservation->vehicle->model;
            $datum[] = $reservation->vehicle->type;
            $approvals = [];
            foreach ($reservation->approvals as $approval){
                $approvals[] = $approval;
            }
            if (end($approvals)->is_approved === null){
                $datum[] = 'MENUNGGU PERSETUJUAN';
            } else {
                $datum[] = end($approvals)->is_approved === true ? 'DISETUJUI' : 'DITOLAK';
            }
            $datum[] = @$reservation->trip->out_date;
            $datum[] = @$reservation->trip->entry_date;
            $datum[] = @$reservation->trip->total_trip;
            $datum[] = @$reservation->trip->fuel_consumption;
            $data[] = $datum;
        }
        $headings = $this->headings();
        array_unshift( $data, $headings);
        return $data;
    }

    public function headings(): array
    {
        return ["NAMA PEMESAN", "CATATAN PEMESANAN", "TANGGAL PEMESANAN", "MERK KENDARAAN", "MODEL KENDARAAN", "JENIS KENDARAAN", "PERSETUJUAN", "TANGGAL KENDARAAN KELUAR", "TANGGAL KENDARAAN MASUK", "TOTAL JARAK TEMPUH", "TOTAL KONSUMSI BBM"];
    }
}
