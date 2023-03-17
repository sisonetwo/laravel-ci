<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class MahasiswaDbController extends Controller
{
    //
    public function show()
    {
        $list = DB::table('mahasiswa')->get();
        return response()->json([
            'data' => $list
        ]);
    }

    public function index(Request $request, $id)
    {
        $mahasiswa = DB::table('mahasiswa')->where('nim', '=', $id)->first();
        return response()->json($mahasiswa);
    }

    public function destroy($id)
    {
        DB::table('mahasiswa')->delete($id);
    }

    public function store(request $request)
    {
        DB::table('mahasiswa')->insert([
            'id' => Uuid::uuid4(),
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'semester' => $request->semester,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
