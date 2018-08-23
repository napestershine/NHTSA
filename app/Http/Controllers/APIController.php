<?php
/**
 * Created by PhpStorm.
 * Filename: BaseController.php,
 * Description:
 * User: Manoj Kumar
 * Date: 8/3/2018
 * Time: 9:42 PM
 */

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class APIController extends Controller
{
    public function gtest()
    {
        $client = new Client(); //GuzzleHttp\Client
        $result = $client->get('https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/2015/make/Aud i/model/A3?format=json');
        dd($result);
    }

}