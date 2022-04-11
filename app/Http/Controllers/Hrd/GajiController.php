<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //datatable
        if (request()->ajax()) {
            $data = Karyawan::with('user.jabatan')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('gaji', function ($data) {
                    return number_format($data->user->jabatan->gaji_pokok);
                })
                ->addColumn('action', function ($row) {

                    $actionBtn = '
                            <center>
                            <a href="/hrd/karyawan/'.$row->id.'/edit" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Slip Gaji"><i class="ti-money"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action','gaji'])
                ->make(true);
        }

        $jabatan    = Jabatan::select('id', 'nama')->get();

        return view('hrd.gaji.index', [
            'title'     => 'Gaji Karyawan',
            'jabatan'   => $jabatan
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
