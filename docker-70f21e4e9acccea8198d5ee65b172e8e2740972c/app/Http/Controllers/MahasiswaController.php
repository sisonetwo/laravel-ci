<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        return response()->json([
            "data" => array(
                [
                    'id' => '01',
                    'name' => 'Dimas Maryanto',
                    'email' => 'software.dimas_m@icloud.com',
                    'nim' => '10511148',
                    'semester' => 5
                ],
                [
                    'id' => '02',
                    'name' => 'Muhamad Yusuf',
                    'email' => 'muhyusuf@gmail.com',
                    'nim' => '10512110',
                    'semester' => 4
                ]
            )
        ], 200);

    }

    public function show()
    {
        return response()->json(
            [
                'id' => '01',
                'name' => 'Dimas Maryanto',
                'email' => 'software.dimas_m@icloud.com',
                'nim' => '10511148',
                'semester' => 5
            ], 200);
    }
}
