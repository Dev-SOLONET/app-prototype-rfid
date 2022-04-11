<?php

namespace App\Http\Controllers\Hrd;

use App\Models\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
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
                ->addColumn('action', function ($row) {

                    $actionBtn = '
                            <center>
                            <a href="karyawan/'.$row->id.'/edit" class="btn btn-sm btn-outline-info" data-toggle="tooltip" data-placement="top" title="Slip Gaji"><i class="ti-money"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Edit" onclick="edit(' . $row->id . ')"><i class="ti-pencil-alt"></i></a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="delete_data(' . $row->id . ')"><i class="ti-trash"></i></a>
                            </center>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $jabatan    = Jabatan::select('id', 'nama')->get();

        return view('hrd.karyawan.index', [
            'title'     => 'Karyawan',
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

        if (!$request->id) {

            $validator = Validator::make($request->all(), [
                'nik'       => 'required',
                'nama'      => 'required',
                'no_hp'     => 'required',
                'alamat'    => 'required',
                'username'      => 'required|unique:App\Models\User,name',
                'password'  => 'required',
                'jabatan'   => 'required',
                'jenis_kelamin'   => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            // add data
            DB::beginTransaction();

            try {

                User::Create([
                    'name'              => $request->username,
                    'password'          => Hash::make($request->password),
                    'jabatan_id'        => $request->jabatan,
                    'uid'               => '',
                    'email'             => $request->username . '@mail',
                ]);

                $user = User::where('name', $request->username)->first();

                Karyawan::Create([
                    'user_id'           => $user->id,
                    'nik'               => $request->nik,
                    'nama'              => $request->nama,
                    'alamat'            => $request->alamat,
                    'no_hp'             => $request->no_hp,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                ]);

                DB::commit();

                return response()->json(['status' => true]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e]);
            }
        } else {

            $validator = Validator::make($request->all(), [
                'nik'       => 'required',
                'nama'      => 'required',
                'no_hp'     => 'required',
                'alamat'    => 'required',
                'jabatan'   => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            DB::beginTransaction();

            try {

                Karyawan::find($request->id)->update([
                    'nik'               => $request->nik,
                    'nama'              => $request->nama,
                    'alamat'            => $request->alamat,
                    'no_hp'             => $request->no_hp,
                    'jenis_kelamin'     => $request->jenis_kelamin,
                ]);

                $karyawan = Karyawan::find($request->id);

                if ($request->password == null) {
                    // update data
                    User::find($karyawan->user_id)->update([
                        'name'              => $request->username,
                        'jabatan_id'        => $request->jabatan,
                        'uid'               => '',
                    ]);
                } else {
                    // update data
                    User::find($karyawan->user_id)->update([
                        'name'              => $request->username,
                        'password'          => Hash::make($request->password),
                        'jabatan_id'        => $request->jabatan,
                        'uid'               => '',
                    ]);
                }

                DB::commit();

                return response()->json(['status' => true]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json(['error' => $e]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Karyawan::with('user.jabatan')->find($id);
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
        $data = Karyawan::with('user.jabatan')->find($id);

        return view('hrd.karyawan.slip-gaji', [
            'title'     => 'Karyawan',
            'data'      => $data
        ]);
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
        DB::beginTransaction();

        try {

            $karyawan = Karyawan::find($id);
            User::find($karyawan->user_id)->delete();
            $karyawan->delete();
            DB::commit();

            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e]);
        }
    }
}
