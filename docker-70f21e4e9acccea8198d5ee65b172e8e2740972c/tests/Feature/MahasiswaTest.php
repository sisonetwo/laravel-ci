<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class MahasiswaTest extends TestCase
{

    public function test_find_all_mahasiswa()
    {
        $response = $this->get('/api/db/mahasiswa/list');
        $response->assertOk();
        Log::info($response->content());
    }

    public function test_find_by_id_mahasiswa()
    {
        $response = $this->get('/api/db/mahasiswa/' . '10511148');
        $response->assertOk();
        Log::info($response->content());
    }
}
