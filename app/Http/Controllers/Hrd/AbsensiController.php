<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class AbsensiController extends Controller
{
    public function index(Request $request)
    {

        if (request()->ajax()) {

            $data = Absensi::with('shift','user')
            ->select('id', 'user_id', 'tanggal', 'jam_masuk', 'jam_pulang', 'jam_lembur', 'shift_id')
            ->where('tanggal', '>=', $request->get('from'))
            ->where('tanggal', '<=', $request->get('to'))
            ->orderByDesc('tanggal');

            return Datatables::of($data->get())
                ->addIndexColumn()
                ->addColumn('tgl', function ($data) {
                    return date("d F Y", strtotime($data->tanggal));
                })
                ->addColumn('action', function ($data) {
                        $actionBtn = '
                                        <center>
                                        <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Bayar" onclick="bayar(' . $data->id . ')"><i class="ti-money"></i></a>
                                      
                                        </center>';
                    return $actionBtn;
                })
                ->rawColumns(['tgl', 'action'])
                ->make(true);
        }

        return view('hrd.absensi.index',[
            'title' => 'Absensi'
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
