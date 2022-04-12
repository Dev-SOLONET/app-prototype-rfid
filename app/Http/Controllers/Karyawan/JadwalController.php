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

        $jadwal = Jadwal::select('user_id as title','tanggal_mulai as start','shift_id as end')->get();

        return view('karyawan.jadwal.index', compact('jadwal'), [
            'title'     => 'Kalender'
        ]);
        
    }

    public function show($id)
    {
        $cek = Jadwal::with('shift','user')
        ->select('tanggal_mulai','tanggal_selesai','shift_id','user_id')
        ->get();

        foreach($cek as $data){
            $array = [
                'title'  => $data->shift->nama,
                'start'  => $data->tanggal_mulai .' '. $data->shift->jam_masuk,
                'end'    => $data->tanggal_selesai .' '. $data->shift->jam_pulang,
            ];

            $result[] = $array;
        }

        return $result;
    }


}
