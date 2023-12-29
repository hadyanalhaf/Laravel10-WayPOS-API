<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="WayPOS API",
     *      description="This is an official documentation of WayPOS API. This documentation is used for knowing the rules  in consuming the resource of this API.",
     *      @OA\Contact(
     *          email="contact@waysolve.com"
     *      ),
     *      @OA\License(
     *          name="Nginx",
     *          url="https://nginx.org/LICENSE"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Main Server"
     * )
     *
     * @OAS\SecurityScheme(
     *     securityScheme="sanctum",
     *     type="http",
     *     scheme="bearer",
     *     bearerFormat="JWT"
     * )
     *
     * @OA\Tag(
     *     name="Authentication",
     *     description="API Endpoints Group of Authentication"
     * )
     * @OA\Tag(
     *     name="Category",
     *     description="API Endpoints Group of Category"
     * )
     * @OA\Tag(
     *     name="Unit",
     *     description="API Endpoints Group of Unit"
     * )
     * @OA\Tag(
     *     name="Partner",
     *     description="API Endpoints Group of Partner"
     * )
     * @OA\Tag(
     *     name="Branch",
     *     description="API Endpoints Group of Branch"
     * )
     *
     * @OA\Schema(
     *     schema="SuccessResult",
     *     title="Schemas for success response",
     * 	   @OA\Property(
     * 		   property="success",
     * 		   type="boolean"
     * 	   ),
     * 	   @OA\Property(
     * 		   property="message",
     * 		   type="string"
     * 	   ),
     * 	   @OA\Property(
     * 		   property="data",
     * 		   type="object"
     * 	   ),
     * )
     * @OA\Schema(
     *     schema="FailedResult",
     *     title="Schemas for failed response",
     * 	   @OA\Property(
     * 		   property="success",
     * 		   type="boolean"
     * 	   ),
     * 	   @OA\Property(
     * 		   property="message",
     * 		   type="string"
     * 	   ),
     * 	   @OA\Property(
     * 		   property="error_code",
     * 		   type="integer"
     * 	   ),
     * 	   @OA\Property(
     * 		   property="data",
     * 		   type="object"
     * 	   ),
     * )
     *
     */

    // API Success response
    public function successResponse(string $message, array $data = [])
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    // API Failed response
    public function failedResponse(string $message, $code = Response::HTTP_INTERNAL_SERVER_ERROR, array $data = [])
    {
        $code = ($code != 0) ? $code : Response::HTTP_INTERNAL_SERVER_ERROR;
        return response()->json([
            'success' => false,
            'message' => $message,
            'error_code' => $code,
            'data' => (object) $data
        ], $code);
    }
}
