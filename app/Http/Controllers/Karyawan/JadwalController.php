<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    
    public function index(Request $request)
    {
        $jadwal = Jadwal::select('user_id as title','tanggal_mulai as start','shift_id as end')
        ->where('user_id',auth()->user()->id)->get();

        return view('karyawan.jadwal.index', compact('jadwal'), [
            'title'     => 'Kalender'
        ]);
        
    }

    public function show($id)
    {
    
        $cek = Jadwal::with('shift','user')
        ->where('user_id',auth()->user()->id)
        ->select('tanggal_mulai','tanggal_selesai','shift_id','user_id')
        ->get();

        foreach($cek as $data){
            if ($data->shift_id == 1) {
                $eventColor = '#fb8c00';
            } else if ($data->shift_id == 2) {
                $eventColor = '#ff0';
            } else {
                $eventColor = '#00acc1';
            }

            $array = [
                'title'  => $data->shift->nama,
                'start'  => $data->tanggal_mulai .' '. $data->shift->jam_masuk,
                'end'    => $data->tanggal_selesai .' '. $data->shift->jam_pulang,
                'color'  => $eventColor,
            ];

            $result[] = $array;
        }

        return $result;
    }

}
