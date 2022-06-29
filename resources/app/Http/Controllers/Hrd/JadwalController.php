<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Shift;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class JadwalController extends Controller
{
    public function index(Request $request)
    {

        if (request()->ajax()) {

            if ($request->jabatan == 'all') {
                $data = DB::table('jadwal')
                    ->join('shift', 'shift.id', '=', 'jadwal.shift_id')
                    ->join('users', 'users.id', '=', 'jadwal.user_id')
                    ->join('jabatan', 'jabatan.id', '=', 'users.jabatan_id')
                    ->join('karyawan', 'karyawan.user_id', '=', 'users.id')
                    ->select('jadwal.*', 'jabatan.nama', 'karyawan.nama as nama_karyawan', 'shift.nama as nama_shift')
                    ->where('jadwal.tanggal_mulai', '>=', $request->get('from'))
                    ->where('jadwal.tanggal_selesai', '<=', $request->get('to'))
                    ->orderByDesc('jadwal.tanggal_mulai');
            } else {
                $data = DB::table('jadwal')
                    ->join('shift', 'shift.id', '=', 'jadwal.shift_id')
                    ->join('users', 'users.id', '=', 'jadwal.user_id')
                    ->join('jabatan', 'jabatan.id', '=', 'users.jabatan_id')
                    ->join('karyawan', 'karyawan.user_id', '=', 'users.id')
                    ->select('jadwal.*', 'jabatan.nama', 'karyawan.nama as nama_karyawan', 'shift.nama as nama_shift')
                    ->where('jabatan.id', '=', $request->jabatan)
                    ->where('jadwal.tanggal_mulai', '>=', $request->get('from'))
                    ->where('jadwal.tanggal_selesai', '<=', $request->get('to'))
                    ->orderByDesc('jadwal.tanggal_mulai');
            }

            return Datatables::of($data->get())
                ->addIndexColumn()
                ->addColumn('tgl', function ($data) {
                    return date("d/m/Y", strtotime($data->tanggal_mulai)) . ' - ' . date("d/m/Y", strtotime($data->tanggal_selesai));
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '
                        <center>
                        <a href="javascript:void(0)" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $data->id . ')"><i class="ti-pencil-alt"></i></a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-link" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $data->id . ')"><i class="ti-trash"></i></a>
                        </center>';
                    return $actionBtn;
                })
                ->rawColumns(['tgl_mulai', 'tgl_selesai', 'action'])
                ->make(true);
        }

        $user       = Karyawan::select('user_id', 'nama')->get();
        $shift      = Shift::select('id', 'nama')->get();
        $jabatan    = Jabatan::select('id', 'nama')->get();

        return view('hrd.jadwal.index', [
            'title'    => 'Jadwal Kerja',
            'user'     => $user,
            'shift'    => $shift,
            'jabatan'  => $jabatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'           => 'required',
            'shift_id'          => 'required',
            'tanggal_mulai'     => 'required',
            'tanggal_selesai'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        if ($request->id) {

            Jadwal::find($request->id)->update(
                [
                    'user_id'           => $request->user_id,
                    'shift_id'          => $request->shift_id,
                    'tanggal_mulai'     => $request->tanggal_mulai,
                    'tanggal_selesai'   => $request->tanggal_selesai,
                ]
            );
        } else {

            Jadwal::Create(
                [
                    'user_id'           => $request->user_id,
                    'shift_id'          => $request->shift_id,
                    'tanggal_mulai'     => $request->tanggal_mulai,
                    'tanggal_selesai'   => $request->tanggal_selesai,
                ]
            );
        }

        return response()->json(['status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jadwal::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();
        return response()->json(['status' => true]);
    }
}
