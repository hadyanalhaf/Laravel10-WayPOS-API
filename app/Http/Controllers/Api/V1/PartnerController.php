<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Partner\ActivationPartnerRequest;
use App\Http\Requests\Partner\CreatePartnerRequest;
use App\Http\Requests\Partner\DeletePartnerRequest;
use App\Http\Requests\Partner\UpdatePartnerRequest;
use App\Models\Partner;

class PartnerController extends Controller
{
    /**
     * @OA\ Get(
     *     path="/partner",
     *     summary="Get Partner data",
     *     tags={"Partner"},
     *     security={{"sanctum":{}}},
     *		@OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="To get sepesific data by ID",
     *         required=false,
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search Data By Name",
     *         required=false,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": true,
     *                  "message": "false",
     *                  "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "Validation errors",
     *                  "error_code": 422,
     *                  "data": {
     *                      "errors": {
     *                          "email": "<Error Messages>"
     *                      }
     *                  }
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated Request",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                 "success": false,
     *                 "message": "Unauthenticated",
     *                 "error_code": 401,
     *                 "data": {}
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                 @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="error_code",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                 ),
     *             ),
     *             example={
     *                  "success": false,
     *                  "message": "<Error Messages>",
     *                  "error_code": 500,
     *                  "data": {}
     *             }
     *         )
     *     ),
     * )
     */
// Get Partner data
public function get(Request $request)
{
    try {
        $data = [];
        if ($request->id) {
            $data['partner'] = Partner::where('active', true)->where('id', $request->id)->first();
        } else if ($request->search) {
            $data['partner'] = Partner::where('name', 'LIKE', '%' . $request->search . '%')->paginate(4);
        } else {
            $data['partner'] = Partner::where('active', true)->orderBy('name')->get();
        }
    } catch (\Throwable $e) {
        return $this->failedResponse($e->getMessage(), $e->getCode());
    }
    // Success response
    return $this->successResponse("Get Partner successfull", $data);
}

/**
 * @OA\ Post(
 *     path="/partner",
 *     summary="Create New Partner ",
 *     tags={"Partner"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *				@OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="photo",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="address",
 *                     type="string",
 *                 ),
 *             ),
 *				example={
 *					"name": "saipul jamil",
 *					"photo": "photo saipul",
 *					"address": "jl mawar no 5",
 *				}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": true,
 *                  "message": "false",
 *                  "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "Validation errors",
 *                  "error_code": 422,
 *                  "data": {
 *                      "errors": {
 *                          "email": "<Error Messages>"
 *                      }
 *                  }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                 "success": false,
 *                 "message": "Unauthenticated",
 *                 "error_code": 401,
 *                 "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "<Error Messages>",
 *                  "error_code": 500,
 *                  "data": {}
 *             }
 *         )
 *     ),
 * )
 */
// Create New Partner
public function create(CreatePartnerRequest $request)
    {
        try {
            $partner = Partner::create($request->only('name','photo','address'));
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Create Partner successfull", [
            "partner" => $partner
        ]);
    }

//


/**
 * @OA\ Put(
 *     path="/partner",
 *     summary="update partner by id",
 *     tags={"Partner"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *				@OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="photo",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="address",
 *                     type="string",
 *                 ),
 *             ),
 *				example={
 *					"id": "1",
 *					"name": "Budi sudarsono",
 *					"photo": "foto budi sudarsono",
 *					"address": "jl kenaga"
 *				}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object"
 *                 )
 *             ),
 *             example={
 *                  "success": true,
 *                  "message": "update Partner successfull",
 *                  "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "Validation errors",
 *                  "error_code": 422,
 *                  "data": {
 *                      "errors": {
 *                          "email": "<Error Messages>"
 *                      }
 *                  }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                 "success": false,
 *                 "message": "Unauthenticated",
 *                 "error_code": 401,
 *                 "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "<Error Messages>",
 *                  "error_code": 500,
 *                  "data": {}
 *             }
 *         )
 *     ),
 * )
 */
// Update Partner
public function update(UpdatePartnerRequest $request)
    {

        try {
            $partner = Partner::find($request->id);
            $partner->update($request->only('name','photo','address'));
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage());
        }
        // Success response
        return $this->successResponse("Update Partner successfull", [
            "partner" => $partner
        ]);
}

/**
 * @OA\ Delete(
 *     path="/partner",
 *     summary="Delete Partner",
 *     tags={"Partner"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *				@OA\Schema(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="photo",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="address",
 *                     type="string",
 *                 ),
 *             ),
 *				example={
 *					"id": "1",
 *
 *				}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": true,
 *                  "message": "false",
 *                  "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "Validation errors",
 *                  "error_code": 422,
 *                  "data": {
 *                      "errors": {
 *                          "email": "<Error Messages>"
 *                      }
 *                  }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                 "success": false,
 *                 "message": "Unauthenticated",
 *                 "error_code": 401,
 *                 "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "<Error Messages>",
 *                  "error_code": 500,
 *                  "data": {}
 *             }
 *         )
 *     ),
 * )
 */
// Delete Partner
public function delete(DeletePartnerRequest $request)
{
    try {
        $partner = Partner::find($request->id);
        $partner->delete();
    } catch (\Throwable $e) {
        return $this->failedResponse($e->getMessage(), $e->getCode());
    }
    // Success response
    return $this->successResponse("Partner deleted successfully", [
        'partner' => $partner
    ]);
}

/**
 * @OA\ Patch(
 *     path="/partner/activate",
 *     summary="Activate Partner",
 *     tags={"Partner"},
 *     security={{"sanctum":{}}},
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *				@OA\Schema(
 *                @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="photo",
 *                     type="string",
 *                 ),
 *                  @OA\Property(
 *                     property="address",
 *                     type="string",
 *                 ),
 *             ),
 *				example={
 *					"id": 1
 *				}
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": true,
 *                  "message": "false",
 *                  "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "Validation errors",
 *                  "error_code": 422,
 *                  "data": {
 *                      "errors": {
 *                          "email": "<Error Messages>"
 *                      }
 *                  }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated Request",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                 "success": false,
 *                 "message": "Unauthenticated",
 *                 "error_code": 401,
 *                 "data": {}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal Server Error",
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="success",
 *                     type="boolean"
 *                 ),
 *                 @OA\Property(
 *                     property="message",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="error_code",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="object",
 *                 ),
 *             ),
 *             example={
 *                  "success": false,
 *                  "message": "<Error Messages>",
 *                  "error_code": 500,
 *                  "data": {}
 *             }
 *         )
 *     ),
 * )
 */
// Activate Partner
public function activate(ActivationPartnerRequest $request)
    {
        try {
            $partner = Partner::find($request->id);
            $partner->update(['active' => true]);
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Partner activated successfully", [
            'partner' => $partner
        ]);
    }


/**
    * @OA\ Patch(
    *     path="/partner/deactivate",
    *     summary="Deactivate Partner",
    *     tags={"Partner"},
    *     security={{"sanctum":{}}},
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *				@OA\Schema(
    *                 @OA\Property(
    *                     property="name",
    *                     type="string",  *                 ),
    *                  @OA\Property(
    *                     property="photo",
    *                     type="string",
    *                 ),
    *                  @OA\Property(
    *                     property="address",
    *                     type="string",
    *                 ),
    *             ),
    *				example={
    *					"id": 1
    *				}
    *         )
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="OK",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="success",
    *                     type="boolean"
    *                 ),
    *                 @OA\Property(
    *                     property="message",
    *                     type="string",
    *                 ),
    *                 @OA\Property(
    *                     property="data",
    *                     type="object",
    *                 ),
    *             ),
    *             example={
    *                  "success": true,
    *                  "message": "false",
    *                  "data": {}
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response=422,
    *         description="Validation Error",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="success",
    *                     type="boolean"
    *                 ),
    *                 @OA\Property(
    *                     property="message",
    *                     type="string",
    *                 ),
    *                 @OA\Property(
    *                     property="error_code",
    *                     type="integer",
    *                 ),
    *                 @OA\Property(
    *                     property="data",
    *                     type="object",
    *                 ),
    *             ),
    *             example={
    *                  "success": false,
    *                  "message": "Validation errors",
    *                  "error_code": 422,
    *                  "data": {
    *                      "errors": {
    *                          "email": "<Error Messages>"
    *                      }
    *                  }
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response=401,
    *         description="Unauthenticated Request",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="success",
    *                     type="boolean"
    *                 ),
    *                 @OA\Property(
    *                     property="message",
    *                     type="string",
    *                 ),
    *                 @OA\Property(
    *                     property="error_code",
    *                     type="integer",
    *                 ),
    *                 @OA\Property(
    *                     property="data",
    *                     type="object",
    *                 ),
    *             ),
    *             example={
    *                 "success": false,
    *                 "message": "Unauthenticated",
    *                 "error_code": 401,
    *                 "data": {}
    *             }
    *         )
    *     ),
    *     @OA\Response(
    *         response=500,
    *         description="Internal Server Error",
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                     property="success",
    *                     type="boolean"
    *                 ),
    *                 @OA\Property(
    *                     property="message",
    *                     type="string",
    *                 ),
    *                 @OA\Property(
    *                     property="error_code",
    *                     type="integer",
    *                 ),
    *                 @OA\Property(
    *                     property="data",
    *                     type="object",
    *                 ),
    *             ),
    *             example={
    *                  "success": false,
    *                  "message": "<Error Messages>",
    *                  "error_code": 500,
    *                  "data": {}
    *             }
    *         )
    *     ),
    * )
    */
// Deactivate Partner
    public function deactivate(ActivationPartnerRequest $request)
    {
        try {
            $partner = Partner::find($request->id);
            $partner->update(['active' => false]);
        } catch (\Throwable $e) {
            return $this->failedResponse($e->getMessage(), $e->getCode());
        }
        // Success response
        return $this->successResponse("Partner activated successfully", [
            'partner' => $partner
        ]);
    }
}
