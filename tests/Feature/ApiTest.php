<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tours;
use Illuminate\Support\Facades\Log;

class ApiTest extends TestCase
{
    public function testRequestAll()
    {
        $response = $this->getJson('/api/tours');

        Log::info([$response->getContent()]);
   
        $response->assertStatus(200)
        ->decodeResponseJson();
    } 

    public function testRequest()
    {
        $response = $this->getJson('/api/tours/1');

        Log::info([$response->getContent()]);
   
        $response->assertStatus(200)
        ->decodeResponseJson();
    } 

    public function testRegister()
    {
        $response = $this->postJson('/api/tours', [
            'start' => '2022-03-03 06:30:00', 
            'end' => '2022-04-15 06:30:00', 
            'price' => '99.99'
        ]);
        Log::info([$response->getContent()]);
        $response->assertStatus(201);

    }

    public function testUpdate()
    {
        $response = $this->putJson('/api/tours/1', [
            'start' => '2022-01-01 06:30:00', 
            'end' => '2022-02-02 06:30:00', 
            'price' => '399.99'
        ]);
        Log::info([$response->getContent()]);
        $response->assertStatus(200);

    }

    public function testDelete()
    {
        $response = $this->deleteJson('/api/tours/58');
        Log::info([$response->getContent()]);
        $response->assertStatus(202);

    }
}
