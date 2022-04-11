<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (request()->ajax()) {

            $data = Jadwal::with('shift','user')
            ->select('id', 'user_id', 'tanggal_mulai', 'tanggal_selesai', 'shift_id')
            ->where('tanggal_mulai', '>=', $request->get('from'))
            ->where('tanggal_selesai', '<=', $request->get('to'))
            ->orderByDesc('tanggal_mulai');

            return Datatables::of($data->get())
                ->addIndexColumn()
                ->addColumn('tgl_mulai', function ($data) {
                    return date("d F Y", strtotime($data->tanggal_mulai));
                })
                ->addColumn('tgl_selesai', function ($data) {
                    return date("d F Y", strtotime($data->tanggal_selesai));
                })
                ->addColumn('action', function ($data) {
                        $actionBtn = '
                                        <center>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Bayar" onclick="bayar(' . $data->id . ')"><i class="ti-money"></i></a>
                                      
                                        </center>';
                    return $actionBtn;
                })
                ->rawColumns(['tgl_mulai','tgl_selesai','action'])
                ->make(true);
        }

        return view('karyawan.jadwal.index',[
            'title' => 'Jadwal'
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
        //
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
