<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class APIController extends Controller
{

    private $url;

    private $client;

    /**
     * Validation rules for user
     *
     * @var array
     */
    private $rules = [
        'model_year' => 'integer|required',
        'make' => 'string|required',
        'model' => 'required|string',
    ];

    public function __construct()
    {
        $this->url = 'https://one.nhtsa.gov/webapi/api/SafetyRatings';
        $this->client = new Client();
    }

    public function gtest($model_year, $manufacturer, $model, Request $request)
    {
        $results = $this->apiResponse($model_year, $manufacturer, $model);

        if (!empty($request->get('withRating')) && $request->get('withRating') === "true") {
            foreach ($results['Results'] as $key => $value) {
                $result = $this->client->get($this->url . "/VehicleId/{$value['VehicleId']}?format=json");
                $data = json_decode($result->getBody()->getContents(), true);
                $results['Results'][$key]['CrashRating'] = $data['Results'][0]['OverallRating'];
            }
        }
        return response()->json($results, 200);
    }

    public function ptest(Request $request)
    {
        $model_year = $request->get('modelYear');
        $manufacturer = $request->get('manufacturer');
        $model = $request->get('model');
        $result = $this->apiResponse($model_year, $manufacturer, $model);
        return response()->json($result, 200);
    }

    /**
     * @param $model_year
     * @param $manufacturer
     * @param $model
     * @return mixed
     */
    public function nhtsa($model_year, $manufacturer, $model)
    {
        $result = $this->client->get($this->url . "/modelyear/{$model_year}/make/{$manufacturer}/model/{$model}?format=json");
        return json_decode($result->getBody()->getContents(), true);
    }

    /**
     * @param $model_year
     * @param $manufacturer
     * @param $model
     * @return mixed
     */
    public function apiResponse($model_year, $manufacturer, $model)
    {
        $array = [
            'model_year' => $model_year,
            'make' => $manufacturer,
            'model' => $model,
        ];
        $validator = \Validator::make($array, $this->rules);

        if ($validator->fails()) {
            return ['Count' => 0, 'Results' => []];
        }
        $content = $this->nhtsa($model_year, $manufacturer, $model);
        unset($content['Message']);

        array_walk($content['Results'], function (& $content) {
            $content['Description'] = $content['VehicleDescription'];
            unset($content['VehicleDescription']);
        });
        return $content;
    }
}