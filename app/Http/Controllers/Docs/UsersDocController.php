<?php

namespace App\Http\Controllers\Docs;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

abstract class UsersDocController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/user",
     *     summary="Get User Information",
     *     tags={"User"},
     *     description="Get User Information by User ID.",
     *     operationId="id",
     *     produces={"application/json"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="file",
     *             @SWG\Schema(ref="#/definitions/User")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="400",
     *         description="Invalid parameter value",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="User Not Found",
     *     )
     * )
     */
    abstract public function show() : JsonResponse;

}