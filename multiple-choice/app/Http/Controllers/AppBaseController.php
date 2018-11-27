<?php

namespace App\Http\Controllers;

use InfyOm\Generator\Utils\ResponseUtil;
use Response;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return Response::json(ResponseUtil::makeError($error), $code);
    }

     /**
     * Response error
     * @param  string  $message
     * @param  array  $errors
     * @param  integer $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function responseError($message = null, $errors = null, $status = 500)
    {
        return \Response::json([
            'success' => false,
            'status' => $status,
            'message' => $message,
            'data' => $errors
        ]);
    }
}
