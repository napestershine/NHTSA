<?php

namespace Tests\Feature;

use TestCase;

class ApiTest extends TestCase
{

    public function test_api_can_return_response_for_correct_data()
    {
        $year = 2015;
        $make = 'Audi';
        $model = 'A3';
        $response = $this->call('GET', "/vehicles/{$year}/{$make}/{$model}");
        $this->assertEquals(200, $response->status());
    }

    public function test_api_can_return_response_for_post_data()
    {
        $params = [
            'modelYear' => 2015,
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ];
        $response = $this->call('POST', "/vehicles", $params);
        $this->assertEquals(200, $response->status());
    }

    public function test_api_can_return_response_for_bad_post_data()
    {
        $params = [
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ];
        $response = $this->call('POST', "/vehicles", $params);
        $this->assertEquals(200, $response->status());
        $this->seeJson([
            'Count' => 0,
            'Results' => []
        ]);
    }

    public function test_api_can_return_empty_response_for_bad_data()
    {
        $year = 'undefined';
        $make = 'Audi';
        $model = 'A3';
        $response = $this->call('GET', "/vehicles/{$year}/{$make}/{$model}");
        $this->assertEquals(200, $response->status());
        $this->seeJson([
            'Count' => 0,
            'Results' => []
        ]);
    }
}